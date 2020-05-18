<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaticPagesController extends Controller
{
//    首页
    public function home()
    {
        $feed_items = [];

        if (Auth::check())
        {
//            媒体流，包含用户的微博与用户关注人的微博
            $feed_items = Auth::user()->feed()->paginate(15);
        }
        return view('static_pages.home', compact('feed_items'));
    }
//    关于页
    public function about()
    {
        return view('static_pages.about');
    }
//    帮助页
    public function help()
    {
        return view('static_pages.help');
    }
}
