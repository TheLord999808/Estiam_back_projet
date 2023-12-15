<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testCreate()
    {
        $this->client->request('POST', '/parrains', [], [], [], json_encode([
            'Civilite' => 'M.',
            'Nom' => 'Doe',
            'Prenom' => 'John',
            'Mandat' => 'Maire',
            'Circonscription' => 'Sandwich',
            'Departement' => '48651',
            'Candidat' => 'Emmanuel Macron',
            'DatePublication' => '2022-02-01T00:00:00',
        ]));
    
        $response = json_decode($this->client->getResponse()->getContent(), true);
    
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('id', $response);
        $id = $response['id'];
    
        $this->assertNotNull($id, 'Document ID is null');
    
        return $id; // Return the ID for use in other tests
    }
    
    public function testRead()
    {
        // Create a new document to get its ID
        $id = $this->testCreate();

        // Ensure the ID is a valid ObjectId string
        $this->assertMatchesRegularExpression('/^[a-f\d]{24}$/i', $id, 'Invalid ObjectId format');

        // Make the GET request with the valid ID
        $this->client->request('GET', "/parrains/$id");

        // Assert the response status code is 200
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Parse the response JSON
        $response = json_decode($this->client->getResponse()->getContent(), true);

        // Output or log the response content for debugging
        var_dump($response);

        // Assert the expected keys in the response
        $this->assertArrayHasKey('Civilite', $response, 'Key "Civilite" is missing in the response');
        $this->assertArrayHasKey('Nom', $response, 'Key "Nom" is missing in the response');
        $this->assertArrayHasKey('Prenom', $response, 'Key "Prenom" is missing in the response');
        // Add more assertions based on your actual response structure
    }

    public function testUpdate()
    {
        $this->testCreate();

        $this->client->request('PUT', '/parrains/1', [], [], [], json_encode([
            'Prenom' => 'Bob',
        ]));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testDelete()
    {
        $this->testCreate();

        $this->client->request('DELETE', '/parrains/1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
