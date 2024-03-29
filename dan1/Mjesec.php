<?php

include 'Datum.php';

class Mjesec extends Datum{

    private $mjeseci = array('Siječanj','Veljača','Ožujak');

    public function getMonthName($date){
        $mjesec = date('n',strtotime($date));
        $mjesec--;
        $ime_mjeseca = $this->mjeseci[$mjesec];
        return "Tada je bio dan " . $this->getDayName($date) . " u mjesecu $ime_mjeseca";

    }

}

$mjesec = new Mjesec ();
echo $mjesec->getMonthName('2019-02-15');
