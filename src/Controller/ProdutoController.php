<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProdutoController extends AbstractController{

    #[Route(path:"/produto", name:"produto_index")]

    public function index(EntityManagerInterface $em, CategoriaRepository $categoriaRepository){
        $categoria = $categoriaRepository->find(1);//1 = Categoria Informática
        $produto= new Produto();
        $produto->setNomeproduto("Notebook");
        $produto->setValor(3000);
        $produto->setCategoria($categoria);

        $msg="";
         
        try {
        $em->persist($produto);//salvar a persistencia em nível  de memória
        $em->flush();//executa em definitivo no banco de dados
        $msg= "Produto cadastrado com sucesso";
        }
        catch(\Exception $e) {
            $msg="Erro ao cadastrar produto";
}
return new Response ("<h1> .$msg. </h1>");
}

    #[Route(path:"/produto/adicionar", name:"produto_adicionar")]

    public function adicionar(): Response {
        $form = $this->createForm (ProdutoType::class);
        
        return $this->render('produto/form.html.twig', [
            'titulo' => 'Adicionar novo produto',
            'form' => $form->createView(),
        ]);
    }
}
?>