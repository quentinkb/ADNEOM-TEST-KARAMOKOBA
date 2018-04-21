<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Black Mirror', $crawler->filter('.jumbotron-heading h1')->text());
    }


    public function testEpisode()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/episode/30907');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
