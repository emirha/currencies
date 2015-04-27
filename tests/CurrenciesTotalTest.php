<?php
use Factory\CurrenciesTotalFactory;

class CurrenciesTotalTest extends PHPUnit_Framework_TestCase {

    public function testGetTopSold() {
        $factory = new CurrenciesTotalFactory();
        $topBought = $factory->getTopSold(5);

        // since it can be so that less than 5 currencies are traded best is to test if all returned rows are of type CurrenciesTotal
        $allCorrectType = true;
        foreach ($topBought as $sold) {
            if (get_class($sold) != 'Model\CurrenciesTotal') {
                $allCorrectType = false;
                break;
            }
        }
        $this->assertEquals(true,$allCorrectType);
    }

    public function testGetTopBougth() {
        $factory = new CurrenciesTotalFactory();
        $topBought = $factory->getTopBought(5);

        // since it can be so that less than 5 currencies are traded best is to test if all returned rows are of type CurrenciesTotal
        $allCorrectType = true;
        foreach ($topBought as $bought) {
            if (get_class($bought) != 'Model\CurrenciesTotal') {
                $allCorrectType = false;
                break;
            }
        }

        $this->assertEquals(true,$allCorrectType);
    }


}
