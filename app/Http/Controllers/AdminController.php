<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    /*
     * список подрядчиков \удалить \добавить \редактировать
     * список обьявлений \удалить \добавить \редактировать \одобрить
     * список городов \удалить \добавить
     * список категорий \удалить \добавить    
     * список пользователей \удалить \изменить роль
     */
    public function _constract(Request $request)
    {
        $this->middleware('role');
    }
    
    public function admin(Request $request)
    {
        $user_contractors = $request->user()->contractors()->get();
        return view('admin.admin_main', ['user_contractors' => $user_contractors]);
    }
    
    public function blogAdmin(Request $request)
    {
        $user_contractors = $request->user()->contractors()->get();
        return view('admin.admin_main', ['user_contractors' => $user_contractors]);
    }
    
    public function adManager(Request $request)
    {
        $user_contractors = $request->user()->contractors()->get();
        return view('admin.admin_main', ['user_contractors' => $user_contractors]);
    }
    
    public function requestManager(Request $request)
    {
        $user_contractors = $request->user()->contractors()->get();
        return view('admin.admin_main', ['user_contractors' => $user_contractors]);
    }
}
