<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

use Illuminate\Support\Facades\Session;
use Cookie;
use Illuminate\Support\Str;
use App\Mail\SecondEmailVerifyMailManager;
use Mail;
use Illuminate\Auth\Events\PasswordReset;
use App\Product;
use App\Models\Manufacturer;
use App\Models\Year;
use App\Category;
use App\Models\Brand;
use App\Models\ModelName;
use App\Models\CartItem;
use App\Order;
use App\OrderDetail;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\Password;
use Cache;
use Illuminate\Support\Facades\Validator;



class FrontController extends Controller
{
    /**
     * Show the application frontend home.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        if(!auth()->check())
        {

            return redirect()->route('home')->with('error', 'Forbidden request');
        }
        $user = Auth::user();
        return view('frontend.pages.profile', array('user'=>$user));

    }
    public function all_orders(Request $request)
    {
        if(!auth()->check())
        {
            return redirect()->route('home')->with('error', 'Forbidden request');
        }
        $date = $request->date;
        $sort_search = null;
        $delivery_status = null;

        $orders = Order::with('shop')->orderBy('id', 'desc');


        if (true) {
            $orders =  $orders->where('user_id', Auth::user()->id);
        }

        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        }

        if ($date != null) {
            $orders = $orders->where('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }

        $orders = $orders->paginate(15);
        return view('frontend.pages.orders', compact('orders', 'sort_search', 'delivery_status', 'date'));
        //return view(, array());

    }
    public function home()
    {
        $domainConfig = app('domainConfig'); // Retrieve the matched domain configuration

        // Access the domain-specific home view
        $homeView = $domainConfig['views']['home'];

        // Render the domain-specific home view
        // dd($homeView);
        return view($homeView);
    }


    public function productListing(Request $request)
    {
        // Get the domain configuration
        $domainConfig = app('domainConfig');
        $shopId = $domainConfig['shop_id'];

        // Retrieve visible parent categories with nested children
        $categories = Category::where('parent_id', 0)
            ->where(function ($query) use ($shopId) {
                $query->whereHas('visibility', function ($subQuery) use ($shopId) {
                    $subQuery->where('shop_id', $shopId);
                });
            })
            ->withCount(['products as product_count' => function ($query) use ($shopId) {
                $query->whereHas('visibility', function ($subQuery) use ($shopId) {
                    $subQuery->where('shop_id', $shopId);
                });
            }])
            ->with(['childrenCategories' => function ($query) use ($shopId) {
                $query->withCount(['products as product_count' => function ($query) use ($shopId) {
                    $query->whereHas('visibility', function ($subQuery) use ($shopId) {
                        $subQuery->where('shop_id', $shopId);
                    });
                }]);
            }])
            ->orderBy('name')
            ->get();


        // Retrieve brands, manufacturers, and years, sorted by name
        $brands = Brand::withCount(['products as product_count' => function ($query) use ($shopId) {
            $query->whereHas('visibility', function ($subQuery) use ($shopId) {
                $subQuery->where('shop_id', $shopId);
            });
        }])->orderBy('name')->get();

        $manufacturers = Manufacturer::withCount(['products as product_count' => function ($query) use ($shopId) {
            $query->whereHas('visibility', function ($subQuery) use ($shopId) {
                $subQuery->where('shop_id', $shopId);
            });
        }])->orderBy('name')->get();

        $years = Year::withCount(['products as product_count' => function ($query) use ($shopId) {
            $query->whereHas('visibility', function ($subQuery) use ($shopId) {
                $subQuery->where('shop_id', $shopId);
            });
        }])->orderBy('name')->get();


        // Start building the product query with visibility filter
        $query = Product::query()->whereHas('visibility', function ($subQuery) use ($shopId) {
            $subQuery->where('shop_id', $shopId);
        });

        // CATEGORY FILTER
        if ($request->filled('category')) {
            // Recursively fetch all descendant category IDs for the selected categories
            $categoryIds = $request->category;

            if (!empty($categoryIds)) {
                $query = $query->join('product_category_pivot', 'products.id', '=', 'product_category_pivot.product_id')
                    ->whereIn('product_category_pivot.category_id', $categoryIds)
                    ->select('products.*')
                    ->distinct();
            }
        }




        // BRAND FILTER
        if ($request->filled('brand')) {
            $query->whereHas('brands', function ($q) use ($request) {
                $q->whereIn('brands.id', $request->brand); // Specify the table name explicitly
            });
        }

        // MANUFACTURER FILTER
        if ($request->filled('manufacturer')) {
            $query->whereHas('manufacturers', function ($q) use ($request) {
                $q->whereIn('manufacturers.id', $request->manufacturer); // Specify the table name explicitly
            });
        }

        // YEAR FILTER
        if ($request->filled('year')) {
            $query->whereHas('years', function ($q) use ($request) {
                $q->whereIn('years.id', $request->year); // Specify the table name explicitly
            });
        }
        // MODEL FILTER
        if ($request->filled('model')) {
            $query->whereHas('models', function ($q) use ($request) {
                $q->whereIn('model_names.id', $request->model);
            });
        }

        // SORTING
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'low_price':
                    $query->orderBy('unit_price', 'asc');
                    break;
                case 'high_price':
                    $query->orderBy('unit_price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        }

        // PAGINATION
        $products = $query->paginate(24);

        // SELECTED FILTERS
        // Directly query the DB for selected IDs to avoid intersection logic complexity.
        $selectedCategoryNames = [];
        if ($request->filled('category')) {
            $selectedCategoryNames = Category::whereIn('id', $request->category)
                ->orderBy('name')
                ->pluck('name')
                ->toArray();
        }

        $selectedBrandNames = [];
        if ($request->filled('brand')) {
            $selectedBrandNames = Brand::whereIn('id', $request->brand)
                ->orderBy('name')
                ->pluck('name')
                ->toArray();
        }

        $selectedManufacturerNames = [];
        if ($request->filled('manufacturer')) {
            $selectedManufacturerNames = Manufacturer::whereIn('id', $request->manufacturer)
                ->orderBy('name')
                ->pluck('name')
                ->toArray();
        }

        $selectedYearNames = [];
        if ($request->filled('year')) {
            $selectedYearNames = Year::whereIn('id', $request->year)
                ->orderBy('name')
                ->pluck('name')
                ->toArray();
        }

        $selectedFilters = [
            'Categories' => Category::whereIn('id', $request->category ?? [])->get()->map(function ($category) use ($request) {
                return [
                    'name' => $category->name,
                    'removeUrl' => route('products.listing', array_merge($request->except(['category']), ['category' => array_diff($request->category ?? [], [$category->id])])),
                ];
            })->toArray(),
            'Brands' => Brand::whereIn('id', $request->brand ?? [])->get()->map(function ($brand) use ($request) {
                return [
                    'name' => $brand->name,
                    'removeUrl' => route('products.listing', array_merge($request->except(['brand']), ['brand' => array_diff($request->brand ?? [], [$brand->id])])),
                ];
            })->toArray(),
            'Manufacturers' => Manufacturer::whereIn('id', $request->manufacturer ?? [])->get()->map(function ($manufacturer) use ($request) {
                return [
                    'name' => $manufacturer->name,
                    'removeUrl' => route('products.listing', array_merge($request->except(['manufacturer']), ['manufacturer' => array_diff($request->manufacturer ?? [], [$manufacturer->id])])),
                ];
            })->toArray(),
            'Years' => Year::whereIn('id', $request->year ?? [])->get()->map(function ($year) use ($request) {
                return [
                    'name' => $year->name,
                    'removeUrl' => route('products.listing', array_merge($request->except(['year']), ['year' => array_diff($request->year ?? [], [$year->id])])),
                ];
            })->toArray(),
        ];





        return view($domainConfig['views']['product_listing'], [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'manufacturers' => $manufacturers,
            'years' => $years,
            'selectedFilters' => $selectedFilters,
        ]);
    }


    public function productDetails($id)
    {
        // Retrieve the product by ID
        $product = Product::findOrFail($id);

        // Return a placeholder view for now (can be customized later)
        return view('frontend.pages.product_details', compact('product'));
    }


    public function explodedView(Request $request, $id = null)
    {
        $type = null;
        $product = [];
        $name = 'Exploded view';
        $category = [];

        if (str_contains($request->path(), 'category')) {
            //die('OKK');
            $category = Category::where('id', $id)->first();
            $name = $category->name;
            $type = 'category';
        } elseif (str_contains($request->path(), 'product')) {
            $product = Product::with('categories', 'product_addons')->findOrFail($id);
            $name = $product->name;
            $type = 'product';
        }

        return view('frontend.pages.exploded_view', compact('type', 'id','product','name','category'));
    }


    public function exploded_view_product()
    {
        return view('frontend.pages.exploded_product');
    }


    // Returns JSON data for bstreeview
    public function get_tree(Request $request)
    {
        $parent = $request->input('parent', '#');

        if ($parent == '#') {
            $categories = Category::where('parent_id', 0)->get();
            $data = [];
            foreach ($categories as $cat) {
                $hasChildren = $cat->childrenCategories()->exists() || $cat->products()->exists();
                $data[] = [
                    'id' => $cat->id,
                    'text' => $cat->name,
                    'data' => [
                        'type' => $hasChildren ? 'category' : 'product_list',
                    ],
                    'children' => $hasChildren, // Enables lazy loading
                ];
            }
            return response()->json($data);
        } else {
            $category = Category::find($parent);
            $data = [];

            if ($category) {
                // Add child categories
                foreach ($category->childrenCategories as $child) {
                    $hasChildren = $child->childrenCategories()->exists() || $child->products()->exists();
                    $data[] = [
                        'id' => $child->id,
                        'text' => $child->name,
                        'data' => [
                            'type' => $hasChildren ? 'category' : 'product_list',
                        ],
                        'children' => $hasChildren,
                    ];
                }

                // Add products if no child categories
                if ($category->childrenCategories->isEmpty()) {
                    foreach ($category->products as $product) {
                        $data[] = [
                            'id' => $product->id,
                            'text' => $product->name,
                            'data' => [
                                'type' => 'single_product',
                            ],
                            'children' => false,
                        ];
                    }
                }
            }

            return response()->json($data);
        }
    }


    public function getTreeParentPath(Request $request)
    {
        $id = $request->input('id'); // ID of the node (category or product)
        $parentPath = [];

        // Determine if it's a category or product
        $node = Category::find($id);

        if ($node) {
            // If it's a category, get the parent hierarchy
            $parentPath = $this->getParentHierarchy($node);
        } else {
            // If it's a product, get its category's parent hierarchy
            $product = Product::find($id);
            if ($product && $product->category) {
                $parentPath = $this->getParentHierarchy($product->category);
                $parentPath[] = $product->category_id; // Add the category itself
            }
        }

        if (empty($parentPath)) {
            return response()->json(['error' => 'Node not found'], 404);
        }

        return response()->json([
            'parent_path' => $parentPath, // Array of parent node IDs
        ]);
    }


    private function getParentHierarchy($node)
    {
        $parentPath = [];
        $current = $node;

        // Traverse up the tree to collect parent IDs
        while ($current->parent_id) {
            $parentPath[] = $current->parent_id;
            $current = Category::find($current->parent_id); // Fetch the parent node
        }

        // Reverse the order to get root-to-leaf path
        return array_reverse($parentPath);
    }


    public function get_model(Request $request)
    {
        $domainConfig = app('domainConfig');
        $shopId = $domainConfig['shop_id'];

        $brandId = $request->input('brand_id');
        $yearId = $request->input('year_id'); // Year filter

        $models = ModelName::withCount(['products as product_count' => function ($query) use ($shopId, $brandId, $yearId) {
            $query->whereHas('visibility', function ($subQuery) use ($shopId) {
                $subQuery->where('shop_id', $shopId);
            });

            if (!empty($brandId)) {
                $query->whereHas('brands', function ($brandQuery) use ($brandId) {
                    $brandQuery->where('brands.id', $brandId);
                });
            }

            if (!empty($yearId)) {
                $query->whereHas('years', function ($yearQuery) use ($yearId) {
                    $yearQuery->where('years.id', $yearId);
                });
            }
        }]);

// SQL Query with Actual Values
        $sql = vsprintf(str_replace('?', "'%s'", $models->toSql()), $models->getBindings());

        dd($sql); // Dump and Die to check the SQL



        ?>
        <option value="">Select Model</option>
        <?php
        foreach ($models as $v)
        {
            ?>
            <option value="<?php echo $v->id ?>"><?php echo $v->id ?>-<?php echo str_replace('"', '', $v->name) ?></option>
            <?php
        }
        exit();
    }

    public function get_years(Request $request)
    {
        $domainConfig = app('domainConfig');
        $shopId = $domainConfig['shop_id'];

        $brandId = $request->input('brand_id');


        $years = Year::withCount(['products as product_count' => function ($query) use ($shopId, $brandId) {
            $query->whereHas('visibility', function ($subQuery) use ($shopId) {
                $subQuery->where('shop_id', $shopId);
            })
                ->whereHas('brands', function ($brandQuery) use ($brandId) {
                    $brandQuery->where('brands.id', $brandId);
                });
        }])->get();
        ?>
        <option value="">Select Year</option>
        <?php
        foreach ($years as $v)
        {
            ?>
            <option value="<?php echo $v->id ?>"><?php echo str_replace('"', '', $v->name) ?></option>
            <?php
        }
        exit();
    }

    public function get_brands(Request $request)
    {
        $shopId = $request->shop_id; // Shop ID from request

        $brands = Brand::withCount(['products as product_count' => function ($query) use ($shopId) {
            $query->whereHas('visibility', function ($subQuery) use ($shopId) {
                $subQuery->where('shop_id', $shopId);
            });
        }])->orderBy('name')->get();

        ?>
        <option value="">Select Brand</option>
        <?php
        foreach ($brands as $brand) {
            ?>
            <option value="<?php echo $brand->id ?>"><?php echo str_replace('"', '', $brand->name) ?></option>
            <?php
        }
        exit();
    }

    public function get_breedcum(Request $request)
    {
        $id = $request->id;
        $type = $request->type;
        $breed = [];
        $title = '';
        if($type == 'categories' && !$id)
        {
            $title = 'Exploded View';
            $breed[] = array('link'=>url('exploded_view'),'title'=>'Exploded view');
//            $breed[] = array('link'=>'#','click'=>'loadCategories(0)','title'=>'Exploded view');

        }
        elseif($type == 'categories' && $id)
        {
            $category = Category::where('id', $id)->first();
            $name = $category->name;
            $title = $name;
            $breed[] = array('link'=>url('exploded_view'),'title'=>'Exploded view');
            $breed[] = array('link'=>'#','click'=>'loadCategories('.$id.')','title'=>$name);

        }
        elseif($type == 'products' && $id)
        {
            $product = Category::where('id', $id)->first();;
            $name = $product->name;
            $title = $name;
            $breed[] = array('link'=>url('exploded_view'),'title'=>'Exploded view');
            $breed[] = array('link'=>'#','click'=>'loadCategoriesOrProducts('.$id.')','title'=>$name);

        }
        elseif($type == 'products' && $id)
        {
            $product = Category::where('id', $id)->first();;
            $name = $product->name;
            $title = $name;
            $breed[] = array('link'=>url('exploded_view'),'title'=>'Exploded view');
            $breed[] = array('link'=>'#','click'=>'loadCategoriesOrProducts('.$id.')','title'=>$name);

        }
        elseif($type == 'product' && $id)
        {
            $product = Product::where('id', $id)->first();;
            $name = $product->name;
            $title = $name;
            $breed[] = array('link'=>url('exploded_view'),'title'=>'Exploded view');
            $breed[] = array('link'=>'#','click'=>'loadCategoriesOrProducts('.$id.')','title'=>$name);

        }
        /*
         * <ul class="breadcrumb d-block">
                        <li><a href="javascript:void(0)" onclick="loadCategories(0)">Home</a></li>
                        <!-- You can append dynamic breadcrumbs here if needed -->
                        <li><a href="javascript:void(0)" onclick="loadCategoriesOrProducts({{ $detailedProduct->categories->first()->id ?? 0 }})">Products</a></li>
                        <li>{{ $detailedProduct->name }}</li>
                    </ul>
         * */



        return view('frontend.partials.breedcum', compact('type', 'id','breed','title'));

    }
    public function get_categories(Request $request)
    {
        $id = $request->id;
        $category = Category::where('id', $id)->first();
        $categories = Category::where('parent_id', $id)->get();
        if ($categories->count() > 0) {

            return view('frontend.partials.categories', compact('categories','category'))->render();
        } else {
            return ""; // no categories
        }
    }

    public function get_products(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        $products = $category ? $category->products : collect([]);
        return view('frontend.partials.products', compact('products','category'))->render();
    }

    public function get_product(Request $request)
    {
        $id = $request->id;
        $detailedProduct = Product::with('categories', 'product_addons')->findOrFail($id);
        // Return partial without layout
        return view('frontend.partials.product_detail', compact('detailedProduct'))->render();
    }


    public function search_product(Request $request)
    {
        $keyword = $request->keyword;
        $products = Product::where('name', 'like', '%' . $keyword . '%')->get();
        return view('frontend.partials.products', compact('products'))->render();
    }



    public function checkout()
    {
        $userId = auth()->id();
        $sessionId = session()->getId();

        $cartItems = CartItem::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->with(['product', 'addon'])->get();

        $subtotal = $cartItems->sum(function ($item) {
            $productPrice = $item->product->unit_price ?? 0;
            $addonPrice = $item->addon->unit_price ?? 0;
            return ($productPrice + $addonPrice) * $item->quantity;
        });
        return view('frontend.pages.checkout',compact('cartItems', 'subtotal'));
    }
    public function all_orders_show($id)
    {

        $order = Order::findOrFail(decrypt($id));
        $delivery_boys = array();
        return view('frontend.pages.order', compact('order', 'delivery_boys'));
    }

    public function placeOrder(Request $request)
    {
        $sessionIdBeforeLogin = session()->getId();

        try {
            // Validate common billing fields and payment method.
            $validated = $request->validate([
                'firstName'      => 'required|string|max:255',
                'lastName'       => 'required|string|max:255',
                'email'          => 'required|email',
                'phone'          => 'required|string|max:15',
                'address1'       => 'required|string|max:255',
                'city'           => 'required|string|max:255',
                'country'        => 'required|string|max:255',
                'zip'            => 'required|string|max:10',
                'payment_method' => 'required|in:cash-on-delivery',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $userId = Auth::id();

        // If "Create an account" is checked and no user is logged in, validate & create the account.
        if ($request->has('createAccount') && !$userId) {
            try {
                // Additional rule: email must be unique.
                $request->validate([
                    'password' => 'required|string|min:6|confirmed',
                    'email'    => 'required|unique:users|email'
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json(['errors' => $e->errors()], 422);
            }

            $user = new User();
            $user->name  = $request->firstName . ' ' . $request->lastName;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                // Optionally create a Customer record.
                $customer = new Customer();
                $customer->user_id = $user->id;
                $customer->save();

                $userId = $user->id;
                Auth::login($user); // Auto-login.

                // Merge session cart into user cart
                $sessionIdAfterLogin = session()->getId();
                \Log::info('Session ID after login', ['session_id' => $sessionIdAfterLogin]);

                // If session ID changes, try manually linking cart to new session
                if ($sessionIdBeforeLogin !== $sessionIdAfterLogin) {
                    \Log::warning('Session ID changed after login. Attempting manual cart merge.');
                    CartItem::where('session_id', $sessionIdBeforeLogin)->update(['session_id' => $sessionIdAfterLogin]);
                }

                // Merge Cart after login
                $this->mergeCart();
            } else {
                return response()->json(['errors' => ['general' => ['Unable to create account.']]], 422);
            }
        }

        // Prepare billing details (always provided).
        $billingDetails = [
            'name'    => $request->firstName . ' ' . $request->lastName,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address1,
            'city'    => $request->city,
            'country' => $request->country,
            'zip'     => $request->zip,
        ];

        // Determine shipping details.
        if ($request->has('shipAddress')) {
            try {
                $request->validate([
                    'shipping_firstName' => 'required|string|max:255',
                    'shipping_lastName'  => 'required|string|max:255',
                    'shipping_email'     => 'required|email',
                    'shipping_phone'     => 'required|string|max:15',
                    'shipping_address1'  => 'required|string|max:255',
                    'shipping_city'      => 'required|string|max:255',
                    'shipping_country'   => 'required|string|max:255',
                    'shipping_zip'       => 'required|string|max:10',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            $shippingDetails = [
                'name'    => $request->shipping_firstName . ' ' . $request->shipping_lastName,
                'email'   => $request->shipping_email,
                'phone'   => $request->shipping_phone,
                'address' => $request->shipping_address1,
                'city'    => $request->shipping_city,
                'country' => $request->shipping_country,
                'zip'     => $request->shipping_zip,
            ];
        } else {
            $shippingDetails = $billingDetails;
        }

        // Retrieve cart items for this user or session.
        $sessionId = session()->getId();


        $cartItems = CartItem::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->with(['product', 'addon'])->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Your cart is empty.'], 400);
        }

        // Calculate totals: subtotal and tax.
        $subtotal = 0;
        $taxTotal = 0;
        foreach ($cartItems as $item) {
            // Assume each cart item has quantity, product unit price, addon price (if any) and a tax value.
            $itemPrice = $item->product->unit_price + ($item->addon->unit_price ?? 0);
            $subtotal += $itemPrice * $item->quantity;
            $itemTax = isset($item->tax) ? $item->tax : 0;
            $taxTotal += $itemTax * $item->quantity;
        }

        // Retrieve shipping cost and coupon discount from session.
        $shippingCost  = Session::get('shipping', 0);
        $couponDiscount = Session::get('pos_discount', 0);

        // Create the Order.
        $order = new Order();
        $order->user_id = $userId; // Guest orders: user_id remains null.
        $order->code = date('Ymd-His') . rand(10, 99);
        $order->date = now();
        $order->payment_status = 'unpaid'; // For COD.
        $order->payment_type = 'Cash';
        $order->payment_details = 'Cash on Delivery';

        // Save billing and shipping details as JSON.
        $order->shipping_address = json_encode([
            'billing'  => $billingDetails,
            'shipping' => $shippingDetails,
        ]);

        if ($order->save()) {
            // Create OrderDetail records for each cart item.
            foreach ($cartItems as $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                // If it's an addon, use addon_id as product_id; otherwise, use product_id.
                if ($item->addon_id) {
                    $orderDetail->product_id = $item->addon_id;
                    $orderDetail->product_type = 'addon';
                    $price = $item->addon->unit_price * $item->quantity;
                } else {
                    $orderDetail->product_id = $item->product_id;
                    $orderDetail->product_type = 'simple';
                    $price = $item->product->unit_price * $item->quantity;
                }
                $orderDetail->quantity = $item->quantity;
                $orderDetail->price = $price;
                $orderDetail->payment_status = 'unpaid';
                $orderDetail->shipping_cost = 0;
                $orderDetail->save();
            }
            // Calculate grand total.
            $grandTotal = $subtotal + $taxTotal + $shippingCost - $couponDiscount;
            $order->grand_total = $grandTotal;
            if ($couponDiscount > 0) {
                $order->coupon_discount = $couponDiscount;
            }
            $order->save();

            // Clear the cart.
            CartItem::where(function ($query) use ($userId, $sessionId) {
                $query->where('user_id', $userId)->orWhere('session_id', $sessionId);
            })->delete();

            return response()->json(['success' => true, 'order_id' => $order->id]);
        }

        return response()->json(['error' => 'Something went wrong while placing your order.'], 500);
    }



    public function orderSuccess($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('frontend.pages.order-success', compact('order'));
    }

    public function shopLogin()
    {
        if (auth()->check()) {
            return redirect()->route('home')->with('success', 'You are already logged in.');
        }
    
        return view('frontend.pages.shop-login');
    }
    


    public function cart()
    {
        $userId = auth()->id();
        $sessionId = session()->getId();

        $cartItems = CartItem::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->with(['product', 'addon'])->get();

        $subtotal = $cartItems->sum(function ($item) {
            $productPrice = $item->product->unit_price ?? 0;
            $addonPrice = $item->addon->unit_price ?? 0;
            return ($productPrice + $addonPrice) * $item->quantity;
        });

        return view('frontend.pages.cart', compact('cartItems', 'subtotal'));
    }


    public function logout(Request $request)
    {
        Auth::logout();

        // Clear session cart if needed
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out.');
    }


    public function login(Request $request)
    {
        $sessionIdBeforeLogin = session()->getId();

        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $user = Auth::user();

            $sessionIdAfterLogin = session()->getId();


            // If session ID changes, try manually linking cart to new session
            if ($sessionIdBeforeLogin !== $sessionIdAfterLogin) {
                CartItem::where('session_id', $sessionIdBeforeLogin)->update(['session_id' => $sessionIdAfterLogin]);
            }

            // Merge Cart after login
            $this->mergeCart();

            // Check if cart items exist after merge
            $cartCount = CartItem::where('user_id', $user->id)->count();

            return response()->json(['success' => 'Logged in successfully.'], 200);
        }

        return response()->json(['error' => 'Invalid email or password.'], 401);
    }


    public function mergeCart()
    {
        $userId = auth()->id();
        $sessionId = session()->getId();

        if (!$userId) {
            \Log::info('Merge Cart Skipped: No user logged in.');
            return;
        }

        // Check if there are any cart items stored under session_id
        $guestCartItems = CartItem::where('session_id', $sessionId)->get();

        if ($guestCartItems->isEmpty()) {
        } else {
        }

        foreach ($guestCartItems as $item) {
            // Check if the item already exists in user's cart
            $existingCartItem = CartItem::where('user_id', $userId)
                ->where('product_id', $item->product_id)
                ->where('addon_id', $item->addon_id)
                ->first();

            if ($existingCartItem) {
                // If exists, update quantity
                $existingCartItem->quantity += $item->quantity;
                $existingCartItem->save();
            } else {
                // Assign session cart to user
                $item->update(['user_id' => $userId, 'session_id' => null]);
            }
        }

        // Ensure no orphaned session cart items remain
        CartItem::where('session_id', $sessionId)->delete();

        // Check merged cart for user
        $mergedCartItems = CartItem::where('user_id', $userId)->get();
    }


    /**
     * Handle AJAX registration request.
     */
    public function register(Request $request)
    {
        $sessionIdBeforeLogin = session()->getId();

        $validator = Validator::make($request->all(), [
            'email'    => 'required|unique:users|email',
            'password' => 'required|string|min:6|confirmed',
            // You can add additional rules for username if needed.
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        // For simplicity, we'll assume the register form sends 'email' and 'password'
        // and uses the email as the username.
        $user->name  = $request->email;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            // Create a Customer record if your system requires it.
            $customer = new Customer();
            $customer->user_id = $user->id;
            $customer->save();

            Auth::login($user); // Auto-login new user.

            $sessionIdAfterLogin = session()->getId();


            // If session ID changes, try manually linking cart to new session
            if ($sessionIdBeforeLogin !== $sessionIdAfterLogin) {
                CartItem::where('session_id', $sessionIdBeforeLogin)->update(['session_id' => $sessionIdAfterLogin]);
            }

            // Merge Cart after login
            $this->mergeCart();


            return response()->json(['success' => 'Registered and logged in successfully.'], 200);
        }

        return response()->json(['error' => 'Unable to register. Please try again.'], 500);
    }

    /**
     * Handle AJAX forgot password request.
     * It sends a reset link to the user's email.
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['success' => 'Reset link sent to your email.'], 200);
        }

        return response()->json(['error' => __($status)], 500);
    }
}
