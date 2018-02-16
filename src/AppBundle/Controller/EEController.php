<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EE;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ee controller.
 *
 * @Route("ee")
 */
class EEController extends Controller
{
    /**
     * Lists all eE entities.
     *
     * @Route("/", name="ee_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $eEs = $em->getRepository('AppBundle:EE')->getAllEE($request->query->get('filter'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $eEs, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

        return $this->render('ee/index.html.twig', array(
            'pagination' => $pagination,
//            'eEs' => $eEs,
        ));
    }

    /**
     * Creates a new eE entity.
     *
     * @Route("/new", name="ee_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $eE = new Ee();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('AppBundle\Form\EEType', $eE);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $supplierEE = $em->getRepository('AppBundle:EE')->checkSupplierName($form->get('name')->getData());
            if ($supplierEE){//SI EL NOMBRE COINCIDE CON EL
                $this->addFlash(
                    'error',
                    'Este proveedor ya existe'
                );

                return $this->render('ee/new.html.twig', array(
                    'eE' => $eE,
                    'form' => $form->createView(),
                ));
//
            }else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($eE);
                $em->flush();

                $emails = $form->get('emails')->getData();
                $telephones = $form->get('phones')->getData();

                foreach ($emails as $email){
                    $email->setSupplier($eE);
                    $em->flush();
                }

                foreach ($telephones as $telephone){
                    $telephone->setSupplier($eE);
                    $em->flush();
                }

                $this->addFlash(
                    'notice',
                    'Su entidad ha sido guardada satisfactoriamente'
                );

                return $this->redirectToRoute('ee_index');
            }
        }

        return $this->render('ee/new.html.twig', array(
            'eE' => $eE,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a eE entity.
     *
     * @Route("/{id}", name="ee_show")
     * @Method("GET")
     */
    public function showAction(EE $eE)
    {
//        $deleteForm = $this->createDeleteForm($eE);

        return $this->render('ee/show.html.twig', array(
            'eE' => $eE,
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing eE entity.
     *
     * @Route("/{id}/edit", name="ee_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EE $eE)
    {
//        $deleteForm = $this->createDeleteForm($eE);
        $editForm = $this->createForm('AppBundle\Form\EEType', $eE);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Su entidad ha sido guardada satisfactoriamente'
            );


            return $this->redirectToRoute('ee_index');
        }

        return $this->render('ee/edit.html.twig', array(
            'eE' => $eE,
            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a eE entity.
     *
     * @Route("/{id}/delete", name="ee_delete")
     */
    public function deleteAction(EE $eE)
    {
        //vwerifico q este proveedor no tenga contratos asociados
        if($eE->getContracts()->count()>0){
            $this->addFlash(
                'error',
                'Su entidad no puede ser eliminada. Tiene contratos asociados'
            );

            return $this->redirectToRoute('ee_index');
        }else{
            $em = $this->getDoctrine()->getManager();

            foreach ($eE->getEmails() as $email){
                $em->remove($email);
                $em->flush();
            }

            $em->remove($eE);
            $em->flush();

            $this->addFlash(
                'notice',
                'Su entidad ha sido eliminada satisfactoriamente'
            );


            return $this->redirectToRoute('ee_index');
        }
    }
}
