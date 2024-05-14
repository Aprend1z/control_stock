<?php

namespace App\Form;

use App\Entity\TblTipoMovimiento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AgregaTipoMovimientoType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('nombre')
      ->add('descripcion')
      ->add(child:'submit', type: SubmitType::class)
    ;
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => TblTipoMovimiento::class,
    ]);
  }
}
