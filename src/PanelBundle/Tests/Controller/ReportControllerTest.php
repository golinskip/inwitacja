<?php

namespace PanelBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportControllerTest extends WebTestCase
{
    public function testPerson()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/person');
    }

    public function testInvitation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/invitation');
    }

    public function testChangelog()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/changelog');
    }

}
