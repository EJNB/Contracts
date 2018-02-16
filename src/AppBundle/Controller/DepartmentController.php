<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Department;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Department controller.
 *
 * @Route("department")
 */
class DepartmentController extends Controller
{
    /**
     * Lists all department entities.
     *
     * @Route("/", name="department_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $department = new Department();
        $form = $this->createForm('AppBundle\Form\DepartmentType', $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($department);
            $em->flush();

            $this->addFlash(
                'notice',
                'El departamento ha sido guardado satisfactoriamente'
            );

            return $this->redirectToRoute('department_index');
        }


        $departments = $em->getRepository('AppBundle:Department')->findAll();

        return $this->render('department/index.html.twig', array(
            'departments' => $departments,
            'department' => $department,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new department entity.
     *
     * @Route("/new", name="department_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $department = new Department();
        $form = $this->createForm('AppBundle\Form\DepartmentType', $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($department);
            $em->flush();

            return $this->redirectToRoute('department_show', array('id' => $department->getId()));
        }

        return $this->render('department/new.html.twig', array(
            'department' => $department,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a department entity.
     *
     * @Route("/{id}", name="department_show")
     * @Method("GET")
     */
    public function showAction(Department $department)
    {
        $deleteForm = $this->createDeleteForm($department);

        return $this->render('department/show.html.twig', array(
            'department' => $department,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing department entity.
     *
     * @Route("/{id}/edit", name="department_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Department $department)
    {
        $editForm = $this->createForm('AppBundle\Form\DepartmentType', $department);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('department_index');
        }

        return $this->render('department/edit.html.twig', array(
            'department' => $department,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a department entity.
     *
     * @Route("/{id}/delete", name="department_delete")
     */
    public function deleteAction(Request $request, Department $department)
    {
//        $form = $this->createDeleteForm($department);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
        if ($department->getUsers()->count()!=0 || $department->getContracts()->count()!=0){
            $this->addFlash(
                'error',
                'El departamento no puede ser eliminado, tiene usuarios asociados'
            );
        }else{
            $em = $this->getDoctrine()->getManager();
            $em->remove($department);
            $em->flush();
            $this->addFlash(
                'notice',
                'El departamento fue eliminado satisfactoriamente'
            );
        }

        return $this->redirectToRoute('department_index');
    }

//    /**
//     * Creates a form to delete a department entity.
//     *
//     * @param Department $department The department entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm(Department $department)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('department_delete', array('id' => $department->getId())))
//            ->setMethod('DELETE')
//            ->getForm()
//        ;
//    }
}
