<?php
namespace App\Controller;

use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController {
   
    #[Route('/categoria', name: 'categoria_index')]

    public function index(EntityManagerInterface $em):Response {
        //$em é um obj k vai auxiliar a execuçaao no db
        $categoria = new Categoria() ;
        $categoria->setDescricaocategoria("Informática");
        $msg="";
         
        try {
        $em->persist($categoria);//salvar a persistencia em nível  de memória
        $em->flush();//executa em definitivo no banco de dados
        $msg= "Categoria cadastrada com sucesso";
        }
        catch(\Exception $e) {
            $msg="Erro ao cadastrar categoria";
}
return new Response ("<h1> .$msg. </h1>");
}
}
?>