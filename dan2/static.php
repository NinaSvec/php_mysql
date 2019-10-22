<?php

class User{

    public static $f_name = 'Pero';
    public static $l_name = 'Peric';

    public static function addUser($fn, $ln){
        self::$f_name = $fn;
        self::$l_name = $ln;
    }
}

/* OVO NE RADI
$user = new User();
echo $user->f_name;
*/

/*
User::addUser('Marko','Markic');
echo User::$f_name."\t";
echo User::$l_name;
*/

//kreiranje klasa i metoda bez instanciranja u objekte