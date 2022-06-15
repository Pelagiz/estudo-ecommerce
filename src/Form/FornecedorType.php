<?php

namespace App\Form;

use App\Entity\Fornecedor;
use App\Form\EnderecoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FornecedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', TextType::class, [
                'attr' => [
                    'placeholder' => 'Digite o nome do fornecedor...',
                ],
                'label_attr' => [
                    'class' => 'sr-only',
                ]
            ])
            ->add('cnpj', TextType::class, [
                'attr' => [
                    'placeholder' => 'Digite o CNPJ do fornecedor...',
                ],
                'label_attr' => [
                    'class' => 'sr-only' 
                ]
            ])
            ->add('descricao', TextType::class, [
                'attr' => [
                    'placeholder' => 'Digite o descrição do fornecedor...',
                ],
                'label_attr' => [
                    'class' => 'sr-only' 
                ]
            ])
            ->add('endereco', EnderecoType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fornecedor::class,
        ]);
    }
}
