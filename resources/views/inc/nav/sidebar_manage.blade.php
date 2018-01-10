<div class="sidemenu">
    <aside class="menu">
        <p class="menu-label">
            GENERAL
        </p>
        <ul class="menu-list">
            <li><a href={{route('admin.dashboard')}} class="{{ Request::is('admin/dashboard')? " is-active" : ''}}">Dashboard</a></li>
            {{--<li><a href={{route('admin.post')}} class="{{ Request::is('admin/')? " is-active" : ''}}">Post</a></li>--}}
        </ul>
        <p class="menu-label">
            ADMINISTRATION
        </p>
        <ul class="menu-list">
            <li><a href={{route('user.index')}} class="{{ Request::is('admin/user*')? " is-active" : ''}}">Manger User</a></li>
            <li><a class="has-submenu {{ (Request::is('admin/role*') || Request::is('admin/permission*'))? " is-active" : ''}}" >Role & permission</a>
                <ul class="submenu {{ (Request::is('admin/role*') || Request::is('admin/permission*'))? " is-open" : 'is-close'}}">
                    <li><a href="{{ route('role.index') }}" class="{{ Request::is('admin/role*')? " is-active" : ''}}">Role</a></li>
                    <li><a href="{{ route('permission.index') }}" class="{{ Request::is('admin/permission*')? " is-active" : ''}}">Permission</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
