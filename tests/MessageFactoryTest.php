<?php
use Factory\MessageFactory;

class EventFactoryTest extends PHPUnit_Framework_TestCase {

    public function testSave() {
        $factory = new MessageFactory();
        $message = $this->randomMessage();

        Db::getInstance()->getPdo()->beginTransaction();
        $this->assertTrue($factory->saveNew($message));
        Db::getInstance()->getPdo()->rollBack();
        //        Db::getInstance()->getPdo()->commit();
    }

    public function testFomJson() {
        $factory = new MessageFactory();
        $message = $factory->fromJSON($this->testJSON);
        $this->assertInstanceOf('Model\Message',$message);
    }

    public function testSaveLargeNumberOfMessages() {
        return;
        $i = 1;
        while ($i < 1000) {
            $factory = new MessageFactory();
            Db::getInstance()->getPdo()->beginTransaction();
            $message = $this->randomMessage();
            $factory->saveNew($message);
            Db::getInstance()->getPdo()->rollBack();
            //            Db::getInstance()->getPdo()->commit();
            $i++;
        }
    }

    public function testGetLast() {
        $factory = new MessageFactory();
        $last = $factory->getLast(20);
        $this->assertEquals(20,count($last));
    }

    public function randomMessage() {
        $currenciesList = array('GBP','EUR','USD','CHF','AUD','BAM','HUF','INR','JPY','RUB','SEK');
        $countriesList = array('AU','AT','BE','BA','CA','CN','DK','FI','FR','DE','JP','NL','NZ','PL','PT','RU','SI','US');

        shuffle($currenciesList);
        shuffle($countriesList);

        list($currencyFromIndex,$currencyToIndex) = array_rand($currenciesList,2);

        $factory = new MessageFactory();

        $message = $factory->fromJSON($this->testJSON);
        $message->currencyFrom = $currenciesList[$currencyFromIndex];
        $message->currencyTo = $currenciesList[$currencyToIndex];
        $message->amountSell = rand(10,5000);
        $message->rate = rand(0,57)/10;
        $message->amountBuy = $message->amountSell * $message->rate;
        $message->originatingCountry = $countriesList[array_rand($countriesList)];

        return $message;
    }

    private $testJSON = '{"userId": "134256", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "FR"}';
}
