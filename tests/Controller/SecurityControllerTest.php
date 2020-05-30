<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testPagesIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request(Request::METHOD_GET, $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function provideUrls()
    {
        return [
            ['/login'],
            ['/register'],
        ];
    }
}
