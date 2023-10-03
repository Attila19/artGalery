<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/create', name: 'user_create')]
    public function index(Request $request, EntityManagerInterface $manager, UserRepository $repository, $id = null): Response
    {
        $users = $repository->findAll();
        if ($id) {
            $user = $repository->find($id);
        } else {
            $user = new User();
        }

        $formUser = $this->createForm(UserType::class, $user);

        $formUser->handleRequest($request);

        if ($formUser->isSubmitted() && $formUser->isValid()) {
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('info', 'Opération réalisée avec succès');
            return $this->redirectToRoute('user_create');
        }

        return $this->render('user/index.html.twig', [
            'formUser' => $formUser->createView(),
            'users' => $users,
            'title'=>'Gestion des utilisateurs'
        ]);
    }}

