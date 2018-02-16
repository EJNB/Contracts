<?php

namespace AppBundle\Form;

use AppBundle\Entity\Contract;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
class ContractType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('consecutiveNumber',IntegerType::class)
            ->add('contractNumber',TextType::class)
            ->add('startDate',DateTimeType::class,array(
                'label' => 'Fecha',
                'widget' => 'single_text',
                'attr' => array('class' => 'form-control'),
                'required' => true,
                'input' => 'datetime',
//                'format' => 'YYYY-MM-DD'

            ))
            ->add('expirationDate',DateTimeType::class,array(
                'label' => 'Fecha',
                'widget' => 'single_text',
                'attr' => array('class' => 'form-control'),
                'required' => true,
                'input' => 'datetime',
//                'format' => 'YYYY-MM-DD'

            ))
            ->add('contractualObject',TextareaType::class,array(
                'attr' => array('class' => 'form-control','rows' => '8  '),
            ))
            ->add('cucValue',MoneyType::class,array(
                'currency' => false,
                'attr' => array('class' => 'form-control'),
                'grouping' => 5,
                'attr' => array('class' => 'form-control'),

            ))
            ->add('cupValue',MoneyType::class,array(
                'currency' => false,
                'grouping' => 5,
                'attr' => array('class' => 'form-control'),

            ))
            ->add('totalAmount',MoneyType::class,array(
                'currency' => false,
                'attr' => array('class' => 'form-control'),
                'grouping' => 5,
            ))
            ->add('type',TextType::class,array(
                'attr' => array( 'class'=>'form-control')
            ))
//            ->add('cucScope',MoneyType::class,array(
//                'currency' => false,
//                'attr' => array('class' => 'form-control')
//            ))
//            ->add('cupScope',MoneyType::class,array(
//                'currency' => false,
//                'attr' => array('class' => 'form-control')
//            ))
            ->add('agreementNoUASI',IntegerType::class,array(
                'attr' => array( 'class' => 'form-control'),
                'required' => false
            ))
            ->add('agreementNoCUBANACAN',IntegerType::class,array(
                'attr' => array( 'class' => 'form-control'),
                'required' => false
            ))
//            ->add('pdfContract',FileType::class, array(
//                'label' => 'Contrato en pdf: ',
//                'required' => false,
//                'data_class' => null,
//            ))
            ->add('suplier',EntityType::class,array(
                'class' => 'AppBundle:Supplier',
                'attr' => array(
                    'class' => 'form-control selectpicker',
                    'data-live-search' => true,
                    'data-size' => 10
                ),
                'placeholder' => 'Por favor seleccione el proveedor'
            ))
            ->add('agreementDateUASI',DateTimeType::class,array(
                'label' => 'Fecha',
                'widget' => 'single_text',
                'attr' => array('class' => 'form-control'),
                'required' => true,
                'input' => 'datetime',
                'required' => false
            ))
            ->add('agreementDateCC',DateTimeType::class,array(
                'label' => 'Fecha',
                'widget' => 'single_text',
                'attr' => array('class' => 'form-control'),
                'required' => true,
                'input' => 'datetime',
                'required' => false
            ))
            ->add('department',EntityType::class,array(
                'class' => 'AppBundle\Entity\Department',
                'attr' => array(
                    'class' => 'form-control selectpicker',
                    'data-live-search' => true,
                    'data-size' => 10,
                ),
                'placeholder' => 'Seleccione el departamento'
            ))
//            ->add('confirmed',CheckboxType::class,array(
//                'required' => false,
//                'attr' => array(
//                    'class' => 'icheck'
//                ),
//                'label' => 'Aprobado:',
//                'required' => false
//            ))
        ;
    }

    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contract'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contract';
    }


}
