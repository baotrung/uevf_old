<?php

namespace Uevf\AdvertBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Uevf\AdvertBundle\Form\AdvertImageBundle;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('type', ChoiceType::class, array(
                'choices' => array('OFFRE' => 'SELL', 'RECHERCHE' => 'BUY'),
                'data' => 'SELL',
                'expanded' => true,
                'multiple' => false
            ))
            ->add('theme',EntityType::class,array('class' => 'UevfAdvertBundle:AdvertTheme','choice_label' => 'theme'))
            ->add('content')
            ->add('uploads',FileType::class,array(
                'multiple' => true,
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
            'data_class' => 'Uevf\AdvertBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uevf_advertbundle_advert';
    }


}
