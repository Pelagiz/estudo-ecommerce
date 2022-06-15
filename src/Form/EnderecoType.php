<?php

namespace App\Form;

use App\Entity\Endereco;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EnderecoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rua', TextType::class, [
                'attr' => [
                    'placeholder' => 'Digite a Rua...',
                ],
                'label_attr' => [
                    'class' => 'sr-only' 
                ]
            ])
            ->add('bairro', TextType::class, [
                'attr' => [
                    'placeholder' => 'Digite o bairro...',
                ],
                'label_attr' => [
                    'class' => 'sr-only' 
                ]
            ])
            ->add('cidade', TextType::class, [
                'attr' => [
                    'placeholder' => 'Digite a cidade...',
                ],
                'label_attr' => [
                    'class' => 'sr-only' 
                ]
            ])
            ->add('numero', TextType::class, [
                'attr' => [
                    'placeholder' => 'Digite o numero...',
                ],
                'label_attr' => [
                    'class' => 'sr-only' 
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Endereco::class,
        ]);
    }
}
