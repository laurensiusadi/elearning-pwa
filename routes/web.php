<?php

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

Auth::routes();

Route::get('/', function(){
    return view('welcome');
});
Route::get('/home', 'HomeController@index');
Route::post('/compile', 'HomeController@compile');
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});
Route::get('/offline', function(){
    return view('offline');
});

Route::post('/plagiarism', 'PlagiarismController@check');
Route::get('/plagiarism/{classroom}/{quiz}/{filter}', 'PlagiarismController@index');
Route::get('/plagiarism/{classroom}/{quiz}/{filter}/{nrp}', 'PlagiarismController@show');

Route::post('/similarity', 'SimilarityController@check');
Route::get('/similarity/{classroom}/{quiz}', 'SimilarityController@index');
Route::get('/similarity/{classroom}/{quiz}/{nrp}', 'SimilarityController@show');

// Route::get('/', function () {
// 	return view('welcome');
// });

Route::group(['middleware' => ['auth', 'acl'],
    'is' => env('ROLE_ADMIN')],
    function () {
        Route::resource('/user', 'UserController');
        Route::resource('/roleuser', 'RoleUserController');
        Route::resource('/role', 'RoleController');
        Route::resource('/permissionrole', 'PermissionRoleController');
        Route::resource('/permission', 'PermissionController');
        Route::resource('/permissionuser', 'PermissionUserController');
        Route::resource('/period', 'PeriodController');
        Route::resource('/subject', 'SubjectController');
        Route::resource('/convention', 'ConventionController');
        Route::resource('/classroom', 'ClassroomController');
        Route::resource('/enroll', 'EnrollController');
    });


Route::group(['middleware' => ['auth', 'acl'],
    'is' => env('ROLE_DOSEN')],
    function () {
        Route::get('/classroom/{id}/quiz/create', 'QuizController@create');
        Route::post('/classroom/{id}/quiz', 'QuizController@store');
        Route::get('/quiz/{id}/edit', 'QuizController@edit');
        Route::put('/quiz/{id}', 'QuizController@update');
        Route::delete('/quiz/{id}', 'QuizController@destroy');
    });

Route::group(['middleware' => ['auth', 'acl'],
    'is' => env('ROLE_MHS')],
    function () {
        Route::get('/quiz/{id}/answer/create', 'AnswerController@create');
        Route::post('/quiz/{id}/answer', 'AnswerController@store');
        Route::get('/quiz/{id}/answer/{answer_id}/edit', 'AnswerController@edit');
        Route::put('/quiz/{id}/answer/{answer_id}', 'AnswerController@update');
        Route::delete('/quiz/{id}/answer/{answer_id}', 'AnswerController@destroy');
    });

Route::group(['middleware' => ['auth', 'acl'],
    'is' => env('ROLE_ADMIN').'|'.env('ROLE_DOSEN')],
    function () {
        Route::resource('/post', 'PostController');
    });

Route::group(['middleware' => ['auth', 'acl'],
    'is' => env('ROLE_DOSEN').'|'.env('ROLE_MHS')],
    function () {
        Route::get('/enroll', 'EnrollController@index');

        Route::get('/convention/getregex/{for}', 'ConventionController@getConventionRule');
        Route::get('/convention/getconvmessage/{for}', 'ConventionController@getConventionMessage');
        Route::get('/convention/getconvmin/{for}', 'ConventionController@getConventionMinimal');

        Route::get('/classroom/{id}/quiz', 'QuizController@index');
        Route::get('/classroom/{id}/quiz/{quiz_id}', 'QuizController@show');

        Route::get('/quiz/{id}/question', 'QuestionController@index');
        Route::get('/quiz/{id}/question/{question_id}', 'QuestionController@show');

        Route::get('/quiz/{quiz_id}/answer', 'AnswerController@index');
        Route::get('/quiz/{quiz_id}/answer/{answer_id}', 'AnswerController@show');
    });
