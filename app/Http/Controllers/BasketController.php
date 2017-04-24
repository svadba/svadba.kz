<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Advert;
use App\Cit;
use App\Basket_request;
use App\Http\Requests;

class BasketController extends Controller
{

    //функция показывает корзину заявки пользователю
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showBasket()
    {

        $cities = Cit::whereNotIn('id', [16,17,18])->get();

        if(!isset($_COOKIE['basket'])) return redirect('/');

        $cooks = $_COOKIE['basket'];

        $cooks = explode(',', $cooks);

        IF(!$cooks) return redirect('/');

        $bask_advert = Advert::whereIn('id', $cooks)->with('advert_categor')->with('photos')->get();

        return view('basket.basket_show', ['basket_adv' => $bask_advert, 'cities' => $cities, 'sn' => 'basket_show']);
    }


    //функция отправляет заявку от клиента админу и сохраняет в базу
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function sentBasket(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:50',
            'city' => 'required|numeric|exists:cits,id',
            'phone' => 'required|digits_between:6,12',
            'email' => 'email|string|max:50'
        ]);

        if(!isset($_COOKIE['basket']))  return redirect('/');


        $cooks = $_COOKIE['basket'];
        $cooks_array = explode(',', $cooks);
        if(!$cooks_array) return redirect('/');

        $gr = Basket_request::create([
                'name' => $request->name,
                'cit_id' => $request->city,
                'phone' => $request->phone,
                'email' => $request->email,
                'adverts' => $cooks,
                'ended' => 0,
                'ended_at' => null
        ]);

        $request_adverts = Advert::whereIn('id', $cooks_array)->with('advert_categor')->get();

        return view('basket.sented', ['br' => $gr, 'request_adverts' => $request_adverts]);

    }


    //Показать все заявки корзин из базы админу
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function basket_requests()
    {
        $baskets = Basket_request::paginate(20);
        return view('basket.baskets', ['baskets' => $baskets]);
    }


    //показать одну заявку в отдельном окне админу
    /**
     * @param Basket_request $basket
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_admin(Basket_request $basket_request)
    {
        $adverts = $basket_request->adverts;
        $adverts = explode(',',$adverts);
        $bask_advert = Advert::whereIn('id', $adverts)->with('advert_categor')->with('advert_stat')->with('advert_cits.cit')->with('contractor.phones')->get();
        return view('basket.admin_open', ['basket' => $basket_request, 'adverts' => $bask_advert]);
    }

    //сохраняет дату мероприятия
    public function save_tusa_date(Request $request, Basket_request $basket_request)
    {
        $this->validate($request, [
            'tusa_at' => 'date_format:Y-m-d G:i:s'
        ]);
        $basket_request->tusa_at = $request->tusa_at;
        $basket_request->save();
        return redirect()->back();
    }

    public function save_adverts_in_basket(Request $request, Basket_request $basket_request){
        $this->validate($request,[
            'adverts' => "array",
        ]);

        $adverts_string = '';

        foreach($request->adverts as $key=>$advert_name):
            if($advert_name)
            {
                $adverts_string.= $key.",";
            }
        endforeach;

        $adverts_string = substr($adverts_string, 0, -1);

        $explodeds = explode(',',$adverts_string);

        if($basket_request->adverts)
        {
            $basket_request->adverts = $basket_request->adverts.",".$adverts_string;
        }
        else
        {
            $basket_request->adverts = $adverts_string;
        }

        $basket_request->save();

        $bask_advert = Advert::whereIn('id', $explodeds)->with('advert_categor')->with('advert_stat')->with('advert_cits.cit')->with('contractor.phones')->get();

        return $bask_advert;
    }

    public function delete_advert(Request $request, Basket_request $basket_request)
    {
        $this->validate($request,[
            'delete_adverts' => 'required|string|max:200'
        ]);
        $adverts = explode(',',$basket_request->adverts);
        $del_adv = explode(',',$request->delete_adverts);
        $basket_request->adverts  = implode(',',array_diff($adverts,$del_adv));
        $basket_request->save();
        return redirect()->back();
    }

    public function delete_adverts(Request $request, Basket_request $basket_request)
    {
        $this->validate($request,[
            'delete_adverts' => 'required|array',
            'delete_adverts.*' => 'numeric'
        ]);
        $adverts = explode(',',$basket_request->adverts);
        $basket_request->adverts  = implode(',',array_diff($adverts,$request->delete_adverts));
        $basket_request->save();
        return redirect()->back();
    }


    //устанавливает статус заявке законченна
    /**
     * @param Basket_request $basket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set_end(Basket_request $basket_request)
    {
        $basket_request->ended = 1;
        $basket_request->ended_at = Carbon::now();
        $basket_request->save();
        return redirect('admin/requests/baskets');
    }


    //устанавливает статус заявке не законченна
    /**
     * @param Basket_request $basket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set_no_end(Basket_request $basket_request)
    {
        $basket_request->ended = 0;
        $basket_request->ended_at = null;
        $basket_request->save();
        return redirect('admin/requests/baskets');
    }


    //выводит страницу свопросом точно ли удалить
    /**
     * @param Basket_request $basket
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(Basket_request $basket_request)
    {
        return view('delete', ['basket' => $basket_request]);
    }


    //удаляет заявку
    /**
     * @param Basket_request $basket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_go(Basket_request $basket_request)
    {
        $basket_request->delete();
        return redirect()->back();
    }


}
