<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Licence;
use AppBundle\Entity\TCP;
use AppBundle\Form\LicenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tcp controller.
 *
 * @Route("tcp")
 */
class TCPController extends Controller
{
    /**
     * Lists all tCP entities.
     *
     * @Route("/", name="tcp_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tCPs = $em->getRepository('AppBundle:TCP')->getAllTcp($request->query->get('filter'));
//        $tCPs = $em->getRepository('AppBundle:TCP')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tCPs, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

        return $this->render('tcp/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new tCP entity.
     *
     * @Route("/new", name="tcp_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tCP = new Tcp();
        $form = $this->createForm('AppBundle\Form\TCPType', $tCP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $tcp = $em->getRepository('AppBundle:TCP')->checkSupplierName($form->get('name')->getData());
            if ($tcp){

                $this->addFlash(
                    'error',
                    'Este proveedor ya existe'
                );

                return $this->render('tcp/new.html.twig', array(
                    'tCP' => $tCP,
                    'form' => $form->createView(),
                ));

            }else{
                $em->persist($tCP);
                $em->flush();

                $licence = $form->get('licence')->getData();

                $tCP->addLicence($licence);
                $em->persist($licence);
                $em->flush();

                $emails = $form->get('emails')->getData();
                $telephones = $form->get('phones')->getData();
                foreach ($emails as $email){
                    $email->setSupplier($tCP);
                    $em->flush();
                }
                foreach ($telephones as $telephone){
                    $telephone->setSupplier($tCP);
                    $em->flush();
                }

                $this->addFlash(
                    'notice',
                    'Su entidad ha sido guardada satisfactoriamente'
                );

                return $this->redirectToRoute('tcp_index');
            }
        }

        return $this->render('tcp/new.html.twig', array(
            'tCP' => $tCP,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tCP entity.
     *
     * @Route("/{id}", name="tcp_show")
     * @Method("GET")
     */
    public function showAction(TCP $tCP)
    {
//        $deleteForm = $this->createDeleteForm($tCP);

        return $this->render('tcp/show.html.twig', array(
            'tCP' => $tCP,
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tCP entity.
     *
     * @Route("/{id}/edit", name="tcp_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TCP $tCP)
    {
        $em = $this->getDoctrine()->getManager();
        $originalEmails = new ArrayCollection();
        // Create an ArrayCollection of the current Tag objects in the database
//        foreach ($tCP->getEmails() as $email) {
//            $originalEmails->add($email);
//        }
        $editForm = $this->createForm('AppBundle\Form\TCPType', $tCP);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            // remove the relationship between the email and the tcp
//            foreach ($originalEmails as $email) {
//                if (false === $tCP->getEmails()->contains($email)) {
//                    // remove the Task from the Tag
//                    $email->getSupplier()->removeElement($tCP);
//                    // if it was a many-to-one relationship, remove the relationship like this
//                    // $tag->setTask(null);
//                    $em->persist($email);
//                    // if you wanted to delete the Tag entirely, you can also do that
//                    // $em->remove($tag);
//                }
//            }
            $emails = $editForm->get('emails')->getData();
            $telephones = $editForm->get('phones')->getData();
            foreach ($emails as $email){
                $email->setSupplier($tCP);
                $em->flush();
            }
            foreach ($telephones as $telephone){
                $telephone->setSupplier($tCP);
                $em->flush();
            }

            $em->persist($tCP);
            $em->flush();
//            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tcp_index');
        }

        return $this->render('tcp/edit.html.twig', array(
            'tCP' => $tCP,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a tCP entity.
     *
     * @Route("/{id}/delete", name="tcp_delete")
     */
    public function deleteAction(TCP $tCP)
    {
        if($tCP->getContracts()->count()>0){
            $this->addFlash(
                'error',
                'El TCP no puede ser eliminado. Tiene contratos asociados'
            );

        }else {
            $em = $this->getDoctrine()->getManager();
            foreach ($tCP->getEmails() as $email){
                $em->remove($email);
                $em->flush();
            }
            $em->remove($tCP);
            $em->flush();

            $this->addFlash(
                'notice',
                'Su entidad ha sido eliminada satisfactoriamente'
            );

        }

        return $this->redirectToRoute('tcp_index');
    }
}
