<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserAuthenticationTest extends WebTestCase
{
    public function testHeaderDesign(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();


        $this->assertPageTitleSame('Ecommerce');
        $this->assertSelectorExists('header');
        $this->assertSelectorTextContains('h3', 'Ecommerce');
        $this->assertSelectorExists('header .container');
        $this->assertSelectorExists('header .container .logo');
        $this->assertSelectorExists('header .container .categories');
        $this->assertSelectorExists('header .search');
        $this->assertSelectorExists('header .container .login');
        $this->assertSelectorExists('header .container .purchase');
    }

    public function testLoginContainer(): void{
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorExists('header .container .login .container');
        $this->assertSelectorExists('header .container .login .container');
    }

    public function testSlideshowDesign(): void{
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorExists('main .slideshow');
        $this->assertSelectorExists('main .slideshow .slide');
        $this->assertSelectorExists('main .slideshow .dots');
        $this->assertSelectorExists('main .slideshow .dots .dot');
    }

    public function testProductsDesign(): void{
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('main h3', 'Produtos');
        $this->assertSelectorExists('main .products');
        $this->assertSelectorExists('main .products .product');
        $this->assertSelectorExists('main .products .product .name');
        $this->assertSelectorExists('main .products .product .price');
    }

    public function testAuthentication(): void{
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);

        $testUser = $userRepository->findOneByEmail('teste@gmail.com');

        $client->loginUser($testUser);

        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }

    public function testSubmitLoginForm(): void{
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        // select the button
        $buttonCrawlerNode = $crawler->selectButton('send');
        
        // retrieve the Form
        $form = $buttonCrawlerNode->form();
        
        $client->submit($form, [
            '_username' => 'teste@gmail.com',
            '_password' => 'teste'
        ]);
        
    }
}
