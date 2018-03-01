<?php

namespace app\magic;

use Yii;

class StatusBalanceteMagic
{
    const STATUS_SENT = 'S';
    
    const STATUS_VALIDATED = 'V';
    
    public static $status =
    [
        self::STATUS_SENT => 'Aguardando Validação',
        self::STATUS_VALIDATED => 'Validado'
    ];
    
    public static $classes =
    [
        self::STATUS_SENT => 'warning',
        self::STATUS_VALIDATED => 'success'
    ];
    
    public static function getStatus($cod)
    {
        return (isset(self::$status[$cod])) ? self::$status[$cod] : $cod ;
    }
    
    public static function getClass($cod)
    {
        return (isset(self::$classes[$cod])) ? self::$classes[$cod] : $cod ;
    }
}
