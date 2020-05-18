<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
class StatusesController extends Controller
{
//    只有登录用户可以访问此控制器
    public function __construct()
    {
        $this->middleware('auth');
    }
//    发布微博
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);
        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);
        session()->flash('success', '发布成功');
        return back();
    }
//    删除微博
    public function destroy(Status $status)
    {
        $this->authorize('destroy', $status);

        $status->delete();
        session()->flash('info', '该条微博已被删除');

        return back();
    }
}
