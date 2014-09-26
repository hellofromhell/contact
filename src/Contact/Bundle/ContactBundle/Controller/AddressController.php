<?php

namespace Contact\Bundle\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Contact\Bundle\ContactBundle\Entity\Contact;
use Contact\Bundle\ContactBundle\Entity\ContactAddress;
use Contact\Bundle\ContactBundle\Form\Types\AddressType;

class AddressController extends Controller
{
    public function addAction($id, Request $request)
    {
        $contact = $this->getDoctrine()
            ->getRepository('ContactContactBundle:Contact')
            ->find($id);

        $address = new ContactAddress();
        $form = $this->createForm(new AddressType(), $address);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $address->setContact($contact);
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
        }

        return $this->render('ContactContactBundle:Contact:addAddress.html.twig', array(
            'form'      => $form->createView(),
            'contact'   => $contact,
            'created'   => $form->isValid()
        ));
    }

    public function deleteAction($id)
    {
        $address = $this->getDoctrine()
            ->getRepository('ContactContactBundle:ContactAddress')
            ->find($id);

        if (!$address) {
            throw $this->createNotFoundException(
                'Address not found for id '.$id
            );
        }

        $contact = $address->getContact();

        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();

        if (!$contact) {
            return $this->redirect($this->generateUrl('contact_contact_homepage'));
        }

        return $this->render('ContactContactBundle:Contact:contact.html.twig', array(
            'contact' => $contact
        ));
    }

    // public function showAction($id)
    // {
    //     $contact = $this->getDoctrine()
    //         ->getRepository('ContactContactBundle:Contact')
    //         ->find($id);

    //     if (!$contact) {
    //         throw $this->createNotFoundException(
    //             'Contact not found for id '.$id
    //         );
    //     }

    //     return $this->render('ContactContactBundle:Contact:contact.html.twig', array(
    //         'contact' => $contact
    //     ));
    // }
}
