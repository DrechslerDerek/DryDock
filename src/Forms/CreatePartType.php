<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class CreatePartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('partCategory', ChoiceType::class,[
                'choices' => [
                  'Cockpit' => 'cockpit',
                  'Thruster' => 'thruster',
                  'Weapon' => 'weapon',
                  'Shielding' => 'shielding',
                  'Frame' => 'frame',
                  'Bridge' => 'bridge',
                  'Communications' => 'communications',
                  'Warp Mechanism' => 'warp-mechanism'
                ],
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input',],
                'data' => $options['data']['part']->getCategory(),
            ])
            ->add('partName', null,[
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input'],
                'data' => $options['data']['part']->getName(),
            ])
            ->add('partOrigin', ChoiceType::class,[
                'choices' => [
                    'Andromeda' => 'andromeda',
                    'Condor' => 'condor',
                    'Draco' => 'draco',
                    'Black Eye' => 'black-eye',
                    'Milky Way' => 'milky-way',
                    'Ursa' => 'ursa',
                    'Virgo' => 'virgo'
                ],
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input',],
                'data' => $options['data']['part']->getOrigin(),
            ])
            ->add('partDescription', null,[
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input',],
                'data' => $options['data']['part']->getDescription(),
            ])
            ->add('partPower', NumberType::class,[
                'html5' => true,
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input','min' => 0,'max' => 999,'step' => 1],
                'data' => $options['data']['part']->getPower(),
            ])
            ->add('partDurability', NumberType::class,[
                'html5' => true,
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input','min' => 0,'max' => 999,'step' => 1],
                'data' => $options['data']['part']->getDurability(),
            ])
            ->add('partCost', NumberType::class,[
                'html5' => true,
                'row_attr' => ['class' => 'w-100'],
                'label_attr' => ['class' => 'star-input-label'],
                'attr' => ['class' => 'form-control star-text-input','min' => 0,'max' => 999999,'step' => 1],
                'data' => $options['data']['part']->getCost(),
            ])
        ;
    }
}