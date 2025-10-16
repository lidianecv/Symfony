<?php
namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Types\TextType;


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

 #[Route("/categoria/adicionar", name: "categoria_adicionar")]

 public function adicionar ():Response {
    $form =$this->createForm(CategoriaType::class);
    $data['titulo']='Adicionar nova categoria';
    $data['form']= $form;

    return $this->render('categoria/form.html.twig', [
    'form' => $form->createView(),
]);
 }

}
?>