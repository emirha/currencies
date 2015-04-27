<?php
use Factory\CurrenciesTotalCountryFactory;

class CurrenciesTotalCountryTest extends PHPUnit_Framework_TestCase {

    public function testGetTop() {
        $factory = new CurrenciesTotalCountryFactory();
        $topCountries = $factory->getTop(5);

        // since it can be so that less than 5 currencies are traded best is to test if all returned rows are of type CurrenciesTotal
        $allCorrectType = true;
        foreach ($topCountries as $country) {
            if (get_class($country) != 'Model\CurrenciesTotalCountry') {
                $allCorrectType = false;
                break;
            }
        }
        $this->assertEquals(true,$allCorrectType);
    }
}