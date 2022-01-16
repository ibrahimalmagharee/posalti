<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\HomeController;
use App\Models\Concat;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Company;
use App\Models\Course;
use App\Models\News;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\Landing\HomeController::class, 'index'])->name('index');

Route::prefix('{locale}')->group(function () {

    Route::get('/', [App\Http\Controllers\Landing\HomeController::class, 'index'])->name('index');
    Route::get('/about', [App\Http\Controllers\Landing\AboutController::class, 'index'])->name('about');
    Route::get('/contact', [App\Http\Controllers\Landing\HomeController::class, 'contact'])->name('contact');
    Route::post('/contact', [App\Http\Controllers\Landing\ConcatController::class, 'store'])->name('store.contact');

    Route::get('/login', [App\Http\Controllers\Landing\HomeController::class, 'login'])->name('login');
    Route::get('/register', [App\Http\Controllers\Landing\HomeController::class, 'register'])->name('register');

    Route::post('/user-login', [App\Http\Controllers\Auth\LoginController::class, 'user_login'])->name('user.login');
    Route::post('/user-register', [App\Http\Controllers\User\RegisterController::class, 'store'])->name('user.register');

    Route::group(['prefix' => 'news'], function (){
        Route::get('/', [App\Http\Controllers\Landing\NewController::class, 'index'])->name('news');
        Route::get('show/{new}', [App\Http\Controllers\Landing\NewController::class, 'show'])->name('show.new');
    });

    Route::group(['prefix' => 'settings'], function (){
        Route::get('/edit-account', [App\Http\Controllers\User\SettingsController::class, 'account_information'])->name('user.accountInformation')->middleware('auth','is_user');
        Route::post('/edit-account', [App\Http\Controllers\User\SettingsController::class, 'update_information'])->name('user.updateAccountInformation')->middleware('auth','is_user');

        Route::get('/change-password', [App\Http\Controllers\User\SettingsController::class, 'password'])->name('user.password')->middleware('auth','is_user');
        Route::post('/change-password', [App\Http\Controllers\User\SettingsController::class, 'change_password'])->name('user.changePassword')->middleware('auth','is_user');
    });

    Route::get('/registration-form', [App\Http\Controllers\User\StudentRegisterFormController::class, 'index'])->name('user.studentRegisterForm');
    Route::post('/registration-form', [App\Http\Controllers\User\StudentRegisterFormController::class, 'store'])->name('user.store.studentRegisterForm');

    Route::get('/terms-of-registration', [App\Http\Controllers\User\TermsOfRegisterController::class, 'index'])->name('user.termsofregistration');

    Route::get('/payment', [App\Http\Controllers\User\PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment', [App\Http\Controllers\User\PaymentController::class, 'store'])->name('payment.store');
    Route::get('/check-payment', [App\Http\Controllers\User\PaymentController::class, 'check_payment'])->name('payment.check_payment');
    Route::get('/checked-payment', [App\Http\Controllers\User\PaymentController::class, 'index_checked_payment'])->name('index.payment.checked_payment');

    //admin
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'admin_login'])->name('admin.login');
    Route::get('/admin/login', [App\Http\Controllers\Admin\LoginController::class, 'index'])->name('login.view');

});

Route::group(['prefix' => 'en/admin'], function (){

    Auth::routes(['register'=> false,'login' =>false]);

    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home')->middleware(['auth','is_admin']);

    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'create'])->name('admin.profile.create');
    Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/index', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [App\Http\Controllers\Admin\AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.store');
    Route::get('/{user}/edit', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/{user}/update', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('admin.update');
    Route::delete('/{user}/delete', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('admin.destroy');

    Route::group(['prefix' => 'client'], function (){
        Route::get('/index', [App\Http\Controllers\Admin\ClientController::class, 'index'])->name('client.index');
        Route::get('/create', [App\Http\Controllers\Admin\ClientController::class, 'create'])->name('client.create');
        Route::post('/store', [App\Http\Controllers\Admin\ClientController::class, 'store'])->name('client.store');
        Route::get('/{user}/edit', [App\Http\Controllers\Admin\ClientController::class, 'edit'])->name('client.edit');
        Route::post('/{user}/update', [App\Http\Controllers\Admin\ClientController::class, 'update'])->name('client.update');
        Route::delete('/{user}/delete', [App\Http\Controllers\Admin\ClientController::class, 'destroy'])->name('client.destroy');
    });

    // financial
    Route::group(['prefix' => 'financial'], function (){
        Route::get('/index', [App\Http\Controllers\Admin\FinancialController::class, 'index'])->name('financial.index');
        Route::post('/store/{user_id}', [App\Http\Controllers\Admin\FinancialController::class, 'store'])->name('financial.store');
        Route::get('/{financial}/edit', [App\Http\Controllers\Admin\FinancialController::class, 'edit'])->name('financial.edit');
        Route::post('/{financial}/update', [App\Http\Controllers\Admin\FinancialController::class, 'update'])->name('financial.update');
        Route::delete('/{financial}/delete', [App\Http\Controllers\Admin\FinancialController::class, 'destroy'])->name('financial.destroy');

        Route::get('/titles/{title_id}/students/create', [App\Http\Controllers\Admin\FinancialStudentsController::class, 'create'])->name('financial.students');
        Route::post('/titles/{title_id}/students', [App\Http\Controllers\Admin\FinancialStudentsController::class, 'store']);
    });

    //concat
    Route::group(['prefix' => 'messages'], function (){
        Route::get('/', [App\Http\Controllers\Admin\ConcatController::class, 'index'])->name('concat.index');
    });

    //about
    Route::group(['prefix' => 'about'], function (){
        Route::get('/', [App\Http\Controllers\Admin\AboutController::class, 'create'])->name('about.create');
        Route::post('/store', [App\Http\Controllers\Admin\AboutController::class, 'store'])->name('about.store');
    });

    //companies
    Route::group(['prefix' => 'company'], function (){
        Route::get('/', [App\Http\Controllers\Admin\CompanyController::class, 'index'])->name('company.index');
        Route::get('/create', [App\Http\Controllers\Admin\CompanyController::class, 'create'])->name('company.create');
        Route::post('/', [App\Http\Controllers\Admin\CompanyController::class, 'store'])->name('company.store');
        Route::get('/{company}/edit', [App\Http\Controllers\Admin\CompanyController::class, 'edit'])->name('company.edit');
        Route::get('/{company}', [App\Http\Controllers\Admin\CompanyController::class, 'show'])->name('company.show');
        Route::post('/{company}', [App\Http\Controllers\Admin\CompanyController::class, 'update'])->name('company.update');
        Route::delete('/{company}', [App\Http\Controllers\Admin\CompanyController::class, 'destroy'])->name('company.destroy');
    });

    //founders
    Route::group(['prefix' => 'founder'], function (){
        Route::get('/', [App\Http\Controllers\Admin\FounderController::class, 'index'])->name('founder.index');
        Route::get('/create', [App\Http\Controllers\Admin\FounderController::class, 'create'])->name('founder.create');
        Route::post('/', [App\Http\Controllers\Admin\FounderController::class, 'store'])->name('founder.store');
        Route::get('/{founder}/edit', [App\Http\Controllers\Admin\FounderController::class, 'edit'])->name('founder.edit');
        Route::get('/{founder}', [App\Http\Controllers\Admin\FounderController::class, 'show'])->name('founder.show');
        Route::post('/{founder}', [App\Http\Controllers\Admin\FounderController::class, 'update'])->name('founder.update');
        Route::delete('/{founder}', [App\Http\Controllers\Admin\FounderController::class, 'destroy'])->name('founder.destroy');
    });

    //social
    Route::group(['prefix' => 'social-media'], function (){
        Route::get('/', [App\Http\Controllers\Admin\SocialController::class, 'index'])->name('social.index');
        Route::get('/create', [App\Http\Controllers\Admin\SocialController::class, 'create'])->name('social.create');
        Route::post('/', [App\Http\Controllers\Admin\SocialController::class, 'store'])->name('social.store');
        Route::get('/{social}/edit', [App\Http\Controllers\Admin\SocialController::class, 'edit'])->name('social.edit');
        Route::get('/{social}', [App\Http\Controllers\Admin\SocialController::class, 'show'])->name('social.show');
        Route::post('/{social}', [App\Http\Controllers\Admin\SocialController::class, 'update'])->name('social.update');
        Route::delete('/{social}', [App\Http\Controllers\Admin\SocialController::class, 'destroy'])->name('social.destroy');
    });

    //category
    Route::group(['prefix' => 'category'], function (){
        Route::delete('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('category.destroy');

        Route::group(['prefix' => 'news'], function (){
            Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.news.index');
            Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.news.create');
            Route::post('/', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.news.store');
            Route::get('/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.news.edit');
            Route::get('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('category.news.show');
            Route::post('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.news.update');
        });
    });

    //news
    Route::group(['prefix' => 'ournews'], function (){
        Route::get('/', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('news.index');
        Route::get('/create', [App\Http\Controllers\Admin\NewsController::class, 'create'])->name('news.create');
        Route::post('/', [App\Http\Controllers\Admin\NewsController::class, 'store'])->name('news.store');
        Route::get('/{new_serial}/edit', [App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('news.edit');
        Route::get('/{new_serial}', [App\Http\Controllers\Admin\NewsController::class, 'show'])->name('news.show');
        Route::post('/{new_serial}', [App\Http\Controllers\Admin\NewsController::class, 'update'])->name('news.update');
        Route::post('/delete/{new_serial}', [App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('news.destroy');
    });

    //registration forms
    Route::group(['prefix' => 'registraion-froms-stuents'], function (){
        Route::get('/', [App\Http\Controllers\Admin\RegistrationFormController::class, 'index'])->name('registraions.index');
    });

    //financial titles
    Route::group(['prefix' => 'financial/titles'], function (){
        Route::get('/', [App\Http\Controllers\Admin\FinancialTitleController::class, 'index'])->name('financial_titles.index');
        Route::get('/create', [App\Http\Controllers\Admin\FinancialTitleController::class, 'create'])->name('financial_titles.create');
        Route::post('/', [App\Http\Controllers\Admin\FinancialTitleController::class, 'store'])->name('financial_titles.store');
        Route::post('/store', [App\Http\Controllers\Admin\FinancialTitleController::class, 'store'])->name('financial_titles.store');
        Route::get('/{title}/edit', [App\Http\Controllers\Admin\FinancialTitleController::class, 'edit'])->name('financial_titles.edit');
        Route::post('/{title}/update', [App\Http\Controllers\Admin\FinancialTitleController::class, 'update'])->name('financial_titles.update');
    });
});
