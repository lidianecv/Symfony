<?php
namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class CategoriaController extends AbstractController
{

    #[Route('/categoria', name: 'categoria_index')]

    public function index(CategoriaRepository $categoriaRepository): Response
    {
        //busca no db tdas as categorias cadastradas
         $data['categorias'] = $categoriaRepository->findAll();
        $data['titulo']='Gerenciar Categoria';
       
        return $this->render('categoria/index.html.twig', $data);
    }

    #[Route("/categoria/adicionar", name: "categoria_adicionar")]

    public function adicionar(Request $request, EntityManagerInterface $em): Response
    {

        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

           $msg = "";

        if ($form->isSubmitted() && $form->isValid()) {
            //salvar a n$msg = "";ova cat no db

            $em->persist($categoria);//salvar na memoria
            $em->flush();// salvar permanentemente no db

            $msg = "Categoria add com sucessso";


        }

        $data['titulo'] = 'Adicionar nova categoria';
        $data['form'] = $form;
        $data['msg']= $msg;

        return $this->render('categoria/form.html.twig', [
            'form' => $form->createView(),
            'titulo' => 'Nova Categoria',
               'msg' => $msg,
           
 ]);
    }

}
?>