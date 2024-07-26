use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class);
});
