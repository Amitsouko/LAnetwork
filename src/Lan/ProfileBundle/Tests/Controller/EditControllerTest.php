<?php

namespace Lan\ProfileBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EditControllerTest extends WebTestCase
{
    public function testEditcover()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/profile/edit-cover');
    }

}
