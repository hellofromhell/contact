<?php

namespace Contact\Bundle\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Contact\Bundle\ContactBundle\Entity\Contact;
use Contact\Bundle\ContactBundle\Form\Types\ContactType;

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


    public function createAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            // return $this->redirect($this->generateUrl('contact_contact_create_contact_success'));
        }

        return $this->render('ContactContactBundle:Contact:createContact.html.twig', array(
            'form'      => $form->createView(),
            'created'   => $form->isValid()
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

    public function deleteAction($id)
    {
        $contact = $this->getDoctrine()
            ->getRepository('ContactContactBundle:Contact')
            ->find($id);

        if (!$contact) {
            throw $this->createNotFoundException(
                'Contact not found for id '.$id
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();

        return $this->redirect($this->generateUrl('contact_contact_homepage'));
    }
}
