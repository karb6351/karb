<nav class="navbar has-shadow is-transparent" id="nav">
    <div class="container">
        <div class="navbar-brand">
            <a href="{{ route('home') }}" class="navbar-item">Logo</a>
            <button class="button navbar-burger burger">
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="navbar-menu navbar-end">
            {{-- search post --}}
            <div class="navbar-item">
                    <div v-cloak class="search">
                        <div v-show="isSearch" class="search-post">
                            <form class="" action="" method="post">
                                <input class="search-input" type="text" placeholder="Search Post">
                                <button class="search-icon" type="submit">
                                    <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div v-cloak v-show="!isSearch" class="search-post-button" @click="isSearch = !isSearch">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                    <div v-cloak v-show="isSearch" class="delete is-medium m-left-5" @click="isSearch = !isSearch"></div>

            </div>
            @if (!Auth::check())
                <a href="{{ route('login') }}" class="navbar-item is-tab{{ Request::is('login')? ' is-active':'' }}">Login</a>
                <a href="{{ route('register') }}" class="navbar-item is-tab {{ Request::is('register')? ' is-active':'' }}">Register</a>
            @else
                <b-dropdown position="is-bottom-left">
                        <a class="navbar-item is-tab" slot="trigger">
                           <span><strong> {{Auth::user()->username}} </strong></span>
                           <span class="icon small-icon">
                               <i class="fa fa-angle-down" aria-hidden="true"></i>
                           </span>
                        </a>
                    <div v-cloak>
                        @hasanyrole('superadmin|admin')
                        <b-dropdown-item has-link>
                            <a href={{route('admin.index')}}>
                                <span class="icon small-icon">
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                </span>
                                Manage</a>
                        </b-dropdown-item>
                        @endhasanyrole
                        <b-dropdown-item has-link>
                            <a href="#">
                                <span class="icon small-icon">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                </span>
                                Profle</a>
                        </b-dropdown-item>
                        <b-dropdown-item has-link>
                            <a href="#">
                                <span class="icon small-icon">
                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                </span>
                                Bookmark</a>
                        </b-dropdown-item>
                        <b-dropdown-item has-link>
                            <a href="#">
                                <span class="icon small-icon">
                                    <i class="fa fa-inbox" aria-hidden="true"></i>
                                </span>
                                Comment Post</a>
                        </b-dropdown-item>
                        <b-dropdown-item has-link>
                            <a href="#">
                                <span class="icon small-icon">
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                </span>
                                Notification
                                <span class="tag is-rounded is-info"><strong>1</strong></span></a>
                        </b-dropdown-item>
                        <hr class="dropdown-divider">
                        <b-dropdown-item has-link>
                                <a onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    <span class="icon small-icon">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    </span>
                                    Logout</a>
                        </b-dropdown-item>
                    </div>

                </b-dropdown>
                @include('inc.logout-form.logout-form')
            @endif
        </div>
    </div>
</nav>
