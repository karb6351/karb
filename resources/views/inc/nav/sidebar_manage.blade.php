<div class="sidemenu">
    <aside class="menu">
        <p class="menu-label">
            GENERAL
        </p>
        <ul class="menu-list">
            <li><a href={{route('admin.dashboard')}} class="{{ Request::is('admin/dashboard')? " is-active" : ''}}">Dashboard</a></li>
        </ul>
        <p class="menu-label">
            ADMINISTRATION
        </p>
        <ul class="menu-list">
            <li><a href={{route('user.index')}} class="{{ Request::is('admin/user*')? " is-active" : ''}}">Manger User</a></li>
            <li><a >Role & permission</a>
                <ul>
                    <li><a href="{{ route('role.index') }}">Role</a></li>
                    <li><a href="{{ route('permission.index') }}">Permission</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
