<?php

namespace Contact\Bundle\ContactBundle\Form\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Contact\Bundle\ContactBundle\Form\EventListener\ContactButtonSubscriber;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('firstName')
            ->add('middleNames')
            ->add('surname');
            // ->add('cancel', 'submit', array('label' => 'Cancel'));

        $builder->addEventSubscriber(new ContactButtonSubscriber());
    }

    public function getName()
    {
        return 'contact';
    }
}
