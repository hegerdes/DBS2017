<?php

namespace OpiumBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('forename', null, ['label' => 'form.forename']);
        $builder->add('surname', null, ['label' => 'form.surname']);
    }

    public function getBlockPrefix()
    {
        return 'opium_user_profile';
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }
}
