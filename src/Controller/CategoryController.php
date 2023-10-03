<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    #[Route('/category')]
class CategoryController extends AbstractController
{
    #[Route('/create', name: 'category_create')]
    public function index(Request $request, EntityManagerInterface $manager, CategoryRepository $repository, $id = null): Response
    {
        $categories = $repository->findAll();
        if ($id) {
            $category = $repository->find($id);
        } else {
            $category = new Category();
        }

        $formCategory = $this->createForm(ActivityCategoryType::class, $category);

        $formCategory->handleRequest($request);

        if ($formCategory->isSubmitted() && $formCategory->isValid()) {
            $manager->persist($category);
            $manager->flush();
            $this->addFlash('info', 'Opération réalisée avec succès');
            return $this->redirectToRoute('category_create');
        }

        return $this->render('category/index.html.twig', [
            'formCategory' => $formCategory->createView(),
            'categories' => $categories,
            'title'=>'Gestion des catégories'
        ]);
    }}