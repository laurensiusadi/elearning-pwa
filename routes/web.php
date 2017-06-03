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
    return redirect('/')->with('message', 'Log out successfully');
});
Route::get('/offline', function(){
    return view('offline');
});

// Route::post('/plagiarism', 'PlagiarismController@check');
// Route::get('/plagiarism/{classroom}/{quiz}/{filter}', 'PlagiarismController@index');
// Route::get('/plagiarism/{classroom}/{quiz}/{filter}/{nrp}', 'PlagiarismController@show');
//
// Route::post('/similarity', 'SimilarityController@check');
// Route::get('/similarity/{classroom}/{quiz}', 'SimilarityController@index');
// Route::get('/similarity/{classroom}/{quiz}/{nrp}', 'SimilarityController@show');

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
        // Route::resource('/convention', 'ConventionController');
        Route::resource('/classroom', 'ClassroomController');
        Route::resource('/enroll', 'EnrollController');
    });


Route::group(['middleware' => ['auth', 'acl'],
    'is' => env('ROLE_DOSEN')],
    function () {
        Route::group(['middleware' => ['enroll']],
        function () {
            Route::get('/classroom/{id}/quiz/create', 'QuizController@create');
            Route::post('/classroom/{id}/quiz', 'QuizController@store');
            Route::get('/classroom/{id}/quiz/{quiz_id}/edit', 'QuizController@edit');
            Route::put('/classroom/{id}/quiz/{quiz_id}', 'QuizController@update');
            Route::delete('/classroom/{id}/quiz/{quiz_id}', 'QuizController@destroy');
            Route::get('/classroom/{id}/quiz/{quiz_id}/question/create', 'QuizQuestionController@create');
        });
        Route::resource('/question', 'QuestionController');
        Route::resource('/quizquestion', 'QuizQuestionController');
        Route::post('/question/{question_id}/key', 'KeyController@store');
        Route::put('/question/{question_id}/key/{key_id}', 'KeyController@update');
        Route::delete('/question/{question_id}/key/{key_id}', 'KeyController@destroy');
    });

Route::group(['middleware' => ['auth', 'acl', 'enroll'],
    'is' => env('ROLE_MHS')],
    function () {
        Route::get('/classroom/{id}/quiz/{quiz_id}/question/{question_id}', 'QuizQuestionController@show');
        Route::put('/classroom/{id}/quiz/{quiz_id}/question/{question_id}/answer', 'AnswerController@update');
        Route::put('/classroom/{id}/quiz/{quiz_id}/question/{question_id}/answer/done', 'AnswerController@done');
    });

Route::group(['middleware' => ['auth', 'acl'],
    'is' => env('ROLE_ADMIN').'|'.env('ROLE_DOSEN')],
    function () {
        Route::resource('/post', 'PostController');
    });

Route::group(['middleware' => ['auth', 'acl'],
    'is' => env('ROLE_DOSEN').'|'.env('ROLE_MHS')],
    function () {
        // Route::get('/convention/getregex/{for}', 'ConventionController@getConventionRule');
        // Route::get('/convention/getconvmessage/{for}', 'ConventionController@getConventionMessage');
        // Route::get('/convention/getconvmin/{for}', 'ConventionController@getConventionMinimal');

        Route::group(['middleware' => ['enroll']],
        function () {
            Route::get('/enroll', 'EnrollController@index');
            Route::get('/classroom/{id}/quiz', 'QuizController@index');
            Route::get('/classroom/{id}/quiz/{quiz_id}', 'QuizController@show');
            Route::get('/classroom/{id}/quiz/{quiz_id}/question', 'QuizQuestionController@index');
            Route::get('/classroom/{id}/quiz/{quiz_id}/answer', 'AnswerController@index');
            Route::get('/classroom/{id}/quiz/{quiz_id}/answer/{answer_id}', 'AnswerController@show');
        });
    });
