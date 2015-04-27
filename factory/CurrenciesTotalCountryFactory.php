<?php
namespace Factory;

class CurrenciesTotalCountryFactory extends Factory {

    public function getTop ($limit) {
        $this->db->prepare('SELECT * FROM currenciesCountry ORDER BY totalSold DESC LIMIT ?');
        $this->db->getQuery()->bindParam(1,$limit);
        return $this->db->load('Model\CurrenciesTotalCountry');
    }
}