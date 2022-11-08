<aside class="main-sidebar sidebar-dark-primary ">
        <span  class="brand-link " style="text-decoration: none;">
            @if(config('data.logo')!= null)
            <img src="{{asset('images/'.config('data.logo'))}}"
            class="brand-image img-circle elevation-3" style="opacity: .8">
                @else
                <img src="{{asset('images/setting/bits.jpg')}}"
                class = "rounded-circle" alt="User Image" style="width: 45px; height:50px">
                @endif
                <span style="font-weight: bold;font-size: 15px; margin-left:12px">{{config('data.name')}}</span>
        </span>

        <div class="sidebar  " >

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
                    <div class="mt-2 pb-1 mb-2 d-flex">

                        <div class="image mx-2" >
                            @isset(auth::user()->profile_image)
                            <img src="{{asset('images/'.auth::user()->profile_image)}}"
                            class = "rounded-circle" alt="User Image" style="width: 45px; height:50px">
                            @else
                            <img src="{{asset('images/setting/profile.jpg')}}"
                            class = "rounded-circle" alt="User Image" style="width: 45px; height:50px">
                            @endisset

                        </div>
                        <div class=" ml-3 d-flex align-items-center" style="width: 100%; height:50px">
                            <a href="{{route('account')}}" id="nameFade" class="d-block" style="text-decoration: none;">{{auth::user()->name}}</a>
                        </div>
                    </div>
                    <li class="nav-item menu-model ">
                        <a href="{{route('home')}}" class="nav-link {{'home'== request()->path()?'active':''}}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>
                            Dashboard
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    @if((auth::user()->role === 'admin'))


                    <li class="nav-item ">
                        <a href="{{route('role.index')}}" class="nav-link {{'role'== request()->path()?'active':''}}">
                            <i class="nav-icon fas fa-user-secret"></i>
                            <p>
                            Role
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item ">
                        <a href="{{route('account')}}" class="nav-link {{'user/account'== request()->path()?'active':''}}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                            My Account
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="{{('/product')}}" class="nav-link {{'product'== request()->path()||'productcreate'== request()->path()||'category'== request()->path()||'brand'== request()->path()?'active':''}}">
                            <i class="nav-icon fas fa-basket-shopping"></i>
                            <p>
                            Product
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{('/product')}}" class="ml-2 nav-link {{'product'== request()->path()?'active':''}}  ">
                                    <i class="nav-icon fas fa-basket-shopping"></i>
                                    <p>
                                    Product List
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{('/productcreate')}}" class="ml-2 nav-link {{'productcreate'== request()->path()?'active':''}}  ">
                                    <i class="nav-icon fas fa-basket-shopping"></i>
                                    <p>
                                    Product Add
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{('/category')}}" class="ml-2 nav-link {{'category'== request()->path()?'active':''}} ">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                    Category
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{('/brand')}}" class="ml-2 nav-link {{'brand'== request()->path()?'active':''}}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                    Brand
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a href="{{route('purchas.index')}}" class="nav-link {{'purchas'== request()->path()||'purchas/create'== request()->path()||'return'== request()->path()||'return/create'== request()->path()?'active':''}}">
                            <i class="nav-icon fas fa-cart-shopping"></i>
                            <p>
                                Purchase
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('purchas.index')}}" class="ml-2 nav-link {{'purchas'== request()->path()?'active':''}} ">
                                    <i class="nav-icon fas fa-basket-shopping"></i>
                                    <p>
                                    List
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('purchas.create')}}" class="ml-2 nav-link {{'purchas/create'== request()->path()?'active':''}} ">
                                    <i class="nav-icon fas fa-basket-shopping"></i>
                                    <p>
                                    Purchase
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('return.index')}}" class="ml-2 nav-link  {{'return'== request()->path()?'active':''}}">
                                    <i class="nav-icon fas fa-basket-shopping"></i>
                                    <p>
                                    Return List
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('return.create')}}" class="ml-2 nav-link {{'return/create'== request()->path()?'active':''}}  ">
                                    <i class="nav-icon fas fa-basket-shopping"></i>
                                    <p>
                                    Return
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="" class="nav-link {{'sell'== request()->path()||'sell/create'== request()->path()||'product-return'== request()->path()||'product-return/create'== request()->path()?'active':''}}">
                            <i class="nav-icon fas fa-cart-shopping"></i>
                            <p>
                                Sell
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('sell.index')}}" class="ml-2 nav-link {{'sell'== request()->path()?'active':''}} ">
                                    <i class="nav-icon fas fa-basket-shopping"></i>
                                    <p>
                                    List
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('sell.create')}}" class="ml-2 nav-link {{'sell/create'== request()->path()?'active':''}} ">
                                    <i class="nav-icon fas fa-basket-shopping"></i>
                                    <p>
                                    Sell
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('product-return.index')}}" class="ml-2 nav-link {{'product-return'== request()->path()?'active':''}}  ">
                                    <i class="nav-icon fas fa-basket-shopping"></i>
                                    <p>
                                    Sell Return List
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('product-return.create')}}" class="ml-2 nav-link {{'product-return/create'== request()->path()?'active':''}}  ">
                                    <i class="nav-icon fas fa-basket-shopping"></i>
                                    <p>
                                    Sell Return
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('balance.index')}}" class="nav-link {{'balance'== request()->path()?'active':''}}">
                            <i class="nav-icon fa-sharp fa-solid fa-wallet"></i>
                            <p>
                            Balance
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a href="{{route('payment.index')}}" class="nav-link {{'payment'== request()->path()?'active':''}}">
                            <i class="nav-icon fa-sharp fa-solid fa-wallet"></i>
                            <p>
                            Payment
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('dew.index')}}" class="nav-link {{'dew'== request()->path()?'active':''||'dew-return'== request()->path()?'active':''||'dew-back'== request()->path()?'active':''||'dew-sell'== request()->path()?'active':''}}">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                            Due
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('expenses.index')}}" class="nav-link {{'expenses'== request()->path()?'active':''}}">
                            <i class="nav-icon fas fa-sack-dollar"></i>
                            <p>
                            Expense
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('settings.index')}}" class="nav-link {{'settings'== request()->path()?'active':''}}">
                            <i class="nav-icon fas fa-gear"></i>
                            <p>
                            Settings
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>

</aside>
