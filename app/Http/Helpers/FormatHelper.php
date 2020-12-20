<?php
namespace App\Http\Helpers;

use Illuminate\Support\Facades\Route;
use NumberFormatter;

class FormatHelper{

    public static function code($prefix, $suffix){
        return $prefix.'-'.$suffix;
    }

    public static function title($string){
        return ucfirst(str_replace('_', ' ', $string)); 
    }

    public static function checkActiveUrl($route){
        return (Route::currentRouteName()==$route);
    }

    public static function checkAccountingUrl($url){
        $accounting_urls = [
            'accounting', 'voucher'
        ];
        return in_array($url, $accounting_urls) ? 'is-expanded':'';
    }

    public static function checkAccountingSettingsUrl($url){
        $accounting_settings_urls = 
        [
            'chart-of-account', 'account-information', 'payment-method', 'vendor', 'party', 'pettycash_charts', 'asset_charts', 'opening_assets'
        ];

        return in_array($url, $accounting_settings_urls) ? 'is-expanded':'';
    }

    public static function toWords($amount){
        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);

        return ucfirst($formatter->format($amount));
    }
}