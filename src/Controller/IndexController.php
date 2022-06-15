<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Produto;
use App\Entity\Categoria;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine, AuthenticationUtils $authenticationUtils): Response
    {
        $entityManager = $doctrine->getManager();

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $produtos = $entityManager->getRepository(Produto::class)->findAll();
        $categorias = $entityManager->getRepository(Categoria::class)->findAll();

        return $this->render('index/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'products' => $produtos,
            'categories' => $categorias
        ]);
    }

    #[Route('/logout', name: "app_logout", methods: ['GET'])]
    public function logout(): void{
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
