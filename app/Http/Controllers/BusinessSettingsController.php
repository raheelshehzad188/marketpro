<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessSetting;
use Artisan;
use Illuminate\Support\Facades\Log;

class BusinessSettingsController extends Controller
{
    public function general_setting(Request $request)
    {
        return view('backend.setup_configurations.general_settings');
    }

    public function activation(Request $request)
    {
        return view('backend.setup_configurations.activation');
    }

    public function social_login(Request $request)
    {
        return view('backend.setup_configurations.social_login');
    }

    public function smtp_settings(Request $request)
    {
        return view('backend.setup_configurations.smtp_settings');
    }

    public function google_analytics(Request $request)
    {
        return view('backend.setup_configurations.google_configuration.google_analytics');
    }

    public function google_recaptcha(Request $request)
    {
        return view('backend.setup_configurations.google_configuration.google_recaptcha');
    }

    public function google_map(Request $request)
    {
        return view('backend.setup_configurations.google_configuration.google_map');
    }

    public function google_firebase(Request $request)
    {
        return view('backend.setup_configurations.google_configuration.google_firebase');
    }

    public function facebook_chat(Request $request)
    {
        return view('backend.setup_configurations.facebook_chat');
    }

    public function facebook_comment(Request $request)
    {
        return view('backend.setup_configurations.facebook_configuration.facebook_comment');
    }

    public function payment_method(Request $request)
    {


        return view('backend.setup_configurations.payment_method');
    }

    public function terms_and_conditions(Request $request)
    {
        return view('backend.setup_configurations.terms_and_conditions');
    }

    public function file_system(Request $request)
    {


        return view('backend.setup_configurations.file_system');
    }

    /**
     * Update the API key's for payment methods.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment_method_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', $request->payment_method . '_sandbox')->first();
        if ($business_settings != null) {
            if ($request->has($request->payment_method . '_sandbox')) {
                $business_settings->value = 1;
                $business_settings->save();
            } else {
                $business_settings->value = 0;
                $business_settings->save();
            }
        }

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    /**
     * Update manual payment gateways (Invoice, Swish)
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment_method_update_manual(Request $request)
    {
        $paymentMethod = $request->payment_method;

        // Handle enable/disable toggle
        if ($paymentMethod === 'invoice') {
            $business_settings = BusinessSetting::where('type', 'invoice_enabled')->first();
            if ($business_settings == null) {
                $business_settings = new BusinessSetting();
                $business_settings->type = 'invoice_enabled';
            }
            $business_settings->value = $request->has('invoice_enabled') ? 1 : 0;
            $business_settings->save();
        } elseif ($paymentMethod === 'swish') {
            // Handle Swish enabled toggle
            $business_settings = BusinessSetting::where('type', 'swish_enabled')->first();
            if ($business_settings == null) {
                $business_settings = new BusinessSetting();
                $business_settings->type = 'swish_enabled';
            }
            $business_settings->value = $request->has('swish_enabled') ? 1 : 0;
            $business_settings->save();

            // Handle Swish number
            if ($request->has('swish_number')) {
                $swish_number_setting = BusinessSetting::where('type', 'swish_number')->first();
                if ($swish_number_setting == null) {
                    $swish_number_setting = new BusinessSetting();
                    $swish_number_setting->type = 'swish_number';
                }
                $swish_number_setting->value = $request->swish_number ?? '0709425194';
                $swish_number_setting->save();
            }
        }

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    /**
     * Update the API key's for GOOGLE analytics.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function google_analytics_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'google_analytics')->first();

        if ($request->has('google_analytics')) {
            $business_settings->value = 1;
            $business_settings->save();
        } else {
            $business_settings->value = 0;
            $business_settings->save();
        }

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    public function google_recaptcha_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'google_recaptcha')->first();

        if ($request->has('google_recaptcha')) {
            $business_settings->value = 1;
            $business_settings->save();
        } else {
            $business_settings->value = 0;
            $business_settings->save();
        }

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    public function google_map_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'google_map')->first();

        if ($request->has('google_map')) {
            $business_settings->value = 1;
            $business_settings->save();
        } else {
            $business_settings->value = 0;
            $business_settings->save();
        }

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    public function google_firebase_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'google_firebase')->first();

        if ($request->has('google_firebase')) {
            $business_settings->value = 1;
            $business_settings->save();
        } else {
            $business_settings->value = 0;
            $business_settings->save();
        }

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }


    /**
     * Update the API key's for GOOGLE analytics.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function facebook_chat_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'facebook_chat')->first();

        if ($request->has('facebook_chat')) {
            $business_settings->value = 1;
            $business_settings->save();
        } else {
            $business_settings->value = 0;
            $business_settings->save();
        }

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    public function facebook_comment_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'facebook_comment')->first();
        if (!$business_settings) {
            $business_settings = new BusinessSetting;
            $business_settings->type = 'facebook_comment';
        }

        $business_settings->value = 0;
        if ($request->facebook_comment) {
            $business_settings->value = 1;
        }

        $business_settings->save();

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    public function facebook_pixel_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'facebook_pixel')->first();

        if ($request->has('facebook_pixel')) {
            $business_settings->value = 1;
            $business_settings->save();
        } else {
            $business_settings->value = 0;
            $business_settings->save();
        }

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    /**
     * Update the API key's for other methods.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function env_key_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    /**
     * overWrite the Env File values.
     * @param  String type
     * @param  String value
     * @return \Illuminate\Http\Response
     */
    public function overWriteEnvFile($type, $val)
    {
        if (env('DEMO_MODE') != 'On') {
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"' . trim($val) . '"';
                if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                    file_put_contents($path, str_replace(
                        $type . '="' . env($type) . '"',
                        $type . '=' . $val,
                        file_get_contents($path)
                    ));
                } else {
                    file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
                }
            }
        }
    }

    public function seller_verification_form(Request $request)
    {
        return view('backend.sellers.seller_verification_form.index');
    }

    /**
     * Update sell verification form.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function seller_verification_form_update(Request $request)
    {
        $form = array();
        $select_types = ['select', 'multi_select', 'radio'];
        $j = 0;
        for ($i = 0; $i < count($request->type); $i++) {
            $item['type'] = $request->type[$i];
            $item['label'] = $request->label[$i];
            if (in_array($request->type[$i], $select_types)) {
                $item['options'] = json_encode($request['options_' . $request->option[$j]]);
                $j++;
            }
            array_push($form, $item);
        }
        $business_settings = BusinessSetting::where('type', 'verification_form')->first();
        $business_settings->value = json_encode($form);
        if ($business_settings->save()) {
            Artisan::call('cache:clear');

            flash(translate("Verification form updated successfully"))->success();
            return back();
        }
    }


    public function saveNavigationSettings(Request $request)
    {
        // Debugging: Log request data
        Log::info('Navigation settings request at start:', $request->all());
        Log::info('Request keys:', array_keys($request->all()));

        // Save logos directly
        $this->saveSetting('primary_logo', $request->primary_logo);
        Log::info('Primary logo saved:', ['primary_logo' => $request->primary_logo]);
        $this->saveSetting('secondary_logo', $request->secondary_logo);
        Log::info('Secondary logo saved:', ['secondary_logo' => $request->secondary_logo]);

        // Save navigation data exactly as received
        $navigationTypes = [
            'primary_navigation' => 'primary',
            'secondary_navigation' => 'secondary'
        ];

        foreach ($navigationTypes as $typeKey => $typePrefix) {
            Log::info("Processing navigation type: {$typeKey}");

            $menuLabels = $request->get("{$typePrefix}_menu_labels", []);
            $menuLinks = $request->get("{$typePrefix}_menu_links", []);

            // Log the values for menu labels and links to ensure they are being received as expected
            Log::info("Menu labels for {$typeKey}: ", $menuLabels);
            Log::info("Menu links for {$typeKey}: ", $menuLinks);

            // Check if menu labels and links are available and contain at least one value
            if (is_array($menuLabels) && count($menuLabels) > 0 && is_array($menuLinks) && count($menuLinks) > 0) {
                Log::info("Menu labels and links found for: {$typeKey}", [
                    'labels' => $menuLabels,
                    'links' => $menuLinks
                ]);

                // Collect data directly from the request
                $navigationData = [];

                foreach ($menuLabels as $index => $label) {
                    $isMegaMenu = isset($request["{$typePrefix}_is_mega_menu"][$index]) && $request["{$typePrefix}_is_mega_menu"][$index] === 'yes';

                    $menuItem = [
                        'label' => $label,
                        'link' => $menuLinks[$index] ?? '',
                        'is_mega_menu' => $isMegaMenu ? 'yes' : 'no',
                        'children' => []
                    ];
                    Log::info("Menu item collected for {$typeKey} at index {$index}", $menuItem);

                    // Check for children
                    if (isset($request["{$typePrefix}_child_labels"][$index]) && is_array($request["{$typePrefix}_child_labels"][$index])) {
                        foreach ($request["{$typePrefix}_child_labels"][$index] as $childIndex => $childLabel) {
                            $childItem = [
                                'label' => $childLabel,
                                'link' => $request["{$typePrefix}_child_links"][$index][$childIndex] ?? '',
                                'sub_children' => []
                            ];
                            Log::info("Child item collected for {$typeKey} at index {$index}, child index {$childIndex}", $childItem);

                            // Check for sub-children
                            if (isset($request["{$typePrefix}_sub_child_labels"][$index][$childIndex]) && is_array($request["{$typePrefix}_sub_child_labels"][$index][$childIndex])) {
                                foreach ($request["{$typePrefix}_sub_child_labels"][$index][$childIndex] as $subChildIndex => $subChildLabel) {
                                    if ($subChildLabel !== null) {
                                        $subChildItem = [
                                            'label' => $subChildLabel,
                                            'link' => $request["{$typePrefix}_sub_child_links"][$index][$childIndex][$subChildIndex] ?? ''
                                        ];
                                        $childItem['sub_children'][] = $subChildItem;
                                        Log::info("Sub-child item collected for {$typeKey} at index {$index}, child index {$childIndex}, sub-child index {$subChildIndex}", $subChildItem);
                                    }
                                }
                            }

                            $menuItem['children'][] = $childItem;
                        }
                    }

                    $navigationData[] = $menuItem;
                }

                // Save the structured navigation data directly
                $this->saveSetting($typeKey, json_encode($navigationData));
                Log::info("Navigation data saved for: {$typeKey}", ['navigationData' => $navigationData]);
            } else {
                Log::info("No menu labels or links found for: {$typeKey}");
            }
        }

        // Clear cache after update
        Artisan::call('cache:clear');
        Log::info('Cache cleared after settings update');
        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    /**
     * Save a setting in BusinessSetting with the given type and value.
     */
    private function saveSetting($type, $value)
    {
        $businessSetting = BusinessSetting::firstOrNew(['type' => $type]);
        $businessSetting->value = $value;
        $businessSetting->save();
        Log::info("Setting saved", ['type' => $type, 'value' => $value]);
    }










    public function update(Request $request)
    {

        foreach ($request->types as $key => $type) {
            if ($type == 'site_name') {
                $this->overWriteEnvFile('APP_NAME', $request[$type]);
            }
            if ($type == 'timezone') {
                $this->overWriteEnvFile('APP_TIMEZONE', $request[$type]);
            } else {
                $lang = null;
                if (gettype($type) == 'array') {
                    $lang = array_key_first($type);
                    $type = $type[$lang];
                    $business_settings = BusinessSetting::where('type', $type)->where('lang', $lang)->first();
                } else {
                    $business_settings = BusinessSetting::where('type', $type)->first();
                }

                if ($business_settings != null) {
                    if (gettype($request[$type]) == 'array') {
                        $business_settings->value = json_encode($request[$type]);
                    } elseif (in_array($type, ['footer_navigation', 'header_menu_items']) && !empty($request[$type])) {
                        // Handle JSON string settings
                        $business_settings->value = $request[$type];
                    } else {
                        $business_settings->value = $request[$type];
                    }
                    $business_settings->lang = $lang;
                    $business_settings->save();
                } else {
                    $business_settings = new BusinessSetting;
                    $business_settings->type = $type;
                    if (gettype($request[$type]) == 'array') {
                        $business_settings->value = json_encode($request[$type]);
                    } elseif (in_array($type, ['footer_navigation', 'header_menu_items']) && !empty($request[$type])) {
                        // Handle JSON string settings
                        $business_settings->value = $request[$type];
                    } else {
                        $business_settings->value = $request[$type];
                    }
                    $business_settings->lang = $lang;
                    $business_settings->save();
                }
            }
        }

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    public function loadHomePageDummyData()
    {
        // Hero Slider Dummy Data
        $heroSliderImages = [
            'uploads/all/banner-1.jpg',
            'uploads/all/banner-2.jpg',
            'uploads/all/banner-3.jpg'
        ];
        $heroSliderTopHeadings = [
            'New Arrivals',
            'Special Offer',
            'Best Deals'
        ];
        $heroSliderMainHeadings = [
            'Fresh Vegetables & Fruits',
            'Premium Quality Products',
            'Shop Now & Save More'
        ];
        $heroSliderButtonTexts = [
            'Shop Now',
            'Explore Shop',
            'Buy Now'
        ];
        $heroSliderButtonLinks = [
            route('products.listing'),
            route('products.listing'),
            route('products.listing')
        ];
        $heroSliderStartingPrices = [
            'Starting from $9.99',
            'Starting from $14.99',
            'Starting from $19.99'
        ];

        // Marketing Banners Dummy Data
        $marketingBannerImages = [
            'uploads/all/marketing-banner-1.jpg',
            'uploads/all/marketing-banner-2.jpg'
        ];
        $marketingBannerLabels = [
            'Summer Sale',
            'Winter Collection'
        ];
        $marketingBannerButtonTexts = [
            'Shop Now',
            'Explore'
        ];
        $marketingBannerButtonUrls = [
            route('products.listing'),
            route('products.listing')
        ];
        $marketingBannerStartingPrices = [
            'From $29.99',
            'From $39.99'
        ];

        // Bottom Banners Dummy Data
        $bottomBannerImages = [
            'uploads/all/bottom-banner-1.jpg',
            'uploads/all/bottom-banner-2.jpg',
            'uploads/all/bottom-banner-3.jpg'
        ];
        $bottomBannerLinks = [
            route('products.listing'),
            route('products.listing'),
            route('products.listing')
        ];

        // Promotional Banner Dummy Data
        $promotionalImages = [
            'uploads/all/promo-1.jpg',
            'uploads/all/promo-2.jpg',
            'uploads/all/promo-3.jpg',
            'uploads/all/promo-4.jpg'
        ];
        $promotionalTitles = [
            'Everyday Fresh Meat',
            'Daily Fresh Vegetables',
            'Everyday Fresh Milk',
            'Everyday Fresh Fruits'
        ];
        $promotionalPrices = [
            '$60.99',
            '$45.99',
            '$35.99',
            '$55.99'
        ];
        $promotionalLinks = [
            route('products.listing'),
            route('products.listing'),
            route('products.listing'),
            route('products.listing')
        ];

        // Newsletter Dummy Data
        $newsletterImage = 'uploads/all/newsletter.jpg';
        $newsletterTitle = 'Subscribe to Our Newsletter';
        $newsletterSubtitle = 'Get the latest updates on new products and upcoming sales';

        // Save all settings
        $this->saveSetting('hero_slider_images', json_encode($heroSliderImages));
        $this->saveSetting('hero_slider_top_heading', json_encode($heroSliderTopHeadings));
        $this->saveSetting('hero_slider_main_heading', json_encode($heroSliderMainHeadings));
        $this->saveSetting('hero_slider_button_text', json_encode($heroSliderButtonTexts));
        $this->saveSetting('hero_slider_button_link', json_encode($heroSliderButtonLinks));
        $this->saveSetting('hero_slider_starting_price', json_encode($heroSliderStartingPrices));

        $this->saveSetting('marketing_banner_images', json_encode($marketingBannerImages));
        $this->saveSetting('marketing_banner_labels', json_encode($marketingBannerLabels));
        $this->saveSetting('marketing_banner_button_text', json_encode($marketingBannerButtonTexts));
        $this->saveSetting('marketing_banner_button_url', json_encode($marketingBannerButtonUrls));
        $this->saveSetting('marketing_banner_starting_price', json_encode($marketingBannerStartingPrices));

        $this->saveSetting('bottom_banner_images', json_encode($bottomBannerImages));
        $this->saveSetting('bottom_banner_links', json_encode($bottomBannerLinks));

        $this->saveSetting('home_promotional_images', json_encode($promotionalImages));
        $this->saveSetting('home_promotional_titles', json_encode($promotionalTitles));
        $this->saveSetting('home_promotional_prices', json_encode($promotionalPrices));
        $this->saveSetting('home_promotional_links', json_encode($promotionalLinks));

        $this->saveSetting('home_newsletter_image', $newsletterImage);
        $this->saveSetting('home_newsletter_title', $newsletterTitle);
        $this->saveSetting('home_newsletter_subtitle', $newsletterSubtitle);

        Artisan::call('cache:clear');

        flash(translate("Dummy data loaded successfully"))->success();
        return back();
    }

    public function updateActivationSettings(Request $request)
    {
        $env_changes = ['FORCE_HTTPS', 'FILESYSTEM_DRIVER'];
        if (in_array($request->type, $env_changes)) {

            return $this->updateActivationSettingsInEnv($request);
        }

        $business_settings = BusinessSetting::where('type', $request->type)->first();
        if ($business_settings != null) {
            if ($request->type == 'maintenance_mode' && $request->value == '1') {
                if (env('DEMO_MODE') != 'On') {
                    Artisan::call('down');
                }
            } elseif ($request->type == 'maintenance_mode' && $request->value == '0') {
                if (env('DEMO_MODE') != 'On') {
                    Artisan::call('up');
                }
            }
            $business_settings->value = $request->value;
            $business_settings->save();
        } else {
            $business_settings = new BusinessSetting;
            $business_settings->type = $request->type;
            $business_settings->value = $request->value;
            $business_settings->save();
        }

        Artisan::call('cache:clear');
        return '1';
    }

    public function updateActivationSettingsInEnv($request)
    {
        if ($request->type == 'FORCE_HTTPS' && $request->value == '1') {
            $this->overWriteEnvFile($request->type, 'On');

            if (strpos(env('APP_URL'), 'http:') !== FALSE) {
                $this->overWriteEnvFile('APP_URL', str_replace("http:", "https:", env('APP_URL')));
            }
        } elseif ($request->type == 'FORCE_HTTPS' && $request->value == '0') {
            $this->overWriteEnvFile($request->type, 'Off');
            if (strpos(env('APP_URL'), 'https:') !== FALSE) {
                $this->overWriteEnvFile('APP_URL', str_replace("https:", "http:", env('APP_URL')));
            }
        } elseif ($request->type == 'FILESYSTEM_DRIVER' && $request->value == '1') {
            $this->overWriteEnvFile($request->type, 's3');
        } elseif ($request->type == 'FILESYSTEM_DRIVER' && $request->value == '0') {
            $this->overWriteEnvFile($request->type, 'local');
        }

        return '1';
    }

    public function vendor_commission(Request $request)
    {
        return view('backend.sellers.seller_commission.index');
    }

    public function vendor_commission_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $business_settings = BusinessSetting::where('type', $type)->first();
            if ($business_settings != null) {
                $business_settings->value = $request[$type];
                $business_settings->save();
            } else {
                $business_settings = new BusinessSetting;
                $business_settings->type = $type;
                $business_settings->value = $request[$type];
                $business_settings->save();
            }
        }

        Artisan::call('cache:clear');

        flash(translate('Seller Commission updated successfully'))->success();
        return back();
    }

    public function shipping_configuration(Request $request)
    {
        return view('backend.setup_configurations.shipping_configuration.index');
    }

    public function shipping_configuration_update(Request $request)
    {
        $business_settings = BusinessSetting::where('type', $request->type)->first();
        $business_settings->value = $request[$request->type];
        $business_settings->save();

        Artisan::call('cache:clear');
        return back();
    }
}
