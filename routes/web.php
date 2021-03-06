<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AppointController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserAuthController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::view('/coming-soon', 'coming-soon')->name('commingsoon');

Route::group(['middleware' => 'commingsoon'], function () {
    Route::view('/', 'index')->name('home');
    Route::view('/contact', 'contact.index')->name('contact');
    Route::get('/service',[ServiceController::class,'index'])->name('service');
    Route::get('/about',[AboutController::class,'index'])->name('about');
    Route::get('/portfolio',[PortfolioController::class,'index'])->name('portfolio');
    Route::get('/privacy-policy',[PolicyController::class,'index'])->name('policy');
    Route::get('/faq',[FaqController::class,'index'])->name('faq');
    Route::view('/appointment', 'contact.appointment')->name('appointment');
});

Route::match(['GET', 'POST'], 'admin/login', [UserAuthController::class,'login'])->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function(){
        Route::view('/dashboard', 'dashboard')->name('dashboard');
        Route::get('logout',[UserAuthController::class, 'logout'])->name('logout');

        Route::prefix('slider')->group(function(){
            Route::get('/',[SliderController::class,'add'])->name('slider.add');
            Route::post('/submit',[SliderController::class,'submit'])->name('slider.submit');
            Route::match(['get', 'post'], '/edit/{slider}', [SliderController::class, 'edit'])->name('slider.edit');
            Route::get('/delete/{slider}',[SliderController::class,'delete'])->name('slider.delete');
        });

        Route::prefix('header-settings')->group(function(){
            Route::get('/',[HeaderController::class,'index'])->name('header.settings');
            Route::post('/edit/{header}',[HeaderController::class,'edit'])->name('header.edit');
        });

        Route::prefix('about')->group(function(){
            Route::get('/',[AboutController::class,'add'])->name('about.add');
            Route::post('/edit/{about}',[AboutController::class,'edit'])->name('about.edit');
        });

        Route::prefix('portfolio')->group(function(){
            Route::get('/',[PortfolioController::class,'add'])->name('portfolio.add');
            Route::post('/tag',[PortfolioController::class,'tag'])->name('portfolio.tag');
            Route::get('/tag-del/{tag}',[PortfolioController::class,'tagDel'])->name('portfolio.tag.delete');
            Route::post('/submit',[PortfolioController::class,'submit'])->name('portfolio.submit');
            Route::get('/delete/{porto}',[PortfolioController::class,'delete'])->name('portfolio.delete');
        });

        Route::prefix('services')->group(function(){
            Route::get('/',[ServiceController::class,'add'])->name('services.add');
            Route::post('/submit',[ServiceController::class,'submit'])->name('services.submit');
            Route::match(['get', 'post'], '/edit/{service}', [ServiceController::class, 'edit'])->name('services.edit');
            Route::get('/delete/{service}',[ServiceController::class,'delete'])->name('services.delete');
        });

        Route::prefix('testimonial')->group(function(){
            Route::get('/',[TestimonialController::class,'add'])->name('testimonial.add');
            Route::post('/submit',[TestimonialController::class,'submit'])->name('testimonial.submit');
            Route::match(['get', 'post'], '/edit/{testimonial}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
            Route::get('/delete/{testimonial}',[TestimonialController::class,'delete'])->name('testimonial.delete');

        });

        Route::prefix('brands')->group(function(){
            Route::get('/',[BrandController::class,'add'])->name('brands.add');
            Route::post('/submit',[BrandController::class,'submit'])->name('brands.submit');
            Route::get('/delete/{brand}',[BrandController::class,'delete'])->name('brands.delete');
        });

        Route::prefix('activity')->group(function(){
            Route::get('/',[ActivityController::class,'add'])->name('activity.add');
            Route::post('/edit/{activity}',[ActivityController::class,'edit'])->name('activity.edit');
        });

        Route::prefix('skills')->group(function(){
            Route::get('/',[SkillController::class,'add'])->name('skills.add');
            Route::post('/edit/{skill}',[SkillController::class,'edit'])->name('skills.edit');
        });

        Route::prefix('offer')->group(function(){
            Route::get('/',[OfferController::class,'add'])->name('offer.add');
            Route::post('/edit/{offer}',[OfferController::class,'edit'])->name('offer.edit');
        });

        Route::prefix('footer-setting')->group(function(){
            Route::get('/',[FooterController::class,'add'])->name('footer.add');
            Route::post('/edit/{footer}',[FooterController::class,'edit'])->name('footer.edit');
        });

        Route::prefix('appoint')->group(function(){
            Route::get('/',[AppointController::class,'add'])->name('appoint.add');
            Route::post('/submit',[AppointController::class,'submit'])->name('appoint.submit');

            Route::post('/carbrand',[AppointController::class,'carbrand'])->name('carbrand.submit');
            Route::get('/carbrand/delete/{carbrand}',[AppointController::class,'cardel'])->name('carbrand.delete');

            Route::post('/bodystyle',[AppointController::class,'bodystyle'])->name('bodystyle.submit');
            Route::get('/bodystyle/delete/{bodystyle}',[AppointController::class,'bodydel'])->name('bodystyle.delete');

            Route::post('/location',[AppointController::class,'location'])->name('location.submit');
            Route::get('/location/delete/{location}',[AppointController::class,'locndel'])->name('location.delete');

            Route::post('/solution',[AppointController::class,'solution'])->name('solution.submit');
            Route::get('/solution/delete/{solution}',[AppointController::class,'solndel'])->name('solution.delete');
        });

        Route::prefix('privacy-policy')->group(function(){
            // Route::view('/pp', 'back.addPrivacyPolicy');
            Route::get('/',[PolicyController::class,'add'])->name('privacy.policy.show');
            Route::post('/edit/{privacy}',[PolicyController::class,'edit'])->name('privacy.policy.edit');
        });

        Route::prefix('faq')->group(function(){
            Route::get('/',[FaqController::class,'add'])->name('faq.add');
            Route::post('/submit',[FaqController::class,'submit'])->name('faq.submit');
            Route::post('/edit/{faq}',[FaqController::class,'edit'])->name('faq.edit');
            Route::get('/delete/{faq}',[FaqController::class,'delete'])->name('faq.delete');
        });

    });
});
