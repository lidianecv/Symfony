<?php
namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoriaType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add("descricaocategoria", TextType::class, ['label' => 'Descricao da categoria: '])//param 1nome do campo,2tipo de campo,3label k quero k seja
            ->add('Salvar', SubmitType::class);
    }
}

?>