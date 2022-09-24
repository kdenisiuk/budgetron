<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    public function __construct(
        string $name,
        string $category,
        float $price
    )
    {
        $this->setName($name);
        $this->setCategory($category);
        $this->setPrice($price);

        $this->setCreationDate(new DateTime());
        $this->setUpdateDate(new DateTime());
        $this->setRemoved(false);
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(length: 50)]
    private string $category;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private DateTimeInterface $creationDate;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private DateTimeInterface $updateDate;

    #[ORM\Column]
    private bool $removed = false;

    #[ORM\Column]
    private float $price;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreationDate(): DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getUpdateDate(): DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    public function isRemoved(): bool
    {
        return $this->removed;
    }

    public function setRemoved(bool $removed): self
    {
        $this->removed = $removed;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
