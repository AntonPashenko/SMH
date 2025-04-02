<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model\CreateProductRequest;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'required' => true
            ])
            ->add('category', TextType::class, [
                'label' => false,
                'required' => true
            ])
            ->add('price', NumberType::class, [
                'label' => false,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateProductRequest::class,
        ]);
    }
}
