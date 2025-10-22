<?php

namespace App\Controller;

use App\Repository\ProdutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiController extends AbstractController
{
    #[Route('/api/produtos', name: 'api_produtos')]
    public function produtos(ProdutoRepository $produtoRepository ): Response
    {
        $listaProdutos = $produtoRepository->findAll();
        //devolve noformato json
        return $this->json($listaProdutos, 200, [], ['groups' => ['api_list']]);
    }
}
