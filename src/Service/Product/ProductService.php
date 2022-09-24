<?php

namespace App\Service\Product;

use App\Dto\Request\Product\EditProductDto;
use App\Dto\Request\Product\NewProductDto;
use App\Entity\Product;
use App\Repository\ProductRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ProductRepository $productRepository
    )
    {
    }

    public function addNewProduct(NewProductDto $dto)
    {

        $product = new Product(
            $dto->getName(),
            $dto->getCategory(),
            $dto->getPrice()
        );

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function editProduct(EditProductDto $dto)
    {

        $product = $this->productRepository->getProductById($dto->getId());

        if (!is_null($dto->getName())){
            $product->setName($dto->getName());
        }

        if (!is_null($dto->getCategory())){
            $product->setCategory($dto->getCategory());
        }

        $product->setUpdateDate(new DateTime());

        $this->entityManager->flush();
    }

    public function getAllProducts(): array
    {
        return $this->productRepository->getAllNotRemovedProducts();
    }

    public function getSingleProduct(int $productId): Product
    {

        return $this->productRepository->getProductById($productId);
    }
}
