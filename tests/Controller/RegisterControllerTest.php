<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    public function testHeaderDesign(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertPageTitleSame('Cadastro');
        $this->assertSelectorExists('header');
        $this->assertSelectorTextContains('h3', 'Ecommerce');
        $this->assertSelectorExists('header .container');
        $this->assertSelectorExists('header .container .logo');
        $this->assertSelectorExists('header .container .categories');
        $this->assertSelectorExists('header .search');
        $this->assertSelectorExists('header .container .login');
        $this->assertSelectorExists('header .container .purchase');
    }

    public function testRegisterForm(): void{
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.register');
        $this->assertSelectorExists('.register form');
    }

    public function testRegistration(): void{
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();

        $buttonCrawlerNode = $crawler->selectButton('cadastrar');

        $form = $buttonCrawlerNode->form();

        $client->submit($form, [
            'registration_form[email]' => 'teste@gmail.com',
            'registration_form[password][first]' => 'teste',
            'registration_form[password][second]' => 'teste',
            'registration_form[cel]' => '(19) 99289-5788'
        ]);

    }
}
