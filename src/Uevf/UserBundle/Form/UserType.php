<?php

namespace Uevf\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        ->add('firstname',null,array('label' => 'FIRSTNAME'))
        ->add('lastname',null,array('label' => 'LASTNAME'))
        ->add('birthday',DateType::class,array('label' => 'BIRTHDAY'))
        ->add('tel',null,array('label' => 'PHONE NUMBER'))
        ->add('address',null,array('label' => 'ADDRESS'))
        ->add('city', CityFrType::class,array('label' => 'CITY'));
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
