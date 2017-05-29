<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Advert;
use App\Cit;
use App\Basket_request;
use App\Combo;
use App\Combo_cit;
use App\Combo_cit_categor;
use App\Combo_request;
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

        if(!isset($_COOKIE['basket']))
        {
            if(!isset($_COOKIE['combo']))
            {
                return redirect('/');
            }
            else
            {
                if(!$_COOKIE['combo'])
                {
                    return redirect('/');
                }
            }
        }
        else
        {
            IF(!$_COOKIE['basket'])
            {
                if(!isset($_COOKIE['combo']))
                {
                    return redirect('/');
                }
                else
                {
                    if(!$_COOKIE['combo'])
                    {
                        return redirect('/');
                    }
                }
            }

        }

        if(isset($_COOKIE['basket'])) {
            $cooks = $_COOKIE['basket'];
        }
        else
        {
            $cooks = '';
        }

        if(isset($_COOKIE['combo']))
        {
            $combo_cook = json_decode($_COOKIE['combo'], true);
            $combo_cook = ( $combo_cook === null) ? '' : $combo_cook;
        }
        else
        {
            $combo_cook = '';
        }

        if($combo_cook)
        {
            $combo = $combo_cook['combo'];
            if($combo)
            {
                $combo = Combo::find($combo);
            }
            else
            {
                $combo = '';
            }
            $combo_cit = $combo_cook['combo_cit'];
            if($combo_cit)
            {
                $combo_cit = Combo_cit::find($combo_cit)->load('combo_categors.advert_categor', 'combo_categors.adverts.photos');
            }
            else
            {
                $combo_cit = '';
            }

        }
        else
        {
            $combo = '';
            $combo_cit = '';
        }

        $cooks = explode(',', $cooks);

        IF($cooks)
        {
            $bask_advert = Advert::whereIn('id', $cooks)->with('advert_categor')->with(['photos' => function($query) {
                $query->where('main', 1);
            }])->get();
        }
        else
        {
            $bask_advert = '';
        }


        return view('basket.basket_show', [
            'combo' => $combo,
            'combo_cit' => $combo_cit,
            'combo_cook' => $combo_cook,
            'basket_adv' => $bask_advert,
            'cities' => $cities,
            'sn' => 'basket_show',
            'title' => "Корзина заказа",
            'description' => 'Корзина с заказынными услугами'
        ]);
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

        if(!isset($_COOKIE['basket']))
        {
            if(!isset($_COOKIE['combo']))
            {
                return redirect('/');
            }
            else
            {
                if(!$_COOKIE['combo'])
                {
                    return redirect('/');
                }
            }
        }
        else
        {
            IF(!$_COOKIE['basket'])
            {
                if(!isset($_COOKIE['combo']))
                {
                    return redirect('/');
                }
                else
                {
                    if(!$_COOKIE['combo'])
                    {
                        return redirect('/');
                    }
                }
            }

        }


        if(isset($_COOKIE['basket']))
        {
            $cooks = $_COOKIE['basket'];
            $cooks_array = explode(',', $cooks);
            if(!$cooks_array) $cooks = '';
        }
        else
        {
            $cooks = '';
            $cooks_array = [];
        }


        $gr = Basket_request::create([
            'name' => $request->name,
            'cit_id' => $request->city,
            'phone' => $request->phone,
            'email' => $request->email,
            'adverts' => $cooks,
            'ended' => 0,
            'ended_at' => null
        ]);

        if(isset($_COOKIE['combo']))
        {
            $combo_cook = json_decode($_COOKIE['combo'], true);
            $combo_cook = ( $combo_cook === null ) ? '' : $combo_cook;
        }
        else
        {
            $combo_cook = '';
        }

        $combo = '';
        $combo_cit = '';
        $request_combo_advert = '';
        if($combo_cook)
        {
            $comboInCook = (array_has($combo_cook, 'combo')) ? $combo_cook['combo'] : '';
            $combo = ($comboInCook) ? Combo::find($comboInCook) : '';
            if($combo)
            {
                $comboCitInCook = (array_has($combo_cook, 'combo_cit')) ? $combo_cook['combo_cit'] : '';
                $combo_cit = ($comboCitInCook) ? Combo_cit::where('id',$comboCitInCook)
                    ->with('combo_categors.advert_categor', 'combo_categors.adverts.photos')->first() : '';
                if($combo_cit)
                {
                    $combo_cit_categors = Combo_cit_categor::where('combo_cit_id', $combo_cit->id)->with('adverts')->get();
                    $combo_cit_categors_count = $combo_cit_categors->count();
                    $sovpad_count = 0;
                    $combo_adverts = '';
                    foreach($combo_cit_categors as $combo_categor):
                        if(array_has($combo_cook, $combo_categor->id))
                        {
                            foreach($combo_categor->adverts as $adv):
                                if($adv->id == $combo_cook[$combo_categor->id])
                                {
                                    $combo_adverts .= $adv->id.',';
                                    $sovpad_count++;
                                }
                            endforeach;
                        }
                    endforeach;
                    if($combo_cit_categors_count == $sovpad_count)
                    {
                        $combo_adverts = substr($combo_adverts, 0, -1);
                        Combo_request::create([
                            'combo_cit_id' => $combo_cit->id,
                            'combo_id' => $combo->id,
                            'basket_request_id' => $gr->id,
                            'adverts' => $combo_adverts
                        ]);
                        $request_combo_advert = Advert::whereIn('id', explode(',',$combo_adverts))->with('advert_categor','photos')->get();
                    }
                    /*
                    else
                    {
                        return view('test', ['c1' => $combo_cit_categors_count.'|' .$sovpad_count, 'c2' =>
                            $combo_cit_categors, 'c3' => $combo_cit, 'c4' => $combo]);
                    }*/
                }
            }

        }
        //Получение объекта города для имени на русском
        $city = Cit::find($gr->cit_id);
        //токен чат айди для тееграма и передачи собщения о заявке
        $token = '341119502:AAEwGwsn0h-koif-WL4HkEjmaUUNE0SGUkM';
        $chat_id = '-212178754';
        $txt = "ВНИМАНИЕ!!! Добавлена новая заявка%0A Номер: <b>{$gr->id}</b>%0A Город: <b>{$city->name}</b>%0A Дата добавления: <b>{$gr->created_at}</b>%0A";
        fopen("https://api.telegram.org/bot". $token ."/sendMessage?chat_id=" . $chat_id ."&parse_mode=html&text=". $txt,"r");


        $request_adverts = Advert::whereIn('id', $cooks_array)->with('advert_categor','photos')->get();

        return view('basket.sented', [
            'br' => $gr,
            'request_adverts' => $request_adverts,
            'combo' => $combo,
            'combo_cit' => $combo_cit,
            'request_combo_adverts' => $request_combo_advert,
            'sn' => 'sented',
            'title' => "Заказ № {$gr->id} отправлен",
            'description' => 'Ваш заказ успешно отправлен!'
        ]);
    }


    //Показать все заявки корзин из базы админу
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function basket_requests()
    {
        $baskets = Basket_request::with('combo_requests.combo','combo_requests.combo_cit')->paginate(20);
        return view('basket.baskets', ['baskets' => $baskets]);
    }


    public function edit_combo_adverts(Request $request, Combo_request $combo_request)
    {
        $this->validate($request, [
            'advert_last' => 'required|numeric',
            'advert_new' => 'required|numeric',
            'categor_id' => 'required|numeric'
        ]);

        $adverts = $combo_request->geted_adverts();

        for($i=0; $i < count($adverts); $i++)
        {
            if($adverts[$i] == $request->advert_last)
            {
                $adverts[$i] = $request->advert_new;
            }
        }

        $adverts = implode(',',$adverts);

        $combo_request->adverts = $adverts;
        $combo_request->save();
        $advert = Advert::where('id', $request->advert_new)->with('advert_categor')->first();
        return $advert;
    }

    public function delete_combo(Combo_request $combo_request)
    {
        $combo_request->delete();
        return 'good';
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
        $bask_advert = Advert::whereIn('id', $adverts)->with('advert_categor')
            ->with('advert_stat')
            ->with('advert_cits.cit')
            ->with('contractor.phones')->get();
        $combo_requests = Combo_request::where('basket_request_id', $basket_request->id)
            ->with('combo','combo_cit.cit','combo_cit.combo_categors.adverts.advert_categor', 'combo_cit.combo_categors.adverts.photos')->get();

        return view('basket.admin_open', ['basket' => $basket_request, 'adverts' => $bask_advert, 'combo_requests' => $combo_requests]);
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

    public function save_adverts_in_basket(Request $request, Basket_request $basket_request)
    {
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


    //удавляет заявку

    public function delete(Basket_request $basket_request)
    {
        $basket_request->delete();
        return 'good';
    }




}
