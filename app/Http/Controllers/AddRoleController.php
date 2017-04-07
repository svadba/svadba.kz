<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\Advert_stat;
use App\Advert_categor;
use App\Cit;
use App\Allow_type;

use App\Constat;
use App\Contype;

use App\Role_user;
use App\Http\Requests;

class AddRoleController extends Controller
{
    public function index()
    {
        
        
        Role::create([
            'name' => 'Администратор',
            'name_eng' => 'admin',
        ]);
        
        Role::create([
            'name' => 'Администратор блога',
            'name_eng' => 'blogAdmin',
        ]);
        
        Role::create([
            'name' => 'Менеджер объявлений',
            'name_eng' => 'adManager',
        ]);
        
        Role::create([
            'name' => 'Менеджер заявок',
            'name_eng' => 'requestManager',
        ]);
        
        Role::create([
            'name' => 'Пользователь',
            'name_eng' => 'Contractor',
        ]);
        
        Role_user::create([
            'user_id' => '1',
            'role_id' => '1',
        ]);
        
        Role_user::create([
            'user_id' => '2',
            'role_id' => '1',
        ]);
        
        Role_user::create([
            'user_id' => '3',
            'role_id' => '1',
        ]);
        
        Role_user::create([
            'user_id' => '4',
            'role_id' => '1',
        ]);
        
        Role_user::create([
            'user_id' => '5',
            'role_id' => '1',
        ]);
        
        
        Allow_type::create([
            'name' => 'Опубликовано',
        ]);
        
        Allow_type::create([
            'name' => 'Не опубликовано',
        ]);
        
        Advert_stat::create([
            'name' => 'Активно',
        ]);
        
        Advert_stat::create([
            'name' => 'Не активно',
        ]);
        
        Advert_categor::create([
            'name' => 'Live band',
            'name_eng' => 'Live band',
        ]);
        
        Advert_categor::create([
            'name' => 'Аренда транспорта',
            'name_eng' => 'Rent of transport',
        ]);

        Advert_categor::create([
            'name' => 'Артисты и вокалисты',
            'name_eng' => 'Artists and vocalists',
        ]);

        Advert_categor::create([
            'name' => 'Ведущие',
            'name_eng' => 'Leading',
        ]);

        Advert_categor::create([
            'name' => 'Видеографы',
            'name_eng' => 'Videographers',
        ]);

        Advert_categor::create([
            'name' => 'Инструменталисты',
            'name_eng' => 'Instrumentalists',
        ]);

        Advert_categor::create([
            'name' => 'Оригинальный жанр',
            'name_eng' => 'Original genre',
        ]);

        Advert_categor::create([
            'name' => 'Рестораны',
            'name_eng' => 'Restaurants',
        ]);
        
        Advert_categor::create([
            'name' => 'Салоны красоты',
            'name_eng' => 'Beauty Salons',
        ]);
        
        Advert_categor::create([
            'name' => 'Свадебные салоны',
            'name_eng' => 'Wedding salons',
        ]);

        Advert_categor::create([
            'name' => 'Танцевальные коллективы',
            'name_eng' => 'Dance groups',
        ]);

        Advert_categor::create([
            'name' => 'Свадебные салоны',
            'name_eng' => 'Wedding salons',
        ]);

        Advert_categor::create([
            'name' => 'Типографии и полиграфии',
            'name_eng' => 'Printing and printing',
        ]);

        Advert_categor::create([
            'name' => 'Фотографы',
            'name_eng' => 'Photographers',
        ]);

        Advert_categor::create([
            'name' => 'Декораторы-оформители',
            'name_eng' => 'Decorators-decorators',
        ]);

        Advert_categor::create([
            'name' => 'Кондитерские',
            'name_eng' => 'Confectioneries',
        ]);
        
        Cit::create([
            'name' => 'Астана',
            'name_eng' => 'Astana',
        ]);

        Cit::create([
            'name' => 'Атырау',
            'name_eng' => 'Atyrau',
        ]);

        Cit::create([
            'name' => 'Актобе',
            'name_eng' => 'Aktobe',
        ]);

        Cit::create([
            'name' => 'Караганда',
            'name_eng' => 'Karaganda',
        ]);

        Cit::create([
            'name' => 'Шымкент',
            'name_eng' => 'Shymkent',
        ]);

        Cit::create([
            'name' => 'Кокшетау',
            'name_eng' => 'Kokshetau',
        ]);

        Cit::create([
            'name' => 'Семей',
            'name_eng' => 'Semey',
        ]);
        
        Cit::create([
            'name' => 'Павлодар',
            'name_eng' => 'Pavlodar',
        ]);
        
        Cit::create([
            'name' => 'Алматы',
            'name_eng' => 'Almaty',
        ]);

        Cit::create([
            'name' => 'Усть-Каменогорск',
            'name_eng' => 'Ust-Kamenogorsk',
        ]);

        Cit::create([
            'name' => 'Петропавловск',
            'name_eng' => 'Petropavlovsk',
        ]);

        Cit::create([
            'name' => 'Тараз',
            'name_eng' => 'Taraz',
        ]);

        Cit::create([
            'name' => 'Актау',
            'name_eng' => 'Aktau',
        ]);
        
        Cit::create([
            'name' => 'Уральск',
            'name_eng' => 'Uralsk',
        ]);
        
        Cit::create([
            'name' => 'Кызылорда',
            'name_eng' => 'Kyzylorda',
        ]);
        
        Cit::create([
            'name' => 'Артисты Казахстана',
            'name_eng' => 'Artists of Kazakhstan',
        ]);
        
        Cit::create([
            'name' => 'Артисты России',
            'name_eng' => 'Artists of Russia',
        ]);
        
        Cit::create([
            'name' => 'Артисты Мира',
            'name_eng' => 'Artists of the World',
        ]);
        
        Constat::create([
            'name' => 'Активен',
        ]);
        
        Constat::create([
            'name' => 'Не активен',
        ]);
        
        Contype::create([
            'name' => 'Basic',
        ]);
        
        Contype::create([
            'name' => 'Premium',
        ]);
        
        Contype::create([
            'name' => 'Gold',
        ]);
       
        
    
    }
}
