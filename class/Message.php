<?php

namespace Model;


class Message {

    public
        $id,
        $userId,
        $currencyFrom,
        $currencyTo,
        $amountSell,
        $amountBuy,
        $rate,
        $timePlaced,
        $originatingCountry
    ;

    function __set ($name, $value) {
        if (!property_exists($this,$name)) return false;
        $this->$name = $value;
        return true;
    }

    function __get ($name) {
        if (!property_exists($this,$name)) return null;
        return $this->$name;
    }

    /**
     * @return string
     */
    function toJson() {
        return json_encode($this);
    }
}


