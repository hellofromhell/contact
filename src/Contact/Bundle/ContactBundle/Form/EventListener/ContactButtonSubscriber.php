<?php

namespace Contact\Bundle\ContactBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContactButtonSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $contact = $event->getData();
        $form = $event->getForm();
        if (!$contact || null === $contact->getId()) {
            $form->add('add', 'submit', array('label' => 'Add Contact'));
        } else {
            $form->add('add', 'submit', array('label' => 'Save Changes'));
        }
    }
}
