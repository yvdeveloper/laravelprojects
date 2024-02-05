<?php

use Illuminate\Support\Facades\Route;
use lluminate\Session\Middleware\AuthenticateSession;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DataCalculatorController;
use App\Http\Controllers\EarningsController;
use App\Http\Controllers\Auth\AuthController;

 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
//Route::get('/create_default', [AuthController::class, 'create_default'])->name('auth.create_default');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth', 'auth.session'])->group(function () {
    //index or main page
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/employee/index', [EmployeeController::class, 'index'])->name('employee.index');
    
    //core function
    Route::get('/employee/new_employee', [EmployeeController::class, 'new_employee'])->name('employee.new_employee');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/view/{id}', [EmployeeController::class, 'view'])->name('employee.view');
    Route::put('/employee/{employee}/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

});




Route::post('/user', [UserController::class, 'verify_user'])->name('user.verify_user');
Route::get('/user/index', [UserController::class, 'index'])->name('user.index');

Route::get('/helper/datacalculator', [DataCalculatorController::class,'index'])->name('helper.datacalculator');
Route::get('/helper/earningscalculator/{daily_expenses?}/{data?}', [EarningsController::class,'index'])->name('helper.earningscalculator');

