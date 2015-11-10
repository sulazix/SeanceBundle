<?php

namespace Interne\SeanceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MeetingControllerTest extends WebTestCase
{
    public function testNewMeeting()
    {
        $client = static::createClient();

        $client->request('POST', '/api/meeting/new', [
            "name" => "meeting_test",
            "date" => "2015-11-04 11:00",
            "place" => "bussigny",
            "items" => [
                ["title" => "test1"],
                ["title" => "test2"],
            ],
            ]);

        $response = $client->getResponse();

        var_dump($response);

        $this->assertEquals(200, $response->getStatusCode(), "Status code should be HTTP_OK");
        $this->assertNotEmpty($response->getContent(), "You got an empty response... that's weird!");
    }
}
