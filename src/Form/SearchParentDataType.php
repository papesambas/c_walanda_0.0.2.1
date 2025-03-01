<?php

namespace App\Form;

use App\Data\SearchParentData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchParentDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ de recherche générale pour le père (q)
            ->add('qpere', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom, prénom...',
                ],
            ])

            // Champ de recherche générale pour le père (q)
            ->add('qmere', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom, prénom...',
                ],
            ])


            // Champ pour le numéro de téléphone (telephone)
            ->add('telephonePere', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Numéro de téléphone...',
                ],
            ])

            // Champ pour le NINA (nina)
            ->add('ninaPere', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Numéro d\'identification nationale...',
                ],
            ])
            ->add('telephoneMere', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Numéro de téléphone...',
                ],
            ])

            // Champ pour le NINA (nina)
            ->add('ninaMere', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Numéro d\'identification nationale...',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchParentData::class,
            'method' => 'GET', // Utilise la méthode GET pour permettre de partager l'URL des résultats
            'csrf_protection' => false, // Désactive la protection CSRF pour les formulaires de recherche

        ]);
    }
}
