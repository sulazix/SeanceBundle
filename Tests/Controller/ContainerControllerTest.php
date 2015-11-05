<?php

namespace Interne\SeanceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContainerControllerTest extends WebTestCase
{
    public function testGetContainers()
    {
        $client = static::createClient();

        $client->request('GET', '/api/container/all');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode(), "Status code should be HTTP_OK");
        $this->assertNotEmpty($response->getContent(), "You got an empty response... that's weird!");
    }
}
