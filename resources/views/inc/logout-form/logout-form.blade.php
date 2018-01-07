<form id="logout-form" action={{route('logout')}} method="post" style="display:none;">
    {{ csrf_field() }}
</form>
