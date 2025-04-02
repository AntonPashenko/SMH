<?php

namespace App\Controller;

use App\Forms\FormType;
use App\Model\CreateProductRequest;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PhoneController extends AbstractController
{
    public function __construct(
        private readonly ProductService $productService,
    ){
    }

    #[Route('/api/products', name: 'get_products', methods: ['GET'])]
    public function getPhones(): Response
    {
        return $this->json($this->productService->getPhones());
    }

    #[Route('/api/products/create', name: 'create_product')]
    public function createPhone(Request $request): Response
    {
        $product = new CreateProductRequest();
        $form = $this->createForm(FormType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            try {

                return $this->json($this->productService->createProduct(request: $form->getData()));

            } catch (BadRequestException $exception) {
                throw $exception;
            }
        }
        return $this->render('form.html.twig',[
            'form' => $form->createView()
        ]);
    }
}