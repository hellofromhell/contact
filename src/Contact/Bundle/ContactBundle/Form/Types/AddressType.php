<?php

namespace Contact\Bundle\ContactBundle\Form\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Contact\Bundle\ContactBundle\Form\EventListener\AddressButtonSubscriber;

class AddressType extends AbstractType
{
    protected $message;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('lineOne')
            ->add('lineTwo')
            ->add('city')
            ->add('county')
            ->add('postCode');

        $builder->addEventSubscriber(new AddressButtonSubscriber());
    }

    public function getName()
    {
        return 'contact_address';
    }
}
