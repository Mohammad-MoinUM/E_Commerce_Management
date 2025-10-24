<?php
$vendor = App\Models\Vendor::find(Session::get('vendorId'));
// Resolve a safe profile image path with a reliable fallback
$profileImg = '/admino/images/faces/face4.jpg';
if ($vendor && $vendor->image) {
    $candidate = public_path() . $vendor->image;
    if (file_exists($candidate)) {
        $profileImg = $vendor->image;
    }
}
?>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="/vendor/dashboard"><img src="/image/logo.jpg" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="/vendor/dashboard"><img src="/image/logo.jpg"
                    alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant"></span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
            <li class="nav-item nav-search d-none d-lg-block w-100">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="search">
                            <i class="mdi mdi-magnify"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search now" aria-label="search"
                        aria-describedby="search">
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <!-- Message dropdown removed -->
            <!-- Notification dropdown removed -->
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <img src="{{ $profileImg }}" alt="profile" />
                    <span class="nav-profile-name">{{ $vendor->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <!-- Settings item removed -->
                    <a class="dropdown-item" href="/vendor/logout">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
