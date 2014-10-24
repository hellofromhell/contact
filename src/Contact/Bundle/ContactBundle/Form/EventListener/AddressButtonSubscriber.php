<?php

namespace Contact\Bundle\ContactBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddressButtonSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $address = $event->getData();
        $form = $event->getForm();
        if (!$address || null === $address->getId()) {
            $form->add('add', 'submit', array('label' => 'Add Address'));
        } else {
            $form->add('add', 'submit', array('label' => 'Save Changes'));
        }
    }
}
