<?php


namespace App\Http\Classes;


class BasicData
{
    public static function transporter()
    {
        return $transporter = [1 => 'thai post', 2 => 'kerry'];
    }

    public static function checkParcelLink()
    {
        return $link = [
            'thai post' => 'http://track.thailandpost.co.th/tracking/default.aspx',
            'kerry' => 'https://th.kerryexpress.com/th/track/'
        ];
    }

}
