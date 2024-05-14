<?php

namespace App\Form;

use App\Entity\TblMovimientos;
use App\Entity\TblProductos;
use App\Entity\TblTipoMovimiento;
use App\Entity\TblUsuarios;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AgregaMovimientosType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('cantidad')
      ->add('fechahora', null, [
        'widget' => 'single_text',
      ])
      ->add('usuario', EntityType::class, [
        'class' => TblUsuarios::class,
        'choice_label' => 'username',
      ])
      ->add('producto', EntityType::class, [
        'class' => TblProductos::class,
        'choice_label' => 'nombre',
      ])
      ->add('tipomovimiento', EntityType::class, [
        'class' => TblTipoMovimiento::class,
        'choice_label' => 'nombre',
      ])
      ->add(child:'submit', type: SubmitType::class);
     ;
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => TblMovimientos::class,
    ]);
  }
}
