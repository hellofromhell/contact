<?php

namespace Contact\Bundle\ContactBundle\Form\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('lineOne')
            ->add('lineTwo')
            ->add('city')
            ->add('county')
            ->add('postCode')
            ->add('add', 'submit', array('label' => 'Add Address'));
    }

    public function getName()
    {
        return 'contact_address';
    }
}
