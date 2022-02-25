<?php

namespace App\Form;

use App\Entity\Ressource;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Group;
use App\Entity\Loan;
use App\Entity\Category;

class RessourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('image')
            ->add('description')
            ->add('quantity_total')/*
            ->add('loan', EntityType::class, [
                'class' => Loan::class,
                'choice_label' => 'label',
                'multiple' => true,
            ])*/
            
            ->add('group_id', EntityType::class, [
                'class' => Group::class,
                'choice_label' => 'label',
                'multiple' => true,
            ])
            
            ->add('category',  EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'label',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressource::class,
        ]);
    }
}
