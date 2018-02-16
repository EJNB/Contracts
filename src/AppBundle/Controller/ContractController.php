<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contract;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Contract controller.
 *
 * @Route("contract")
 */
class ContractController extends Controller
{
    /**
     * Lists all contract entities.
     *
     * @Route("/", name="contract_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contracts = $em->getRepository('AppBundle:Contract')->getAllContracts($request->query->get('filter'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $contracts, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

        return $this->render('contract/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Lists all contract entities.
     *
     * @Route("/contract_expired", name="contract_expired_index")
     * @Method("GET")
     */
    public function indexContractsExpiredAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contracts = $em->getRepository('AppBundle:Contract')->getAllContractExpired($request->query->get('filter'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $contracts, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

        return $this->render('contract/expired_contracts.html.twig', array(
            'pagination' => $pagination,
//            'contracts' => $contracts,
        ));
    }

    /**
     * Lists all contract entities.
     *
     * @Route("/contract_no_expired", name="contract_no_expired_index")
     * @Method("GET")
     */
    public function indexContractsNoExpiredAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contracts = $em->getRepository('AppBundle:Contract')->getAllContractNoExpired($request->query->get('filter'));
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $contracts, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );


        return $this->render('contract/active_contracts.html.twig', array(
//            'contracts' => $contracts,
            'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new contract entity.
     *
     * @Route("/new", name="contract_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $contract = new Contract();
        $form = $this->createForm('AppBundle\Form\ContractType', $contract);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();

            $contract->setUser($user);

            //set days
            $to = $contract->getStartDate();
            $from = $contract->getExpirationDate();
            $dif = $from->diff($to);
            $contract->setDays($dif->days);

//            $file = $contract->getPdfContract();
//            // Generate a unique name for the file before saving it
//            $fileName = md5(uniqid()).'.'.$file->guessExtension();
//            // Move the file to the directory where brochures are stored
//            $file->move(
//                $this->getParameter('contracts_directory'),
//                $fileName
//            );
//            $contract->setPdfContract($fileName);

            $em->persist($contract);
            $em->flush();

            $this->addFlash(
                'notice',
                'Su contrato ha sido guardado satisfactoriamente'
            );

            return $this->redirectToRoute('contract_index');
        }

        return $this->render('contract/new.html.twig', array(
            'contract' => $contract,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a contract entity.
     *
     * @Route("/{id}", name="contract_show")
     * @Method("GET")
     */
    public function showAction(Contract $contract)
    {
//        $deleteForm = $this->createDeleteForm($contract);

        return $this->render('contract/show.html.twig', array(
            'contract' => $contract,
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing contract entity.
     *
     * @Route("/{id}/edit", name="contract_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Contract $contract)
    {
        $editForm = $this->createForm('AppBundle\Form\ContractType', $contract);
//        $request->request->set('pdfContract',$contract->getPdfContract()); //seteo lo q viene en el request
//        $parameters = $request->request->all();//obtengo todos los parametros q bienen en el request
//        $pdf = $parameters['pdfContract']; //tomo el pdf
        $editForm->handleRequest($request);
//        $contract->setPdfContract($pdf);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

//            if($editForm->get('pdfContract')->getData()) {
//                $file = $editForm->get('pdfContract')->getData();
//                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
//                $file->move(
//                    $this->getParameter('contracts_directory'),
//                    $fileName
//                );
//                $contract->setPdfContract($fileName);
//            }

            $this->getDoctrine()->getManager()->flush();


            $this->addFlash(
                'notice',
                'Su contrato ha sido guardado satisfactoriamente'
            );

            return $this->redirectToRoute('contract_index');
        }

        return $this->render('contract/edit.html.twig', array(
            'contract' => $contract,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a contract entity.
     *
     * @Route("/{id}/delete", name="contract_delete")
     */
    public function deleteAction(Contract $contract)
    {
        if($contract->getSupplements()->count()>0){
            $this->addFlash(
                'error',
                'El contrato no puede ser eliminado, tiene suplementos asociados'
            );

            return $this->redirectToRoute('contract_index');
        }else{
            $em = $this->getDoctrine()->getManager();
            $em->remove($contract);
            $em->flush();
            $this->addFlash(
                'notice',
                'El contrato ha sido eliminado satisfactoriamente'
            );

            return $this->redirectToRoute('contract_index');
        }
    }
}
