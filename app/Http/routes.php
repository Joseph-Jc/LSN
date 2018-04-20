<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('adminer','Admin\LoginController@login');    //后台登录

Route::group(['middleware'=>'adminlogin','prefix'=>'admin','namespace'=>'Admin'], function(){
    Route::get('index','IndexController@index');    //首页
    Route::get('logout','IndexController@logout');  //退出
    Route::get('info','IndexController@info');  //控制面板
    Route::any('edit_nickname','IndexController@edit_nickname');  //修改名称
    Route::any('edit_password','IndexController@edit_password');  //修改密码
    Route::any('upload_img','IndexController@upload_img');  //editor的图片异步上传

    Route::get('videolist','VideoController@videolist');  //视频列表视图
    Route::get('video_list','VideoController@video_list');  //视频数据列表
    Route::any('upload_video','VideoController@upload_video');  //上传视频
    Route::any('upload','VideoController@upload');  //确认上传
    Route::any('video_del','VideoController@video_del');  //删除视频
    Route::any('video_edit','VideoController@video_edit');  //编辑视频标题
    Route::any('del_many_video','VideoController@del_many_video');  //批量删除视频
    Route::any('del_all_video','VideoController@del_all_video');  //全部删除视频

    Route::any('newlist','NewsController@newlist');
    Route::any('new_list','NewsController@new_list');
    Route::any('newedit','NewsController@newedit');
    Route::any('new_del','NewsController@new_del');
    Route::any('new_edit/{new_id}','NewsController@new_edit');
    Route::post('del_many_new','NewsController@del_many_new');
    Route::post('del_all_new','NewsController@del_all_new');

    Route::any('examlist','ExamController@examlist');
    Route::any('exam_list','ExamController@exam_list');
    Route::any('examedit','ExamController@examedit');
    Route::any('exam_del','ExamController@exam_del');
    Route::any('exam_edit/{exam_id}','ExamController@exam_edit');
    Route::post('del_many_exam','ExamController@del_many_exam');
    Route::post('del_all_exam','ExamController@del_all_exam');

    Route::any('aboutlist','AboutController@aboutlist');
    Route::any('about_list','AboutController@about_list');
    Route::any('aboutedit','AboutController@aboutedit');
    Route::any('about_del','AboutController@about_del');
    Route::any('about_edit/{exam_id}','AboutController@about_edit');
    Route::any('del_many_about','AboutController@del_many_about');
    Route::any('del_all_about','AboutController@del_all_about');

    Route::any('imgcarlist','ImgcarController@imgcarlist');
    Route::any('upload_imgcar','ImgcarController@upload_imgcar');
    Route::any('uploadimg','ImgcarController@uploadimg');
    Route::any('img_list','ImgcarController@img_list');
    Route::any('img_del','ImgcarController@img_del');
    Route::any('img_edit','ImgcarController@img_edit');
    Route::any('del_many_img','ImgcarController@del_many_img');
    Route::any('del_all_img','ImgcarController@del_all_img');

    Route::any('ebooklist','EbookController@ebooklist');
    Route::any('upload_ebook','EbookController@upload_ebook');
    Route::any('upload_thum','EbookController@upload_thum');
    Route::any('uploadebook','EbookController@uploadebook');
    Route::any('ebook_list','EbookController@ebook_list');
    Route::any('ebook_del','EbookController@ebook_del');
    Route::any('ebook_edit','EbookController@ebook_edit');
    Route::get('pdf/{ebook_id}','EbookController@pdf');
    Route::post('del_many_ebook','EbookController@del_many_ebook');
    Route::post('del_all_ebook','EbookController@del_all_ebook');

    Route::get('leavelist','LeaveController@leavelist');
    Route::get('leavelist_check','LeaveController@leavelist_check');
    Route::get('leave_list','LeaveController@leave_list');
    Route::any('leave_del','LeaveController@leave_del');
    Route::any('leave_check','LeaveController@leave_check');
    Route::any('check_many','LeaveController@check_many');
    Route::any('del_many','LeaveController@del_many');
    Route::any('del_all','LeaveController@del_all');
    Route::any('del_many_checked','LeaveController@del_many_checked');
    Route::any('del_all_checked','LeaveController@del_all_checked');

    Route::any('footnav','FootnavController@footnav');
    Route::any('footnav_list','FootnavController@footnav_list');
    Route::any('footnav_del','FootnavController@footnav_del');
    Route::any('del_many_footnav','FootnavController@del_many_footnav');
    Route::any('del_all_footnav','FootnavController@del_all_footnav');
});

Route::group(['namespace'=>'Home'], function(){
    Route::get('/','HomeController@home');
    Route::get('video/{video_id}','HomeController@video');
    Route::get('ebook/{ebook_id}','HomeController@ebook');
    Route::get('exam/{exam_id}','HomeController@exam');
    Route::get('exam_answer/{exam_id}','HomeController@exam_answer');
    Route::get('leave','HomeController@leave');
    Route::post('leave/upload_leave','HomeController@upload_leave');
    Route::any('leave/leave_list','HomeController@leave_list');
    Route::any('about/{about_id}','HomeController@about');
    Route::any('new_list','HomeController@new_list');
    Route::any('news/{nes_id}','HomeController@news');
});
