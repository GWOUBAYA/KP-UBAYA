<?php

use App\Http\Controllers\LoginController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/home');
});

// Auth::routes();
Auth::routes(['verify' => true]);
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('authe.register');
$this->post('register', 'RegisterController@store')->name('authe.register')->middleware('verified');;

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('auth.password.email');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/tests/essay', 'TestsController@essay')->name('tests.essay');
    Route::resource('tests', 'TestsController');

    Route::resource('roles', 'RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'UsersController');
    Route::post('users_mass_destroy', ['uses' => 'UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('user_actions', 'UserActionsController');
    Route::resource('topics', 'TopicsController');
    Route::post('topics_mass_destroy', ['uses' => 'TopicsController@massDestroy', 'as' => 'topics.mass_destroy']);
    Route::resource('essay', 'EssayController');
    Route::post('essay_mass_destroy', ['uses' => 'EssayController@massDestroy', 'as' => 'essay.mass_destroy']);
    Route::resource('essay_answers', 'QuestionsOptionsController');
    Route::post('essay_answers_mass_destroy', ['uses' => 'QuestionsOptionsController@massDestroy', 'as' => 'essay_answers.mass_destroy']);
    Route::resource('questions', 'QuestionsController');
    Route::post('questions_mass_destroy', ['uses' => 'QuestionsController@massDestroy', 'as' => 'questions.mass_destroy']);
    Route::resource('questions_options', 'QuestionsOptionsController');
    Route::post('questions_options_mass_destroy', ['uses' => 'QuestionsOptionsController@massDestroy', 'as' => 'questions_options.mass_destroy']);
    Route::resource('results', 'ResultsController');
    Route::post('results_mass_destroy', ['uses' => 'ResultsController@massDestroy', 'as' => 'results.mass_destroy']);
    Route::put('/essaycek/{id}', 'ResultsController@essayCek')->name("essaycek");
    Route::put('/accept/{id}', 'ResultsController@updateAcc')->name("acc");
    Route::put('/decline/{id}', 'ResultsController@updateDec')->name("dec");
    Route::put('/accept2/{id1}/{id2}', 'ResultsController@updateAcc2')->name("acc2");
    Route::put('/decline2/{id1}/{id2}', 'ResultsController@updateDec2')->name("dec2");

    // Route::put('/download/{id}', 'ResultsController@updateAcc')->name("download");
    Route::get('/download/{file}', 'ResultsController@download');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');