<?php

namespace App\Controller;

use App\Entity\TblProductos;
use App\Entity\TblUsuarios;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AgregaUsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AgregaUsuarioController extends AbstractController
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager){
  $this->entityManager = $entityManager;
  }
  #[Route('/agrega/usuario', name: 'app_agrega_usuario')]
  public function index(Request $request): Response
  {
    $usuario = new TblUsuarios();

    $formulario = $this->createForm(AgregaUsuarioType::class, $usuario);
    $formulario->handleRequest($request);

    if($formulario->isSubmitted() && $formulario->isValid()){
	$this->entityManager->persist($usuario);
	$this->entityManager->flush();
    }
    return $this->render('agrega_usuario/index.html.twig', [
      'controller_name' => 'AgregaUsuarioController',
	    'formulario' => $formulario->createView(),
    ]);
  }
}
