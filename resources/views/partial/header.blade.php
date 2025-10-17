<div class="navbar-wrapper">
    <div class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: #242c6d">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand navbar-image" href="#"><img src="image/logoit.png" alt="" width="2%"></a> -->
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <!-- <li><a href="index.php"><span class="glyphicon glyphicon-home"> </span></a></li> -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @php($categories = \App\Models\Category::get())
                            @forelse($categories as $category)
                                <li><a href="/category/{{ $category->id }}">{{ $category->name }}</a></li>
                            @empty
                                <li><a href="#">No categories available</a></li>
                            @endforelse
                        </ul>
                    </li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (!Session::has('userId'))
                        <li><a href="#" onclick="openForm(event,'login')"><span class="glyphicon glyphicon-user">
                                </span> Login</a></li>
                        <li><a href="#" onclick="openForm(event,'register')"><span
                                    class="glyphicon glyphicon-list-alt">
                                </span>
                                Register</a></li>
                    @else
                        <li>
                            <a href="/profile"><span class="glyphicon glyphicon-user"> </span>
                                &nbsp{{ Session::get('userName') }}</a>
                        </li>
                        <li class="header__icon">
                            <a href="/notification">
                                <span class="material-icons">
                                    <?php
                                    $notifications = App\Models\User::find(Session::get('userId'))->unReadNotifications;
                                    $k = 0;
                                    foreach ($notifications as $notification) {
                                        if (array_key_exists('date', $notification['data'])) {
                                            if (strtotime($notification['data']['date']) > strtotime(date('Y-m-d'))) {
                                                unset($notifications[$k]);
                                            }
                                        }
                                        $k++;
                                    }
                                    ?>
                                    @if ($notifications->count() > 0)
                                        notifications_active
                                    @else
                                        notifications
                                    @endif
                                </span>
                            </a>
                        <li>
                        <li class="header__icon">
                            <a href="/cart"><span class="material-icons">
                                    shopping_cart
                                </span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">
    <div class="logo">
        <a href="/"><img src="/image/logo.jpg" width="100%" /></a>
    </div>
</div>
