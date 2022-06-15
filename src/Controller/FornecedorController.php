<?php

namespace App\Controller;

use App\Entity\Fornecedor;
use App\Entity\Produto;
use App\Form\FornecedorType;
use App\Repository\FornecedorRepository;
use App\Repository\ProdutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/suppliers' )]
class FornecedorController extends AbstractController
{
    #[Route('/', name: 'app_fornecedor_index', methods: ['GET'])]
    public function index(FornecedorRepository $fornecedorRepository, ProdutoRepository $produtoRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_WORKER');

        return $this->render('fornecedor/index.html.twig', [
            'suppliers' => $fornecedorRepository->findAll(),
            'products' => $produtoRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'app_fornecedor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FornecedorRepository $fornecedorRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_WORKER');
        
        $fornecedor = new Fornecedor();
        $form = $this->createForm(FornecedorType::class, $fornecedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fornecedorRepository->add($fornecedor, true);

            return $this->redirectToRoute('app_fornecedor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fornecedor/new.html.twig', [
            'fornecedor' => $fornecedor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fornecedor_show', methods: ['GET'])]
    public function show(Fornecedor $fornecedor): Response
    {
        $this->denyAccessUnlessGranted('ROLE_WORKER');

        return $this->render('fornecedor/show.html.twig', [
            'fornecedor' => $fornecedor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fornecedor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fornecedor $fornecedor, FornecedorRepository $fornecedorRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_WORKER');

        $form = $this->createForm(Fornecedor1Type::class, $fornecedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fornecedorRepository->add($fornecedor, true);

            return $this->redirectToRoute('app_fornecedor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fornecedor/edit.html.twig', [
            'fornecedor' => $fornecedor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fornecedor_delete', methods: ['POST'])]
    public function delete(Request $request, Fornecedor $fornecedor, FornecedorRepository $fornecedorRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_WORKER');

        if ($this->isCsrfTokenValid('delete'.$fornecedor->getId(), $request->request->get('_token'))) {
            $fornecedorRepository->remove($fornecedor, true);
        }

        return $this->redirectToRoute('app_fornecedor_index', [], Response::HTTP_SEE_OTHER);
    }
}
