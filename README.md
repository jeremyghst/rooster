##Disconnect authentication + second database

### ./routes/web.php
Remove/comment:

Auth::routes();
Route::middleware(['auth'])->group(function () {
}

### ./resources/views/base/layout.blade.php
Remove/comment:
<li>
    <button class="btn btn_squar btn_red" formaction="{{route('logout')}}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
        <i class="far fa-clock icon"></i>
        Uitklokken
    </button>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
</form>

### ./app/Models/User.php
Remove/comment:

protected $table = 'user';
protected $connection = 'mysql2';
public $timestamps = false;
