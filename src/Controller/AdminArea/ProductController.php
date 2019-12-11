<?php

namespace App\Controller\AdminArea;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
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

        return $this->render('admin/product/products.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/products/add", name="admin_product_add")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $product = new Product();
        $form    = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setCreatedBy($this->getUser());
            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Le produit a été ajouté.');

            return $this->redirectToRoute('admin_products');
        }

        return $this->render('admin/product/product_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/products/{productId}", name="admin_product_edit"), requirements={"companyId": "\d+"}
     */
    public function edit(EntityManagerInterface $em, ProductRepository $productRepository, Request $request, $productId)
    {
        $product = $productRepository->find($productId);

        if (!$product) {
            throw $this->createNotFoundException('Ce produit n\'existe pas/plus !');
        }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUpdatedBy($this->getUser());
            $em->flush();

            $this->addFlash('success', 'Le produit a été modifié.');

            return $this->redirectToRoute('admin_products');
        }

        return $this->render('admin/product/product_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/products/{productId}/delete/{csrf}", name="admin_product_delete"), requirements={"companyId": "\d+"}
     */
    public function delete(EntityManagerInterface $em, ProductRepository $productRepository, $productId, $csrf)
    {
        if (!$this->isCsrfTokenValid('delete-product', $csrf)) {
            throw new InvalidCsrfTokenException();
        }

        $product = $productRepository->find($productId);

        if (!$product) {
            throw $this->createNotFoundException('Ce produit n\'existe pas/plus !');
        }

        $em->remove($product);
        $em->flush();

        $this->addFlash('success', 'Le produit a été supprimé.');

        return $this->redirectToRoute('admin_products');
    }
}
