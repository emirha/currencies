<?php

use Factory\CurrenciesTotalCountryFactory;
use Factory\CurrenciesTotalFactory;
use Factory\MessageFactory;

class MessageController {

    function getMessages() {
        $factory = new MessageFactory();
        $messages = $factory->getLast(20);

        echo json_encode($messages);
    }

    function getTops() {
        $factory = new CurrenciesTotalFactory();
        $topCount = 5;

        $data = array();
        $data['topBought'] = $factory->getTopBought($topCount);
        $data['topSold'] = $factory->getTopSold($topCount);

        $topCountryFactory = new CurrenciesTotalCountryFactory();
        $data['topCountries'] = $topCountryFactory->getTop($topCount);

        echo json_encode($data);
    }

    function postMessage() {
        $postdata = file_get_contents("php://input");
        if (empty($postdata)) return;

        $factory = new MessageFactory();
        $message = $factory->fromJSON($postdata);

        $factory->saveNew($message);
    }
}