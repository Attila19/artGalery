<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/create', name: 'product_create')]
    #[Route('/update/{id}', name: 'product_update')]
    public function index(Request $request, EntityManagerInterface $manager, ProductRepository $repository, $id = null): Response
    {
        $products = $repository->findAll();

        if ($id) {
            $product = $repository->find($id);

        } else {


            $product = new Product();
        }


        $formProduct = $this->createForm(ProductType::class, $product);

        $formProduct->handleRequest($request);

        if ($formProduct->isSubmitted() && $formProduct->isValid()) {
            $manager->persist($product);
            $manager->flush();

            if ($id) {
                $this->addFlash('success', 'Oeuvre modifiée');

            } else {

                $this->addFlash('success', 'Oeuvre ajoutée');
            }


            return $this->redirectToRoute('product_create');


        }


        return $this->render('product/index.html.twig', [
            'formProduct' => $formProduct->createView(),
            'products' => $products,
            'title'=>'Gestion des oeuvres'
        ]);

    }


    #[Route('/delete/{id}', name: 'product_delete')]
    public function deleteProduct(ProductRepository $productRepository, EntityManagerInterface $manager,$id ): Response
    {
        $product=$productRepository->find($id);

        $manager->remove($product);

        $manager->flush();
        $this->addFlash('success', 'Oeuvre supprimée');

        return $this->redirectToRoute('product_create');
    }


}
