<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestFonctionnelTest extends WebTestCase
{
//    Test pour l'url /user
    public function testShouldDisplayUser()
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/user');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'User index');
    }

    //Test si le formulaire d'ajout est bien sur /user/new
    public function testShouldCreateNewUser()
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/user/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Create new User');
    }

    //Test qui rempli le formulaire, le soumet et on veirfie si les données soumis sont les donnéees en base
    public function testShouldAddNewUser()
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/user/new');

        $buttonCrawlerNode = $crawler->selectButton('Save');

        $form = $buttonCrawlerNode->form();

        $uuid = uniqid();

        $form = $buttonCrawlerNode->form([
            'user[firstName]'    => 'Add FirstName For Test' . $uuid,
            'user[lastName]' => 'Add LastName For Test' . $uuid,
        ]);

        $client->submit($form);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('body', 'Add FirstName For Test' . $uuid);
        $this->assertSelectorTextContains('body', 'Add LastName For Test' . $uuid);
    }
}
