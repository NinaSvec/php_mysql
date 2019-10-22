<?php

include 'static.php';

class Buyer extends User{

    public static $buyer_id;

    public static function addBuyer($fn,$ln,$id){

        parent::addUser($fn, $ln);
        self::$buyer_id = $id;
    }
}

Buyer::addBuyer('Iva','Ivic', 25545);
echo "Ime kupca: " . Buyer::$f_name.'<br>';
echo "Prezime kupca: " . Buyer::$l_name.'<br>';
echo "Id kupca: " . Buyer::$buyer_id.'<br>';