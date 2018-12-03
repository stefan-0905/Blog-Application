<header class="main-header">

        <!-- Logo -->
        <a href="{{ route('index') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>My</b>B</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>My</b>BLOG</span>
        </a>
    
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <?php $currentUser = Auth::user(); ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ $currentUser->avatar }}" class="user-image" alt="{{ $currentUser->name }}">
                    <span class="hidden-xs">{{ $currentUser->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="{{ $currentUser->avatar }}" class="img-circle" alt="{{ $currentUser->name }}">
        
                        <p>
                        {{ $currentUser->name }} - {{ $currentUser->roles->first()->display_name }}
                        <small>Member since {{ $currentUser->created_at->toFormattedDateString() }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    </ul>
                </li>
                </ul>
            </div>
        </nav>

    </header>