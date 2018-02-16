<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\LicenceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TCPType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ci',IntegerType::class,array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('name',TextType::class,array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('address',TextType::class,array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('cucAccount',TextType::class,array(
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('cupAccount',TextType::class,array(
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('socialObject',TextareaType::class,array(
                'attr' => array('class' => 'form-control')
            ))
            ->addEventListener(FormEvents::PRE_SET_DATA,function (FormEvent $event){
                $tcp = $event->getData();
                $form = $event->getForm();
                if (!$tcp || null === $tcp->getId()) {
                    $form->add('licence',LicenceType::class,array(
////                    'label'=> false,//
                    ));
                }/*else{
                    $form->add('licence',EntityType::class,array(
                        'class' => 'AppBundle\Entity\Licence',
                        'multiple' => false,
                        'expanded' => true
                    ));
                }*/
            })
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
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TCP'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_tcp';
    }


}
