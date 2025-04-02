<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ArrayParameterType;
use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // Добавляем данные, с проверкой на наличие таковых
    public function createProduct(Product $product): void
    {
        if ($this->productExists($product->getTitle())) {
            return;
        }

        $this->getEntityManager()->getConnection()->executeQuery(
            sql: 'INSERT INTO products (title, category, price) 
                    VALUES (:title, :category, :price)',
            params: [
                'title' => $product->getTitle(),
                'category' => $product->getCategory(),
                'price' => $product->getPrice(),
            ],
            types: [
                'title' => Types::STRING,
                'category' => Types::STRING,
                'price' => Types::FLOAT,
            ],
        );
    }

    // Проверем, есть ли продукт в базе
    private function productExists(string $title): bool
    {
        $result = $this->getEntityManager()->getConnection()->executeQuery(
            sql: 'SELECT 1 FROM products WHERE title = :title',
            params: [
                'title' => $title,
            ],
            types: [
                'title' => Types::STRING,
            ],
        )->fetchOne();

        return $result != null;
    }
}