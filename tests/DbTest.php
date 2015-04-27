<?php

class DbTest extends PHPUnit_Framework_TestCase {

    public function testGetInstance() {
        $db = Db::getInstance();
        $this->assertNotNull($db);
        $this->assertInstanceOf('PDO',$db->getPdo());
    }

}
