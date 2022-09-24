<?php

namespace App\Dto\Request\Product;

use Symfony\Component\Validator\Constraints as Assert;

class NewProductDto
{
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    private string $name;

    #[Assert\Type('string')]
    #[Assert\NotBlank]
    private string $category;

    #[Assert\Type('float')]
    #[Assert\NotBlank]
    private float $price;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
