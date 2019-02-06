<?php
namespace App\Tests;





use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewTests extends WebTestCase    {
        /** @test */
        function convert(){
            $client = static::createClient();

            $client->request('POST', '/',
                []
                ,[],['CONTENT_TYPE'=>'application/json'],
                json_encode(["from"=>"USD","to"=>"EUR","amount"=>10]));
            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }
}