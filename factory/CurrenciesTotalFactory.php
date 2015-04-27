<?php

namespace Factory;

class CurrenciesTotalFactory extends Factory {

    public function getTopSold($limit) {
        $this->db->prepare('SELECT * FROM currenciesTotals ORDER BY totalSold DESC LIMIT ?');
        $this->db->getQuery()->bindParam(1,$limit);
        return $this->db->load('Model\CurrenciesTotal');
    }

    public function getTopBought($limit) {
        $this->db->prepare('SELECT * FROM currenciesTotals ORDER BY totalBought DESC LIMIT ?');
        $this->db->getQuery()->bindParam(1,$limit);
        return $this->db->load('Model\CurrenciesTotal');
    }

}