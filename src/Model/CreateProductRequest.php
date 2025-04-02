<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints\NotBlank;
class CreateProductRequest
{
    #[NotBlank]
    private string $title;
    #[NotBlank]
    private string $category;
    #[NotBlank]
    private string $price;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}