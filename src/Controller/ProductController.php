<?php

namespace App\Controller;

use App\Dto\Request\Product\EditProductDto;
use App\Dto\Request\Product\NewProductDto;
use App\Form\EditProductForm;
use App\Form\NewProductForm;
use App\Service\Product\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    public function __construct(
        private readonly ProductService $productService
    )
    {
    }

    #[Route('/product')]
    public function addProduct(Request $request): RedirectResponse|Response
    {
        $productDto = new NewProductDto();

        $form = $this->createForm(NewProductForm::class, $productDto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $productDto = $form->getData();

            $this->productService->addNewProduct($productDto);

            return $this->redirectToRoute('app_product_addproduct');
        }

        return $this->renderForm('Product/addProduct.html.twig', ['form' => $form]);

    }

    #[Route('/editProduct/{productId}')]
    public function editProduct(Request $request): RedirectResponse|Response
    {
        $productDto = new EditProductDto();

        $form = $this->createForm(EditProductForm::class, $productDto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $productDto = $form->getData();

            $this->productService->editProduct($productDto);

            return$this->redirectToRoute('app_product_getproductslist');
        }

        return $this->renderForm('Product/editProduct.html.twig', ['form' => $form]);
    }

    #[Route('product/list')]
    public function getProductsList(): Response
    {
        $list = $this->productService->getAllProducts();
        return $this->render('/Product/allProductsList.html.twig', ['list' => $list]);
    }

    #[Route('/getProduct/{productId}')]
    public function getProduct(int $productId)
    {
        $product = $this->productService->getSingleProduct($productId);

        return $this->render('Product/productDetails.html.twig', ['product' => $product]);
    }

}