<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commande')]
class CommandeController extends AbstractController
{
    #[Route('/create', name: 'commande_create')]
    public function index(Request $request, EntityManagerInterface $manager, CommandeRepository $repository, $id = null): Response
    {

$commandes = $repository->findAll();
        if ($id) {
            $commande = $repository->find($id);
        } else {
            $commande = new Commande();
        }

        $formCommande = $this->createForm(CommandeType::class, $commande);

        $formCommande->handleRequest($request);

        if ($formCommande->isSubmitted() && $formCommande->isValid()) {
            $manager->persist($commande);
            $manager->flush();
            $this->addFlash('info', 'Opération réalisée avec succès');
            return $this->redirectToRoute('commande_create');
        }

        return $this->render('commande/index.html.twig', [
            'formCommande' => $formCommande->createView(),
            'commandes' => $commandes,
            'title'=>'Gestion des commandes'
        ]);
    }}
