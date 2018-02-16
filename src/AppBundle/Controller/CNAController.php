<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CNA;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Cna controller.
 *
 * @Route("cna")
 */
class CNAController extends Controller
{
    /**
     * Lists all cNA entities.
     *
     * @Route("/", name="cna_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $cNAs = $em->getRepository('AppBundle:CNA')->getAllCNA($request->query->get('filter'));
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $cNAs, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

//        $cNAs = $em->getRepository('AppBundle:CNA')->findAll();

        return $this->render('cna/index.html.twig', array(
            'pagination' => $pagination,
//            'cNAs' => $cNAs,
        ));
    }

    /**
     * Creates a new cNA entity.
     *
     * @Route("/new", name="cna_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cNA = new Cna();
        $form = $this->createForm('AppBundle\Form\CNAType', $cNA);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cNA);
            $em->flush();

            $this->addFlash(
                'notice',
                'Su entidad ha sido guardada satisfactoriamente'
            );

            return $this->redirectToRoute('cna_index');
        }

        return $this->render('cna/new.html.twig', array(
            'cNA' => $cNA,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cNA entity.
     *
     * @Route("/{id}", name="cna_show")
     * @Method("GET")
     */
    public function showAction(CNA $cNA)
    {
//        $deleteForm = $this->createDeleteForm($cNA);

        return $this->render('cna/show.html.twig', array(
            'cNA' => $cNA,
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cNA entity.
     *
     * @Route("/{id}/edit", name="cna_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CNA $cNA)
    {
        $editForm = $this->createForm('AppBundle\Form\CNAType', $cNA);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'Su entidad ha sido guardada satisfactoriamente'
            );

            return $this->redirectToRoute('cna_index');
        }

        return $this->render('cna/edit.html.twig', array(
            'cNA' => $cNA,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a cNA entity.
     *
     * @Route("/{id}/delete", name="cna_delete")
     */
    public function deleteAction(CNA $cNA)
    {
        if($cNA->getContracts()->count()>0){
            $this->addFlash(
                'error',
                'Su entidad no puede ser eliminada. Tiene contratos asociados'
            );

            return $this->redirectToRoute('ee_index');
        }else{
            $em = $this->getDoctrine()->getManager();

            foreach ($cNA->getEmails() as $email){
                $em->remove($email);
                $em->flush();
            }

            $em->remove($cNA);
            $em->flush();

            $this->addFlash(
                'notice',
                'Su entidad ha sido eliminada satisfactoriamente'
            );


            return $this->redirectToRoute('cna_index');
        }
    }
}
