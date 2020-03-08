<?php


Auth::routes();
Auth::routes(['verify' => true]);

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('auth/google', 'RegistraionController@redirectToGoogle');
Route::get('auth/google/callback', 'RegistraionController@handleGoogleCallback');
Route::get('google', function () {
    return view('login');
});

// Route::get('/auth/facebook', 'SocialAuthFacebookController@redirect');
// Route::get('/auth/facebook/callback', 'SocialAuthFacebookController@callback');

// Email Verification Route(s)
//Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
//Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
//Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
//Logout
Route::get('logout',function(){
    Auth::logout();
    return redirect()->action('Qacontroller@index');
})->middleware("auth");


Route::get('/','Qacontroller@index');
Route::post('/load_data', 'Qacontroller@load_data')->name('loadmore.load_data');
Route::get('askme','Qacontroller@index')->name('ask_me');
//->middleware('verified');

Route::get('askme/{post_id}', 'Qacontroller@load_post');
Route::get('askme/search/cat_id={cat_id}', 'Qacontroller@load_category');
Route::get('askme/search/search={data}', 'Qacontroller@load_search');


//editcomment
Route::post('/editcomment','Qacontroller@editcomment');
//deleteComment
Route::post('/deletecomment','Qacontroller@deletecomment');
//
//Profile
Route::get('/profile','Qacontroller@profile')->name('profile');
Route::post('/editprofile','Qacontroller@editprofile');
Route::post('/editDescription','Qacontroller@editDescription');


Route::post('/question','Qacontroller@Qasearch');
//Question Search
Route::post('/search_question','Qacontroller@search_question');
Route::post('/find_question','Qacontroller@find_question');
//===============
Route::post('/answer','Qacontroller@answer');
Route::post('/addquestion','Qacontroller@addquestion')->name('addquestion');
Route::any('/viewanswer','Qacontroller@view')->name('viewanswer');
//Route::get('#','Qacontroller@index');

Route::post('/agree','Qacontroller@agree');
Route::post('/opposite','Qacontroller@oppo');
Route::post('/comment','Qacontroller@comment');
Route::post('/follow','Qacontroller@follow');
Route::post('/best','Qacontroller@best_answer');
//Answer Search
Route::post('/search_answer','Qacontroller@search_answer');
Route::post('/find_answer','Qacontroller@find_answer');

Route::get('howto','ArticleController@index');
Route::get('/howto/article', 'ArticleController@index');
Route::get('/howto/article/create', 'ArticleController@create');
Route::get('/howto/video', 'VideoController@index');
Route::get('/howto/video/create', 'VideoController@create');

Route::get('/admin', 'AdminCategoryController@login')->name('admin-login');
Route::any('/admin/sign', 'AdminCategoryController@signin')->name('admin-sign');
Route::get('/admin/forgot_password', 'AdminCategoryController@forgot_password')->name('admin-forgot');
Route::post('/admin/send_password', 'AdminCategoryController@send_password')->name('admin-send-password');
Route::any('/admin/reset_password', 'AdminCategoryController@reset_password')->name('admin-reset');

Route::any('/admin/reset_confirm_password', 'AdminCategoryController@reset_confirm_password')->name('admin-reset-confirm');


Route::prefix('admin')->name('admin.')->middleware(['auth.admin'])->group(function () {

    Route::resource('category', 'AdminCategoryController');
    Route::resource('user', 'AdminUserController');
    Route::resource('question', 'QuestionController');
    Route::resource('answer', 'AnswerController');
    Route::resource('comment', 'CommentController');
    Route::resource('article', 'AdminArticleController');
    Route::resource('video', 'AdminVideoController');
    Route::resource('videocomment', 'VideoCommentController');
    Route::resource('PageContent', 'PageContentController');
    Route::resource('googleAds', 'googleAdsController');
    Route::any('/changepassword', 'ChangePasswordController@index');
    Route::post('/confirmpassword', 'ChangePasswordController@confirm');

});


Route::get('/howto/video/search','VideoController@search');
Route::get('article/{art_id}/','ArticleController@showArticle');
Route::get('/howto/video/{video_id}/','VideoController@showVideo');

Route::post('/article/insert','ArticleController@store');
Route::post('/article/comment','ArticleController@addcomment');
Route::get('/howto/article/search','ArticleController@search');

Route::post('/howto/video/insert','VideoController@store');

Route::post('/video/comment','VideoController@addcomment');

Route::get('/article_category/{id}','ArticleController@category_select');
Route::get('/video_category/{id}','VideoController@category_select');


///////////image upload

Route::post('/imageUpload', 'ArticleController@imageUpload')->name('image_upload');

///////////

Route::get('page/{page_tag}', 'ArticleController@pageContent')->name('page_content');


