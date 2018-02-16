<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Licence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Licence controller.
 *
 * @Route("licence")
 */
class LicenceController extends Controller
{
    /**
     * Lists all licence entities.
     *
     * @Route("/", name="licence_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $licences = $em->getRepository('AppBundle:Licence')->findAll();

        return $this->render('licence/index.html.twig', array(
            'licences' => $licences,
        ));
    }

    /**
     * Creates a new licence entity.
     *
     * @Route("/new", name="licence_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $licence = new Licence();
        $form = $this->createForm('AppBundle\Form\LicenceType', $licence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($licence);
            $em->flush();

            return $this->redirectToRoute('licence_show', array('id' => $licence->getId()));
        }

        return $this->render('licence/new.html.twig', array(
            'licence' => $licence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a licence entity.
     *
     * @Route("/{id}", name="licence_show")
     * @Method("GET")
     */
    public function showAction(Licence $licence)
    {
        $deleteForm = $this->createDeleteForm($licence);

        return $this->render('licence/show.html.twig', array(
            'licence' => $licence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing licence entity.
     *
     * @Route("/{id}/edit", name="licence_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Licence $licence)
    {
        $deleteForm = $this->createDeleteForm($licence);
        $editForm = $this->createForm('AppBundle\Form\LicenceType', $licence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('licence_edit', array('id' => $licence->getId()));
        }

        return $this->render('licence/edit.html.twig', array(
            'licence' => $licence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a licence entity.
     *
     * @Route("/{id}", name="licence_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Licence $licence)
    {
        $form = $this->createDeleteForm($licence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($licence);
            $em->flush();
        }

        return $this->redirectToRoute('licence_index');
    }

    /**
     * Creates a form to delete a licence entity.
     *
     * @param Licence $licence The licence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Licence $licence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('licence_delete', array('id' => $licence->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
