<?php

namespace App\Controller\AdminArea;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\Repository\ProductRepository;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="admin_products")
     */
    public function index(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();

        return $this->render('admin/product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/products/add", name="admin_product_add")
     */
    public function add(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $product->setCreatedBy($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Le produit a été ajouté.');

            return $this->redirectToRoute('admin_products');
        }

        return $this->render('admin/product/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/products/{id}", name="admin_product_edit"), requirements={"id": "\d+"}
     */
    public function edit(ProductRepository $productRepository, Request $request, $id)
    {
        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Ce produit n\'existe pas/plus !');
        }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $product->setUpdatedBy($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le produit a été modifié.');

            return $this->redirectToRoute('admin_products');
        }

        return $this->render('admin/product/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/products/{id}/delete/{csrf}", name="admin_product_delete"), requirements={"id": "\d+"}
     */
    public function delete(ProductRepository $productRepository, $id, $csrf)
    {
        if (!$this->isCsrfTokenValid('delete-product', $csrf)) {
            throw new InvalidCsrfTokenException();
        }

        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Ce produit n\'existe pas/plus !');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        $this->addFlash('success', 'Le produit a été supprimé.');

        return $this->redirectToRoute('admin_products');
    }
}
