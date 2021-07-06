<?php

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
//HOME
Route::get('/admin-home', 'HomeController@index');
Route::get('/profile/{admin_id}', 'HomeController@profile');
Route::get('/process-payment-customer/{customer_id}/{payment_history_id}', 'HomeController@process_payment_customer');
Route::get('/xac-nhan-thanh-toan/{customer_id}/{payment_history_id}', 'HomeController@xac_nhan_thanh_toan');
Route::get('/list-payment', 'HomeController@payment');
Route::get('/view-list-register-author', 'HomeController@view_list_register_author');


//ADMIN

Route::get('/admin','AdminController@login');
Route::get('/list-admin','AdminController@all');
Route::get('/add-admin','AdminController@add');
Route::get('/edit-admin/{admin_id}','AdminController@edit');
Route::get('/delete-admin/{admin_id}','AdminController@delete');
Route::post('/update-admin/{admin_id}','AdminController@update');
Route::post('/save-admin','AdminController@save');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout','AdminController@logout');
Route::get('/lock-admin/{customer_id}','AdminController@lock');
Route::post('/searchAdmin','ajaxController@searchAdmin');

//CUSTOMER

// Route::get('/admin','CustomerController@login');
Route::post('/login-customer-request','CustomerController@homepage');
Route::get('/list-customer','CustomerController@all');
Route::get('/add-customer','CustomerController@add');
Route::post('/save-customer','CustomerController@save');
Route::get('/title-customer/{customer_id}','CustomerController@title');
Route::get('/lock-customer/{customer_id}','CustomerController@lock');
Route::get('/edit-customer/{customer_id}','CustomerController@edit');
Route::post('/update-customer/{customer_id}','CustomerController@update');
Route::get('/delete-customer/{customer_id}','CustomerController@delete');
Route::get('/profile-customer-admin/{customer_id}','CustomerController@profile');

Route::post('/searchCustomer','ajaxController@searchCustomer');
Route::get('/logout-customer','CustomerController@logout');
Route::get('/register-customer','CustomerController@register');
Route::get('/process-register-author/{customer_id}/{register_author_id}','CustomerController@process_register_author');
Route::post('/register-customer-request','CustomerController@register_request');
Route::post('/add-more-cash/{customer_id}','CustomerController@add_more_cash');


//CATEGORY
Route::get('/list-category','CategoryComic@all');
Route::get('/add-category','CategoryComic@add');
Route::post('/save-category','CategoryComic@save');
Route::get('/change-status-category/{cate_id}','CategoryComic@changestatus');
Route::get('/edit-category/{cate_id}','CategoryComic@edit');
Route::post('/update-category/{cate_id}','CategoryComic@update');
Route::get('/delete-category/{cate_id}','CategoryComic@delete');

//COMIC
Route::get('/list-comic','ComicController@all');
Route::get('/add-comic','ComicController@add');
Route::post('/save-comic','ComicController@save');
Route::get('/display-comic/{comic_id}','ComicController@display');
Route::get('/approved-comic/{comic_id}','ComicController@approved');
Route::get('/edit-comic/{comic_id}','ComicController@edit');
Route::post('/update-comic/{comic_id}','ComicController@update');
Route::get('/delete-comic/{comic_id}','ComicController@delete');
// Route::get('/pagination/{tung_trang}/{sp_tung_trang}','ComicController@delete');
Route::post('/searchComic','ajaxController@searchComic');
Route::get('/rating-comic/{comic_id}/{rating}','ComicController@rating_comic');
Route::get('/back-to-add-comic/{session_id}','ComicController@back_to_add');
Route::get('/back-to-add-comic-client/{session_id}','ComicController@back_to_add_client');
Route::post('/search-comic-vip','ComicController@searchComic');
Route::get('/phantrang/{cate_id}/{comic_name}/{trang}','ComicController@phantrang');


//CHAPTER
Route::get('/list-chapter/{comic_id}','ChapterController@all');
Route::get('/add-chapter/{comic_id}','ChapterController@add');
Route::post('/save-chapter','ChapterController@save');
Route::get('/edit-chapter/{chapter_id}/{comic_id}','ChapterController@edit');
Route::get('/approved-chapter/{chapter_id}/{comic_id}','ChapterController@approved');
Route::post('/update-chapter/{chapter_id}','ChapterController@update_chapter');
Route::get('/delete-chapter/{chapter_id}/{comic_id}','ChapterController@delete');
// Route::get('/pagination/{tung_trang}/{sp_tung_trang}','ComicController@delete');
Route::post('/searchChapter','ChapterController@search');
Route::post('/unlock-chapter','ChapterController@unlock_chapter');



//Cover Image
Route::get('/list-cover-image','CoverImageController@all');

Route::get('/add-cover-image','CoverImageController@add');
Route::post('/save-cover-image','CoverImageController@save');
Route::get('/edit-cover-image/{coverimg_id}','CoverImageController@edit');
Route::get('/change-status-cover-image/{coverimg_id}','CoverImageController@changestatus');
Route::post('/update-cover-image/{coverimg_id}','CoverImageController@update');
Route::get('/delete-cover-image/{coverimg_id}','CoverImageController@delete');
// Route::post('/searchComic','ajaxController@searchComic');

Route::get('/choose-cover-image','CoverImageController@choose');
Route::post('/add-coverimg-comic','CoverImageController@add_coverimg_comic');

//HOMEPAGE
Route::get('/','HomeController@homepage');
Route::get('/visit-comic/{comic_id}','ComicController@visit');
Route::get('/read-comic/{comic_id}','ComicController@read');
Route::get('/read-chapter/{chapter_id}','ChapterController@read');
Route::get('/login-customer','HomeController@login');
Route::get('/profile-customer/{customer_id}','HomeController@profile_customer');

//ORDER 
Route::get('/list-order','OrderController@all');
Route::get('/delete-order/{order_id}','OrderController@delete');
Route::post('/searchorder','ajaxController@searchorder');
Route::post('/search-payment','ajaxController@searchPayment');
Route::post('/loc-order','OrderController@loc_order');


//AUTHOR
Route::get('/list-comic-author/{author_id}','AuthorController@all');
Route::get('/author-center','AuthorController@author_center');
Route::get('/create-comic-client','AuthorController@create');
Route::post('/save-comic-client','AuthorController@save');
Route::post('/add-coverimg-comic-client','AuthorController@add_coverimg_comic');
Route::get('/choose-cover-image-client','AuthorController@choose_cover_image');
Route::post('/update-coverimg-comic-client/{comic_id}','AuthorController@update_coverimg_comic');
Route::get('/view-add-chapter/{comic_id}','AuthorController@view_add_chapter');
Route::get('/view-list-chapter/{comic_id}','AuthorController@view_list_chapter');
Route::get('/list-chapter-client/{comic_id}','AuthorController@view_list_chapter');
Route::post('/add-chapter-client','AuthorController@add_chapter');
Route::get('/delete-chapter-client/{chapter_id}/{comic_id}','AuthorController@delete_chapter');
Route::get('/edit-chapter-client/{chapter_id}/{comic_id}','AuthorController@view_update_chapter');

Route::post('/update-chapter-client/{chapter_id}','AuthorController@update_chapter');
Route::get('/delete-comic-client/{comic_id}','AuthorController@delete_comic');
Route::get('/view-update-comic/{comic_id}','AuthorController@view_update_comic');
Route::post('/update-comic-client/{comic_id}','AuthorController@update_comic');
Route::get('/edit-coverimg-comic-client/{comic_id}','AuthorController@view_update_coverimg_comic');


//PROFILE CUSTOMER
Route::get('/view-add-infor-customer/{customer_id}','HomeController@view_add_profile');
Route::get('/register-author-client/{customer_id}','CustomerController@register_author_client');
Route::get('/payment-this-customer/{customer_id}','CustomerController@payment_this_customer');
Route::post('/add-customer-profile/{customer_id}','CustomerController@add_profile');

//COMMENT
Route::post('/add-comment','CommentController@add_comment');

// OTHER
Route::post('/validate-email','ajaxController@validate_email');
Route::post('/validate-email-customer','ajaxController@validate_email_customer');
Route::get('/reset-number-noti/{customer_id}','ajaxController@reset_number_noti');
Route::get('/see-cate-client/{cate_id}','CategoryComic@see_cate_client');
Route::get('/see-comic-gender/{comic_gender}','ComicController@see_comic_gender');
Route::get('/see-all-comic','ComicController@see_all_comic');
Route::post('/search-comic-client','ComicController@search_comic_client');
Route::post('/update-content-chapter','ajaxController@update_content_chapter');
Route::post('/update-content-chapter-admin','ajaxController@update_content_chapter_admin');


// THỐNG KÊ
Route::post('/fillter-by-date','HomeController@fillter_by_date');
Route::post('/napthe','CustomerController@nap_the');