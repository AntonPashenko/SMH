<?php

namespace App\Service;

use App\Entity\Product;
use App\Model\CreateProductRequest;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    public function __construct(
        private readonly QueryService  $queryService,
        private readonly EntityManagerInterface $entityManager,
        private readonly ProductRepository $productRepository,
    ){
    }

    // Получаем данные, валидируем и созраняем в базу
    public function getPhones(): array
    {
        $response = $this->queryService->queryGet(endpoint: 'category/smartphones');

        $result = [];

        foreach ($response['products'] as $value) {
                if(preg_match('/(iPhone)/', $value['title'])) {

                    $result[] = $value;

                    $this->productRepository->createProduct(product: $this->createItem(data: $value));
                }
        }

        $this->entityManager->flush();

        return $result;

    }

    // Создаем новый продукт
    public function createProduct(CreateProductRequest $request): array
    {
        foreach ($request as $key => $value) {
            $body[$key] = $value;
        }
        $body = ['title' => $request->getTitle(), 'price' => $request->getPrice(), 'category' => $request->getCategory()];
        $response = $this->queryService->queryPost(endpoint: 'add', body: $body);

        $this->productRepository->createProduct(product: $this->createItem(data: $body));

        return $response;
    }

    // Вспомогательный метод по созданию объекта
    private function createItem(array $data): Product
    {
        return (new Product())
            ->setTitle($data['title'])
            ->setPrice($data['price'])
            ->setCategory($data['category']);
    }

}