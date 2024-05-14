<?php

namespace App\Controller;

use App\Entity\TblProductos;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AgregaProductoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AgregaProductoController extends AbstractController
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager){	
  $this->entityManager = $entityManager;
  }
  #[Route('/agrega/producto', name: 'app_agrega_producto')]
  public function index(Request $request): Response
  {
    $producto = new TblProductos();
    $formulario = $this->createForm(AgregaProductoType::class, $producto);
    $formulario->handleRequest($request);

    if($formulario->isSubmitted() && $formulario->isValid()){
	$this->entityManager->persist($producto);
	$this->entityManager->flush();
    }

    return $this->render('agrega_producto/index.html.twig', [
	  'controller_name' => 'AgregaProductoController',
	  'formulario' => $formulario->createView(),
    ]);
  }
}
