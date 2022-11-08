<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: #f7fcfd">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link d-none" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block d-none">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link payment-add-btn"  role="button">
                ৳ <i class="fas fa-add"></i>
            </a>
        </li>
        <li class="nav-item mr-5">
            <a class="nav-link payment-del-btn"  role="button">
                ৳ <i class="fas fa-minus"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>

    </ul>
</nav>

 <!--custom Payment Modal end -->

 <div id="" class="payment_model text-white" >
    <div class="">
        <div class="small_modal_content card" style="background-color: #4358e0; ">
            <div class="">
                <div class="d-flex justify-content-end">
                    <span class="payment_model_close text-white" style="margin-top: -15px ">x</span>
                </div>
            </div>
            <form action="" method="post" id="balanceAddForm">@csrf
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-white">Payment Type : <span class="pay_add"></span></h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('custom.payment')
                </div>
                <div class=" d-flex justify-content-center mb-3" style="margin-top:-30px">
                    <button type="submit"  class="btn btn-dark btn-lg text-white pay-btn" > submit</button>
                    <span class="wait-btn" style="font-weight: 900"></span>
                </div>
            </form>
        </div>
    </div>
</div>

<!--custom paymrnt Modal end -->
