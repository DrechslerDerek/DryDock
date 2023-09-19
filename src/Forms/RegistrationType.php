<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('captain', null,[
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input','value' => 'Cpt. '],
            ])
            ->add('email', EmailType::class,[
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input','autocomplete' => 'email'],
            ])
            ->add('password', PasswordType::class,[
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input',],
            ])
        ;
    }
}