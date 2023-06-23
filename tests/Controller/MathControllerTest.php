<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DegreeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    //private string $path = '/degree/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testAddition(): void
    {
       $this->client->request('GET', "/add/1/2");

        self::assertResponseStatusCodeSame(200);
        
        $response = $this->client->getResponse()->getContent();
        self::assertEquals('3', $response);

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testSubtract(): void
    {
       $this->client->request('GET', "/subtract/1/2");

        self::assertResponseStatusCodeSame(200);
        
        $response = $this->client->getResponse()->getContent();
        self::assertEquals('-1', $response);

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testMultiplication(): void
    {
       $this->client->request('GET', "/multiply/1/2");

        self::assertResponseStatusCodeSame(200);
        
        $response = $this->client->getResponse()->getContent();
        self::assertEquals('2', $response);

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testDivision(): void
    {
       $this->client->request('GET', "/divide/10/2");

        self::assertResponseStatusCodeSame(200);
        
        $response = $this->client->getResponse()->getContent();
        self::assertEquals('5', $response);

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testDivisionFail(): void
    {
        $this->client->request('GET', "/divide/1/0");

        self::assertResponseStatusCodeSame(500);
        
        $response = $this->client->getResponse()->getContent();
        $this->assertMatchesRegularExpression('/Cannot divide by zero/', $response);

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNumericCheck(): void {
        $this->client->request('GET', "/divide/foo/1");

        self::assertResponseStatusCodeSame(422);
        
        $response = $this->client->getResponse()->getContent();
        self::assertEquals('Both params must be numbers', $response);
    }

    public function testOperationCheck(): void {
        $this->client->request('GET', "/foobar/1/1");

        self::assertResponseStatusCodeSame(404);
        
        $response = $this->client->getResponse()->getContent();
        self::assertEquals('The selected opearation is not available', $response);
    }

}
