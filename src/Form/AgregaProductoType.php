<?php

namespace App\Form;

use App\Entity\TblProductos;
use App\Entity\TblUnidades;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AgregaProductoType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('nombre')
      ->add('descripcion')
      ->add('cantidad')
      ->add('formato')
      ->add('unidad', EntityType::class, [
        'class' => TblUnidades::class,
        'choice_label' => 'nombre',
      ])
      ->add('submit', SubmitType::class)
    ;
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => TblProductos::class,
    ]);
  }
}
