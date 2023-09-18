<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'required' => true,
                'label' => 'Email',
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input','autocomplete' => 'email'],
            ])
            ->add('password', PasswordType::class,[
                'required' => true,
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input','autocomplete' => 'password'],
            ])
        ;
    }
}