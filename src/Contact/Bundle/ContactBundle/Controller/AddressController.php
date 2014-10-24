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

            $notify = $this->get('contact.notify');
            $notify->add('success', array(
                'type' => 'flash',
                'title' => 'Success!',
                'message' => "You successfully added address '" . $address->getTitle() . "' for " . $contact->getFirstName() . "!",
            ));

            return $this->redirect($this->generateUrl('contact_contact_show', array('id' => $id)));
        }

        return $this->render('ContactContactBundle:Contact:addAddress.html.twig', array(
            'form'      => $form->createView(),
            'contact'   => $contact,
            'address'   => $address,
        ));
    }

    public function editAction($contactId, $addressId, Request $request)
    {
        $contact = $this->getDoctrine()
            ->getRepository('ContactContactBundle:Contact')
            ->find($contactId);

        $address = $this->getDoctrine()
            ->getRepository('ContactContactBundle:ContactAddress')
            ->find($addressId);

        $form = $this->createForm(new AddressType(), $address);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $notify = $this->get('contact.notify');
            $notify->add('success', array(
                'type' => 'flash',
                'title' => 'Success!',
                'message' => 'You successfully made changes to ' . $address->getTitle() . '.',
            ));

            return $this->redirect($this->generateUrl('contact_contact_show', array('id' => $contactId)));
        }

        return $this->render('ContactContactBundle:Contact:editAddress.html.twig', array(
            'form'      => $form->createView(),
            'contact'   => $contact,
            'address'   => $address,
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

        $notify = $this->get('contact.notify');
        $notify->add('success', array(
            'type' => 'flash',
            'title' => 'Success!',
            'message' => 'You successfully removed ' . $address->getTitle() . '.',
        ));

        if (!$contact) {
            return $this->redirect($this->generateUrl('contact_contact_homepage'));
        }

        return $this->render('ContactContactBundle:Contact:contact.html.twig', array(
            'contact' => $contact
        ));
    }
}
