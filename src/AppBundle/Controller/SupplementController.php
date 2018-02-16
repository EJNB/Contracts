<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Supplement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Supplement controller.
 *
 * @Route("supplement")
 */
class SupplementController extends Controller
{
    /**
     * Lists all supplement entities.
     *
     * @Route("/", name="supplement_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

//        $supplements = $em->getRepository('AppBundle:Supplement')->findAll();
        $supplements = $em->getRepository('AppBundle:Supplement')->getSupplements($request->query->get('filter'));
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $supplements, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('supplement/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new supplement entity.
     *
     * @Route("/new", name="supplement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $supplement = new Supplement();
        $form = $this->createForm('AppBundle\Form\SupplementType', $supplement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $contract = $form->get('contract')->getData();
            $cant = $contract->getSupplements()->count() + 1;
            $supplement->setIdSupplement($contract->getContractNumber().'-S'.$cant);
            $em->persist($supplement);
            $em->flush();

            $this->addFlash(
                'notice',
                'El suplemento ha sido guardado satisfactoriamente'
            );

            return $this->redirectToRoute('supplement_index');
        }

        return $this->render('supplement/new.html.twig', array(
            'supplement' => $supplement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a supplement entity.
     *
     * @Route("/{id}", name="supplement_show")
     * @Method("GET")
     */
    public function showAction(Supplement $supplement)
    {
        return $this->render('supplement/show.html.twig', array(
            'supplement' => $supplement,
        ));
    }

    /**
     * Displays a form to edit an existing supplement entity.
     *
     * @Route("/{id}/edit", name="supplement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Supplement $supplement)
    {
        $editForm = $this->createForm('AppBundle\Form\SupplementType', $supplement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Sus cambios han sido guardado satisfactoriamente'
            );

            return $this->redirectToRoute('supplement_index');
        }

        return $this->render('supplement/edit.html.twig', array(
            'supplement' => $supplement,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a supplement entity.
     *
     * @Route("/{id}/delete", name="supplement_delete")
     */
    public function deleteAction(Request $request, Supplement $supplement)
    {
//        $form = $this->createDeleteForm($supplement);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($supplement);
            $em->flush();

            $this->addFlash(
                'notice',
                'El suplemento ha sido eliminado satisfactoriamente'
            );
//        }

        return $this->redirectToRoute('supplement_index');
    }
//
//    /**
//     * Creates a form to delete a supplement entity.
//     *
//     * @param Supplement $supplement The supplement entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm(Supplement $supplement)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('supplement_delete', array('id' => $supplement->getId())))
//            ->setMethod('DELETE')
//            ->getForm()
//        ;
//    }
}
