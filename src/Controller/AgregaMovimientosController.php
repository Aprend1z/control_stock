<?php

namespace App\Controller;

use App\Form\AgregaMovimientosType;
use App\Entity\TblMovimientos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AgregaMovimientosController extends AbstractController
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager){
  $this->entityManager = $entityManager;
  }
  #[Route('/agrega/movimientos', name: 'app_agrega_movimientos')]
  public function index(Request $request): Response
  {
    $movimiento = new TblMovimientos();

    $formulario = $this->createForm(AgregaMovimientosType::class, $movimiento);
    $formulario->handleRequest($request);

    if($formulario->isSubmitted() && $formulario->isValid()){
	$this->entityManager->persist($movimiento);
	$this->entityManager->flush();
    }

    return $this->render('agrega_movimientos/index.html.twig', [
	  'controller_name' => 'AgregaMovimientosController',
	  'formulario' => $formulario->createView(),
    ]);
  }
}
