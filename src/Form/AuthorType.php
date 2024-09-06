<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('lastname',  TextType::class, ['label' => 'Nom'])
            ->add('dateOfBirth', null, [
                'widget' => 'single_text',
                'label' => 'Date de naissance'
            ])
            ->add('nationality',  ChoiceType::class, [
                'label' => 'Nationalité',
                'choices' => [
                    'Français' => 'français',
                    'Anglais' => 'anglais',
                    'Américain' => 'américain',
                    'Japonais' => 'japonais',
                ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
