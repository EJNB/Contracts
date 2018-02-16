<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->container->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());
            $user->setPassword($password);


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'notice',
                'Su entidad ha sido guardada satisfactoriamente'
            );

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        return $this->render('user/show.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Su entidad ha sido actualizada satisfactoriamente'
            );

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}/delete", name="user_delete")
     */
    public function deleteAction(User $user)
    {
        if ($user->getContracts()->count()>0){
            $this->addFlash(
                'error',
                'El usuario no puede ser eliminado, tiene contratos asociados'
            );
            return $this->redirectToRoute('user_index');
        }else{
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();

            $this->addFlash(
                'notice',
                'El usuario ha sido eliminado satisfactoriamente'
            );

            return $this->redirectToRoute('user_index');
        }

    }

    /**
     * @Route("/{id}/change_password", name="user_change_password")
     */
    public function changePasswordAction(Request $request,User $user){

        $first_password = $request->request->get('first_password');

        $password = $this->container->get('security.password_encoder')
            ->encodePassword($user, $first_password);

        $user->setPassword($password);
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash(
            'notice',
            'La contraseña ha sido cambiada satisfactoriamente'
        );

        return $this->redirectToRoute('user_index');
//        return new Response('ok');
    }
}
