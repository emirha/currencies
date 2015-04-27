<?php

namespace Factory;

use Db;

class Factory {
    protected $db;

    function __construct () {
        $this->db = Db::getInstance();
    }

}