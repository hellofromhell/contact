<?php

namespace Contact\Bundle\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Contact\Bundle\ContactBundle\Entity\Contact;
// use Contact\Bundle\ContactBundle\Repository\Contact;


class ContactController extends Controller
{
    public function indexAction()
    {
        $contacts = $this->getDoctrine()
            ->getRepository('ContactContactBundle:Contact')
            ->findAll();

        return $this->render('ContactContactBundle:Contact:index.html.twig', array(
            'contacts' => $contacts
        ));
    }


    public function createAction($name) //get request info from a form
    {
        $contact = new Contact();
        $contact->setFirstName($name)
                ->setSurname('Reynolds');

        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();

        return $this->render('ContactContactBundle:Contact:contact.html.twig', array(
            'contact' => $contact,
            'message' => 'Succesfully created new contact'
        ));
    }

    public function showAction($id)
    {
        $contact = $this->getDoctrine()
            ->getRepository('ContactContactBundle:Contact')
            ->find($id);

        if (!$contact) {
            throw $this->createNotFoundException(
                'Contact not found for id '.$id
            );
        }

        return $this->render('ContactContactBundle:Contact:contact.html.twig', array(
            'contact' => $contact
        ));
    }
}
