<?php

namespace Uevf\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CityFrType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('zipcode',null,array('label' => 'ZIPCODE'))
            ->add('name',ChoiceType::class,array("choices" => array(),'label' => 'CITY NAME'));

         $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function(FormEvent $event){
                $data = $event->getData();
                $form = $event->getForm();
                if ($form->has('name')) {
                    $form->remove('name');
                }

                $form->add('name',ChoiceType::class, array(
                    'choices' => array($data['name']=>$data['name']),
                ));
            }
         );

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uevf\PlatformBundle\Entity\CityFr',
            'translation_domain' => 'forms'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uevf_platformbundle_cityfr';
    }

}
