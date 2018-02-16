<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class EEType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codReuup',TextType::class,array(
                'attr' => array(
                    'class'=> 'form-control',
                ),
                'invalid_message' => 'Por favor introdusca un número valido',
                'required' => false
            ))
            ->add('codNit',IntegerType::class,array(
                'attr' => array( 'class'=> 'form-control' ),
                'required' => false
            ))
            ->add('name',TextType::class,array(
                'attr' => array( 'class'=> 'form-control' )
            ))
            ->add('address',TextType::class,array(
                'attr' => array( 'class'=> 'form-control' )
            ))
            ->add('cucAccount',TextType::class,array(
                'attr' => array( 'class'=> 'form-control' ),
                'required' => false
            ))
            ->add('cupAccount',TextType::class,array(
                'attr' => array( 'class'=> 'form-control' ),
                'required' => false
            ))
            ->add('usdAccount', TextType::class,array(
                'attr' => array( 'class'=> 'form-control' ),
                'required' => false
            ))
//            ->add('socialObject',TextType::class,array(
//                'attr' => array( 'class'=> 'form-control' )
//            ))
            ->add('emails',CollectionType::class,array(
                'entry_type' => EmailType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('phones',CollectionType::class,array(
                'entry_type' => TelephoneType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
//            ->add('accounts', CollectionType::class,array(
//                'entry_type' => AccountType::class,
//                'entry_options' => array('label' => false),
//                'allow_add' => true,
//                'by_reference' => false,
//                'allow_delete' => true,
//                'label' => false
//            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EE'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ee';
    }


}
