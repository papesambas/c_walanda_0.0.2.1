<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Professions;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Champ de recherche générale (q)
            ->add('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom, prénom...',
                ],
            ])

            // Liste des professions (professions)
            // src/Form/YourFormType.php
            ->add('professions', EntityType::class, [
                'label' => false,
                'class' => Professions::class,
                'choice_label' => 'designation',
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('p')
                    ->where('p.designation IS NOT NULL')
                    ->andWhere('p.designation != :empty')
                    ->setParameter('empty', '')
                    ->orderBy('p.designation', 'ASC'),
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'attr' => [
                    'class' => 'select2-profession',
                    'data-placeholder' => 'Sélectionnez une ou plusieurs professions...',
                ],
            ])
            // Champ pour le numéro de téléphone (telephone)
            ->add('telephone', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Numéro de téléphone...',
                ],
            ])

            // Champ pour le NINA (nina)
            ->add('nina', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Numéro d\'identification nationale...',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class, // Associe ce formulaire à la classe SearchData
            'method' => 'GET', // Utilise la méthode GET pour permettre de partager l'URL des résultats
            'csrf_protection' => false, // Désactive la protection CSRF pour les formulaires de recherche
        ]);
    }

    public function getBlockPrefix()
    {
        return ''; // Retourne une chaîne vide pour éviter de préfixer les noms des champs
    }
}
