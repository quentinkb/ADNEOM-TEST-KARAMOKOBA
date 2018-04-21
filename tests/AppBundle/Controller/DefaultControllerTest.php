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
        $this->assertContains('Black Mirror', $client->getResponse()->getContent());
        $this->assertGreaterThan(
            10,
            $crawler->filter('img')->count()
        );
        $this->assertGreaterThanOrEqual(
            4,
            $crawler->filter('a.list-group-item')->count()
        );
    }


    public function testEpisode()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/episode/30907');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(12, $crawler->filter('div')->count());
        $this->assertContains('The Waldo Moment', $client->getResponse()->getContent());
    }
}
