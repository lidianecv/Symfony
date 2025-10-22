<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use App\Repository\CategoriaRepository;
use App\Repository\ProdutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ProdutoController extends AbstractController
{

    #[Route(path: "/produto", name: "produto_index")]
    #[IsGranted("ROLE_USER")]

    public function index(EntityManagerInterface $em, ProdutoRepository $produtoRepository)
    {
        //busca os produtos cadastrados
        $data['produtos'] = $produtoRepository->findAll();
        $data['titulo'] = "Gerenciar Produtos";

        return $this->render('produto/index.html.twig', $data);
    }

    #[Route(path: "/produto/adicionar", name: "produto_adicionar")]
    #[IsGranted("ROLE_USER")]


    public function adicionar(Request $request, EntityManagerInterface $em): Response
    {
        $msg = "";
        $produto = new Produto();
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //salva o produto no db
            $em->persist($produto);//salvar na memoria
            $em->flush();
            $msg = "Produto cadastrado com sucesso";
        }

        return $this->render('produto/form.html.twig', [
            'form' => $form->createView(),
            'titulo' => 'Adicionar novo produto',
            'msg' => $msg,

        ]);


    }

    #[Route("/produto/editar/{id}", name: "produto_editar")]
    #[IsGranted("ROLE_USER")]
    public function editar($id, Request $request, EntityManagerInterface $em, ProdutoRepository $produtoRepository)
    {
        $msg = "";
        $produto = $produtoRepository->find($id);
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $msg = "Produto atualizado com sucesso";
        }

        $data['titulo'] = 'Editar produto';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->render('produto/form.html.twig', [
            'form' => $form->createView(),
            'titulo' => 'Editar produto',
            'msg' => $msg,
        ]);
    }


    #[Route("/produto/excluir/{id}", name: "produto_excluir")]
    #[IsGranted("ROLE_USER")]
    public function excluir($id, Request $request, EntityManagerInterface $em, ProdutoRepository $produtoRepository): Response
    {
        $produto = $produtoRepository->find($id);
        $em->remove($produto);
        $em->flush();

        //redireciona a app para o produto index
        return $this->redirectToRoute("produto_index", ["id" => $id]);
    }
}


?>