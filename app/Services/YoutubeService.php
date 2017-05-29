<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class YoutubeService
{

    public $API_KEY = 'AIzaSyAyg6TX-TGCuVr9ChTvS_xZG_Eq3O09w54';   //девелоперский ключ
    const API_NAME = 'svadbakz';                                //название приложения
    const YOUTUBE_EMAIL = 'zsvadbavkz@gmail.com';             //регистрационный е-майл на YouTube
    const YOUTUBE_PASS = 'Zhan7777';                        //пароль для входа в ваш аккаунт на YouTube
    const YOUTUBE_USERNAME = 'svadba svadba';               //имя пользователя на YouTube

    public static function getAuthToken()
    {
        /*
        $response = '';
        $eq = "accountType=HOSTED_OR_GOOGLE&Email=". self::YOUTUBE_EMAIL . "&Passwd=". self::YOUTUBE_PASS . "&service=youtube&source=". self::API_NAME;
        if ($fp = fsockopen ("ssl://www.google.com", 443, $errno, $errstr, 20))
        {
        $request ="POST /youtube/accounts/ClientLogin HTTP/1.0\r\n";
        $request.="Host: www.google.com\r\n";
        $request.="Content-Type:application/x-www-form-urlencoded\r\n";
        $request.="Content-Length: ".strlen($eq)."\r\n";
        $request.="\r\n\r\n";
        $request.=$eq;
        fwrite($fp,$request,strlen($request));
        while (!feof($fp))
        $response .= fread($fp,8192);
        fclose($fp);
        }

        if($response)
        {
            preg_match("!(.*?)Auth=(.*?)\n!si",$response,$ok);
            return $response;
        }
        else {
            return $errno .'________'. $errstr;
        }
        */
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/youtube/accounts/ClientLogin');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, "Email=".self::YOUTUBE_EMAIL."&Passwd=".self::YOUTUBE_PASS."&service=youtube&source=".self::API_NAME."");
        $out = curl_exec($curl);
        curl_close($curl);
        return $out;
    }


}
/*
curl --location https://www.google.com/youtube/accounts/ClientLogin \
     --data 'Email=zsvadbavkz@gmail.com&Passwd=Zhan7777&service=youtube&source=svadba' \
     --header 'Content-Type:application/x-www-form-urlencoded' */