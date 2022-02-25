<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Group;
use App\Entity\Loan;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('password')
            //->add('roles')   
            ->add('group_id', EntityType::class, [
                'class' => Group::class,
                'choice_label' => 'label',
                'multiple' => false,
            ])     /*
            ->add('loan_id', EntityType::class, [
                'class' => Loan::class,
                'choice_label' => 'label',
                'multiple' => true,
            ])*/
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
