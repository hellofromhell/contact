<?php

namespace Contact\Bundle\ContactBundle\Form\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('middleNames')
            ->add('surname')
            ->add('add', 'submit', array('label' => 'Add Contact'));
            // ->add('cancel', 'submit', array('label' => 'Cancel'));
    }

    public function getName()
    {
        return 'contact';
    }
}