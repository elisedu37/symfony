<?php

namespace App\Form;

use App\Entity\Loan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Ressource;
use App\Entity\User;

class LoanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('created_at')
            ->add('finished_at')
            ->add('returned_at')/*
            ->add('user_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'label',
                'multiple' => true,
            ])
            ->add('ressource_id', EntityType::class, [
                'class' => Ressource::class,
                'choice_label' => 'label',
                'multiple' => true,
            ])*/
                    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Loan::class,
        ]);
    }
}
