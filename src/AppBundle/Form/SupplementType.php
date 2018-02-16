<?php

namespace AppBundle\Form;

use AppBundle\Entity\Contract;
use AppBundle\Entity\Supplement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class SupplementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('consecutiveNumber')
            ->add('contractualObject',TextareaType::class,array(
                'attr' => array('class' => 'form-control','rows' => '5')
            ))
            ->add('cucValue',MoneyType::class,array(
                'currency' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('cupValue',MoneyType::class,array(
                'currency' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('contract',EntityType::class,array(
                'class' => 'AppBundle\Entity\Contract',
                'attr' => array(
                    'class'=>'form-control selectpicker',
                    'data-live-search' => true,
                    'data-width' => '70%',
                    'title' => 'Seleccione el contrato',
                ),
                'choice_attr' => function($val, $key, $index){
                    return [
                        'data-subtext' => strtolower($val->getcontractNumber())
                    ];
                },
//                'choice_value' => function(Contract $contract=null){
//                    return $contract ? $contract->getConsecutiveNumber() : '';
//                }
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Supplement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_supplement';
    }


}
