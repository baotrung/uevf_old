<?php

namespace Uevf\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Uevf\PlatformBundle\Form\CityFrType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname',null,array('label' => 'uevf.trans.firstname','translation_domain' => 'UevfPlatformBundle'))
        ->add('lastname',null,array('label' => 'uevf.trans.lastname','translation_domain' => 'UevfPlatformBundle'))
        ->add('birthday',DateType::class,array('label' => 'uevf.trans.birthday','translation_domain' => 'UevfPlatformBundle'))
        ->add('gender',ChoiceType::class,array('label' => 'uevf.trans.gender','translation_domain' => 'UevfPlatformBundle',
            'choices' => array(
                'uevf.trans.other' => 'OTHER', 'uevf.trans.male' => 'MALE', 'uevf.trans.female' => 'FEMALE'
            ),
            'translation_domain' => 'UevfPlatformBundle'
        ))
        ->add('tel',null,array('label' => 'uevf.trans.phonenumber','translation_domain' => 'UevfPlatformBundle'))
        ->add('address',null,array('label' => 'uevf.trans.address','translation_domain' => 'UevfPlatformBundle'))
        ->add('city', CityFrType::class,array('label' => 'uevf.trans.city','translation_domain' => 'UevfPlatformBundle'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uevf\UserBundle\Entity\User',
            'translation_domain' => 'forms'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uevf_userbundle_user';
    }


}
