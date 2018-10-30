<?php

namespace ProductBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/products');
    }

    public function testProduct()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/products/{id}');
    }

}
