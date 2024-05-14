<?php

namespace App\Controller;

use App\Entity\TblUnidades;
use App\Form\AgregaUnidadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AgregaUnidadController extends AbstractController
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager){
  $this->entityManager = $entityManager;
  }
  #[Route('/agrega/unidad', name: 'app_agrega_unidad')]
  public function index(Request $request): Response
  {
    $unidad = new TblUnidades();

    $formulario = $this->createForm(AgregaUnidadType::class, $unidad);
    $formulario->handleRequest($request);

    if($formulario->isSubmitted() && $formulario->isValid()){
	$this->entityManager->persist($unidad);
	$this->entityManager->flush();
    }
    return $this->render('agrega_unidad/index.html.twig', [
	  'controller_name' => 'AgregaUnidadController',
	  'formulario' => $formulario->createView(),
    ]);
  }
}
