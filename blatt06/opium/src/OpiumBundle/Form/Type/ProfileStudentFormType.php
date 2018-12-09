<?php

namespace OpiumBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileStudentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'dateOfBirth',
            DateType::class,
            [
                'horizontal_input_wrapper_class' => 'col-lg-4',
                'widget' => 'single_text',
                'format' => 'dd.MM.y',
                'label' => 'form.date_of_birth',
                'datepicker' => [
                    'data_link' => [
                        'format' => 'dd.mm.yyyy',
                    ],
                ],
            ]
        );
        $builder->add(
            'matriculationNumber',
            IntegerType::class,
            [
                'render_optional_text' => false,
                'label' => 'form.matriculation_number'
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'opium_student_profile';
    }

    public function getParent()
    {
        return 'OpiumBundle\Form\Type\ProfileUserFormType';
    }
}
