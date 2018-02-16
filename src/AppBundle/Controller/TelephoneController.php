<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Telephone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Telephone controller.
 *
 * @Route("telephone")
 */
class TelephoneController extends Controller
{
    /**
     * Lists all telephone entities.
     *
     * @Route("/", name="telephone_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $telephones = $em->getRepository('AppBundle:Telephone')->findAll();

        return $this->render('telephone/index.html.twig', array(
            'telephones' => $telephones,
        ));
    }

    /**
     * Creates a new telephone entity.
     *
     * @Route("/new", name="telephone_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $telephone = new Telephone();
        $form = $this->createForm('AppBundle\Form\TelephoneType', $telephone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($telephone);
            $em->flush();

            return $this->redirectToRoute('telephone_show', array('id' => $telephone->getId()));
        }

        return $this->render('telephone/new.html.twig', array(
            'telephone' => $telephone,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a telephone entity.
     *
     * @Route("/{id}", name="telephone_show")
     * @Method("GET")
     */
    public function showAction(Telephone $telephone)
    {
        $deleteForm = $this->createDeleteForm($telephone);

        return $this->render('telephone/show.html.twig', array(
            'telephone' => $telephone,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing telephone entity.
     *
     * @Route("/{id}/edit", name="telephone_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Telephone $telephone)
    {
        $deleteForm = $this->createDeleteForm($telephone);
        $editForm = $this->createForm('AppBundle\Form\TelephoneType', $telephone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('telephone_edit', array('id' => $telephone->getId()));
        }

        return $this->render('telephone/edit.html.twig', array(
            'telephone' => $telephone,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a telephone entity.
     *
     * @Route("/{id}", name="telephone_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Telephone $telephone)
    {
        $form = $this->createDeleteForm($telephone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($telephone);
            $em->flush();
        }

        return $this->redirectToRoute('telephone_index');
    }

    /**
     * Creates a form to delete a telephone entity.
     *
     * @param Telephone $telephone The telephone entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Telephone $telephone)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('telephone_delete', array('id' => $telephone->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
