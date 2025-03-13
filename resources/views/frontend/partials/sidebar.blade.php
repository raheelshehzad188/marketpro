<aside class="sidebar mt-2" id="sidebar">
                            <ul class="nav nav-list flex-column mb-5">
                                <li class="nav-item"><a class="nav-link text-3 {{ request()->is('my-account') ? 'active text-dark' : '' }}" href="{{ url('my-account') }}">My Profile</a></li>
                                <li class="nav-item"><a class="nav-link text-3 {{ request()->is('orders') ? 'active text-dark' : '' }}" href="{{ url('orders') }}">Invoices</a></li>
                                <li class="nav-item"><a class="nav-link text-3" href="{{ url('customer/logout') }}">Logout</a></li>
                            </ul>
                        </aside>
