<?php

namespace Contact\Bundle\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Contact\Bundle\ContactBundle\Entity\Contact;
use Contact\Bundle\ContactBundle\Form\Types\ContactType;

class ContactController extends Controller
{
    public function indexAction()
    {
        $contacts = $this->getDoctrine()
            ->getRepository('ContactContactBundle:Contact')
            ->findAllOrderByFavourite();

        return $this->render('ContactContactBundle:Contact:index.html.twig', array(
            'contacts' => $contacts,
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

            $notify = $this->get('contact.notify');
            $notify->add('success', array(
                'type' => 'flash',
                'title' => 'Success!',
                'message' => 'You successfully added ' . $contact->getFirstName() . ' to your contact list!',
            ));

            return $this->redirect($this->generateUrl('contact_contact_show', array('id' => $contact->getId())));
        }

        return $this->render('ContactContactBundle:Contact:createContact.html.twig', array(
            'form'      => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $contact = $this->getDoctrine()
            ->getRepository('ContactContactBundle:Contact')
            ->find($id);

        $form = $this->createForm(new ContactType(), $contact);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $notify = $this->get('contact.notify');
            $notify->add('success', array(
                'type' => 'flash',
                'title' => 'Success!',
                'message' => 'You successfully edited ' . $contact->getFirstName() . '.',
            ));

            return $this->redirect($this->generateUrl('contact_contact_show', array('id' => $id)));
        } elseif ($form->getErrors()) { //don't think this works, always shows?
            $notify = $this->get('contact.notify');
            $notify->add('error', array(
                'type' => 'flash',
                'title' => 'Oh no!',
                'message' => 'You\'ve entered some incorrect details, take a look below to see what\'s wrong.',
            ));
        }

        return $this->render('ContactContactBundle:Contact:editContact.html.twig', array(
            'form'      => $form->createView(),
            'contact'   => $contact,
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

        $notify = $this->get('contact.notify');
        $notify->add('success', array(
            'type' => 'flash',
            'title' => 'Success!',
            'message' => 'You successfully removed ' . $contact->getFirstName() . ' from your contact list.',
        ));

        return $this->redirect($this->generateUrl('contact_contact_homepage'));
    }

    public function toggleFavouriteAction($id, Request $request)
    {
        $contact = $this->getDoctrine()
            ->getRepository('ContactContactBundle:Contact')
            ->find($id);

        if (!$contact) {
            throw $this->createNotFoundException(
                'Contact not found for id '.$id
            );
        }

        $message = $contact->isFavourite()
            ? 'You successfully removed ' . $contact->getFirstName() . ' from your favourites.'
            : 'You successfully added ' . $contact->getFirstName() . ' to your favourites!';

        $contact->setFavourite(!$contact->isFavourite());

        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();

        $notify = $this->get('contact.notify');
        $notify->add('success', array(
            'type' => 'flash',
            'title' => 'Success!',
            'message' => $message,
        ));

        $url = $request->headers->get("referer");
        return new RedirectResponse($url, '307');

        // return $this->redirect($this->generateUrl('contact_contact_homepage'));
    }
}
