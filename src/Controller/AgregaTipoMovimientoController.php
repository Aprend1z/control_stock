<?php

namespace App\Controller;

use App\Entity\TblTipoMovimiento;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AgregaTipoMovimientoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AgregaTipoMovimientoController extends AbstractController
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager){
  $this->entityManager = $entityManager;
  }
  #[Route('/agrega/tipo/movimiento', name: 'app_agrega_tipo_movimiento')]
  public function index(Request $request): Response
  {
    $tipoMovimiento = new TblTipoMovimiento();

    $formulario = $this->createForm(AgregaTipoMovimientoType::class, $tipoMovimiento);
    $formulario->handleRequest($request);

    if($formulario->isSubmitted() && $formulario->isValid()){
	$this->entityManager->persist($tipoMovimiento);
	$this->entityManager->flush();
    }
    return $this->render('agrega_tipo_movimiento/index.html.twig', [
	'controller_name' => 'AgregaTipoMovimientoController',
	'formulario' => $formulario->createView(),
    ]);
  }
}
