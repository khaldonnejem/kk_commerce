   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('site.index') }}">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item  {{ request()->routeIs('admin.index')  ? "active" : '' }} ">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('site.dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pages Collapse Menu (categories) -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsCategory"
            aria-expanded="true" aria-controls="collapsCategory">
            <i class="fas fa-fw fa-tags"></i>
            <span>{{ __('site.categories') }}</span>
        </a>

        {{-- http://127.0.0.1:8000/admin/categories/create
        http://127.0.0.1:8000/admin/categories
        http://127.0.0.1:8000/admin/categories/1/edit --}}

        {{-- {{ str_contains(request()->url(), 'categories') }} --}}

        <div id="collapsCategory" class="collapse {{ str_contains(request()->url(), 'categories') ?  'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">{{ __('site.all categories') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}" href="{{ route('admin.categories.create') }}">{{ __('site.add new') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.categories.trash') ? 'active' : '' }}" href="{{ route('admin.categories.trash') }}">{{ __('site.trash') }}</a>
                {{-- <a class="collapse-item" href="{{ route('admin.categories.trash') }}">Trash</a> --}}
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Nav Item - Pages Collapse Menu (products) -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsProduct"
            aria-expanded="true" aria-controls="collapsProduct">
            <i class="fas fa-fw fa-heart"></i>
            <span>{{ __('site.products') }}</span>
        </a>

        {{-- {{ str_contains(request()->url(), 'products') }} --}}

        <div id="collapsProduct" class="collapse  {{ str_contains(request()->url(), 'products') ?  'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">{{ __('site.all products') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.products.create') ? 'active' : '' }}" href="{{ route('admin.products.create') }}">{{ __('site.add new') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.products.trash') ? 'active' : '' }}" href="{{ route('admin.products.trash') }}">{{ __('site.trash') }}</a>
                {{-- <a class="collapse-item" href="{{ route('admin.products.trash') }}">Trash</a> --}}
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Orders -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-cart-plus"></i>
            <span>{{ __('site.orders') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Payments -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>{{ __('site.payments') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Users -->
    <li class="nav-item {{ request()->routeIs('admin.users.index')  ? "active" : '' }} ">
        <a class="nav-link " href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('site.users') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCode"
            aria-expanded="true" aria-controls="collapseCode">
            <i class="fas fa-fw fa-percent"></i>
            <span>{{ __('site.promocodes') }}</span>
        </a>
        <div id="collapseCode" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html">{{ __('site.all promocodes') }}</a>
                <a class="collapse-item" href="cards.html">{{ __('site.add new') }}</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0">

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-comments"></i>
            <span>{{ __('site.reviews') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTestimonials"
            aria-expanded="true" aria-controls="collapseTestimonials">
            <i class="fas fa-fw fa-comment-alt"></i>
            <span>{{ __('site.testimonials') }}</span>
        </a>
        <div id="collapseTestimonials" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html">{{ __('site.all testimonials') }}</a>
                <a class="collapse-item" href="cards.html">{{ __('site.add new') }}</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.roles.index') }}">
        {{-- <a class="nav-link" href="#"> --}}
            <i class="fas fa-fw fa-lock"></i>
            <span>{{ __('site.roles') }}</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
