<?php
/**
 * Created by PhpStorm.
 * User: Benhbenny
 * Date: 21/04/2018
 * Time: 22:00
 */

namespace Tests\AppBundle\Services;

use AppBundle\Services\BlackMirorService;
use PHPUnit\Framework\TestCase;

class BlackMirorServiceTest extends TestCase
{
    public function testgetOrPostFromAPI()
    {
        $blackMirrorService = new BlackMirorService();
        $url   = "http://api.tvmaze.com/episodes/30902";
        $resources =$blackMirrorService->getOrPostFromAPI('GET', $url);
        $this->assertContains('is kidnapped', $resources);
        $datas = json_decode($resources, true);
        $this->assertArrayHasKey('summary', $datas);
        $this->assertEquals(2, count($datas['image']));
    }
}