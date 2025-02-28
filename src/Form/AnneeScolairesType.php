<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\AnneeScolaires;
use App\Entity\FraisScolaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AnneeScolairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentYear = (int) (new \DateTime())->format('Y');

        $builder
            ->add('anneeDebut', IntegerType::class, [
                'constraints' => [
                    new Range([
                        'max' => $currentYear,
                        'maxMessage' => 'L\'année de début ne peut pas être dans le futur.',
                    ]),
                ],
                'attr' => [
                    'max' => $currentYear,
                ],
            ])
            ->add('anneeFin', IntegerType::class, [
                'label' => 'Année de fin',
                'attr' => ['readonly' => true],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnneeScolaires::class,
        ]);
    }
}
