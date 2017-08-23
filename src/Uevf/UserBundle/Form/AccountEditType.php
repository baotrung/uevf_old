<?php

namespace Uevf\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class AccountEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('password')
            ->remove('avatar');
    }

    public function getParent(){
        return AccountType::class;
    }
}
