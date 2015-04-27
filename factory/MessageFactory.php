<?php

namespace Factory;

use Model\Message;

class MessageFactory extends Factory {

    /**
     * @param Message $message
     *
     * @return bool
     */
    public function saveNew (Message $message) {
        $this->db->prepare(
            'INSERT INTO messages SET
                userId              = :userId            ,
                currencyFrom        = :currencyFrom      ,
                currencyTo          = :currencyTo        ,
                amountSell          = :amountSell        ,
                amountBuy           = :amountBuy         ,
                rate                = :rate              ,
                timePlaced          = :timePlaced        ,
                originatingCountry  = :originatingCountry'
        );

        $this->db->getQuery()->bindValue(':userId',             $message->userId            );
        $this->db->getQuery()->bindValue(':currencyFrom',       $message->currencyFrom      );
        $this->db->getQuery()->bindValue(':currencyTo',         $message->currencyTo        );
        $this->db->getQuery()->bindValue(':amountSell',         $message->amountSell        );
        $this->db->getQuery()->bindValue(':amountBuy',          $message->amountBuy         );
        $this->db->getQuery()->bindValue(':rate',               $message->rate              );
        $this->db->getQuery()->bindValue(':timePlaced',         $message->timePlaced        );
        $this->db->getQuery()->bindValue(':originatingCountry', $message->originatingCountry);

        if ($this->db->getQuery()->execute()) {
            $message->id = $this->db->getPdo()->lastInsertId();
            return true;
        }

        return false;
    }

    /**
     * @param $JSONString
     *
     * @return Message
     */
    public function fromJSON($JSONString) {
        $message = new Message();
        $data = json_decode($JSONString);

        $message->userId             = $data->userId;
        $message->currencyFrom       = $data->currencyFrom;
        $message->currencyTo         = $data->currencyTo;
        $message->amountSell         = $data->amountSell;
        $message->amountBuy          = $data->amountBuy;
        $message->rate               = $data->rate;
        //        $message->timePlaced         = date("Y-m-d H:i:s");
        $message->timePlaced         = date("Y-m-d H:i:s",strtotime($data->timePlaced));
        $message->originatingCountry = $data->originatingCountry;

        return $message;
    }

    /**
     * @param $limit
     *
     * @return Message[]
     */
    public function getLast($limit) {
        $this->db->prepare('SELECT * FROM messages ORDER BY timePlaced DESC LIMIT ?');
        $this->db->getQuery()->bindParam(1,$limit);
        return $this->db->load('Model\Message');
    }

}