<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Model\Admin\Video;
use App\Http\Model\Admin\Ebook;
use App\Http\Model\Admin\Exam;
use App\Http\Model\Admin\About;
use App\Http\Model\Admin\Aboutcate;
use App\Http\Model\Admin\Footnav;
use App\Http\Model\Admin\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('home.*',function($view){
            $video=Video::orderBy('video_id','desc')->pluck('video_id')->first();
            $ebook=Ebook::orderBy('ebook_id','desc')->pluck('ebook_id')->first();
            $exam=Exam::orderBy('exam_id','desc')->pluck('exam_id')->first();
            $aboutcate=Aboutcate::orderBy('about_cate_id','desc')->pluck('about_cate_name','about_cate_id');
            $footnav=Footnav::orderBy('footnav_id','desc')->get();
            $view->with('nav_id',array('video'=>$video,'ebook'=>$ebook,'exam'=>$exam,'aboutcate'=>$aboutcate));
            $view->with('footnav',$footnav);
        });

        view()->composer('admin.*',function($view){
            $nickname=User::where('username',session('admin'))->pluck('nickname')->first();
            $view->with('nickname',$nickname);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
