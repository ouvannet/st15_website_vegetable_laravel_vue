<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ExpenseController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\RecurringController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PermissionController;





Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin', function () {
    return view('admin.dashboard.index');
})->middleware('auth');



//This are all the routes for expense;
Route::get('/expense', [ExpenseController::class, 'index'])->name('Expense');
Route::post('/expense', [ExpenseController::class, 'add'])->name('Expense.add');
Route::get('/expense/{id}/edit', [ExpenseController::class, 'edit'])->name('Expense.edit');
Route::put('/expense/{id}', [ExpenseController::class, 'update'])->name('Expense.update');
Route::delete('/expense/{id}', [ExpenseController::class, 'destroy'])->name('Expense.destroy');
Route::put('/expense/{id}/status', [ExpenseController::class, 'updateStatus']);


Route::get('/expense/{id}', [ExpenseController::class, 'show'])->name('expense.show');
Route::post('/expense/{id}/use', [ExpenseController::class, 'useBalance'])->name('expense.use');





//This are all the routes for category;
Route::get('/category', [CategoryController::class, 'index'])->name('Category');
Route::post('/category', [CategoryController::class, 'add'])->name('category.add');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');




Route::get('/recurring', [RecurringController::class, 'index'])->name('Recurring');
Route::get('/report', [ReportController::class, 'index'])->name('Report');
//This are all the routes for department;
Route::get('/department', [DepartmentController::class, 'index'])->name('Department');
Route::post('/department', [DepartmentController::class, 'add'])->name('department.add');
Route::get('/department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
Route::put('/department/{id}', [DepartmentController::class, 'update']);
Route::delete('/department/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

//This are all the routes for user;
Route::get('/user', [UserController::class, 'index'])->name('User');
Route::get('/user_add', [UserController::class, 'add'])->name('user.add');
Route::post('/user_add', [UserController::class, 'submit_add'])->name('user.submit_add');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

//This are all the routes for rolw;
Route::get('/role', [RoleController::class, 'index'])->name('Role');
Route::get('/role_add', [RoleController::class, 'add'])->name('role.add');
Route::post('/role_add', [RoleController::class, 'submit_add'])->name('role.submit_add');
Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
Route::put('/role', [RoleController::class, 'update']);
Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
Route::get('/role/setpermission/{id}', [RoleController::class, 'set_permission_role'])->name('role.set_permission');
Route::post('/role/setpermission/submit', [RoleController::class, 'submit_set_permission_role'])->name('role.submit_set_permission');

//This are all the routes for permission;
Route::get('/permission', [PermissionController::class, 'index'])->name('Permission');
Route::get('/permission_add', [PermissionController::class, 'add'])->name('permission.add');
Route::post('/permission_add', [PermissionController::class, 'submit_add'])->name('permission.submit_add');
Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
Route::put('/permission', [PermissionController::class, 'update']);
Route::delete('/permission/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');



















