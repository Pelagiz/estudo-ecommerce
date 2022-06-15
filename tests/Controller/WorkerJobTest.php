<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WorkerJobTest extends WebTestCase
{
    public function testSuppliersIndex(): void
    {
        $client = static::createClient();
        $client->followRedirects();
        $userRepository = static::getContainer()->get(UserRepository::class);

        $testUser = $userRepository->findOneByEmail('teste@gmail.com');

        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/suppliers');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Fornecedor index');
        $this->assertSelectorExists('table');
    }


}
