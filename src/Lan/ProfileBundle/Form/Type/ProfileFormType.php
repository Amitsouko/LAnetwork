<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lan\ProfileBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('file')
        ->add("lastImageUpdate", "date",array("data" => new \DateTime("now"), "attr" => array("class" => "hidden") ));
    }

    public function getName()
    {
        return 'custom_profile';
    }

    public function getParent()
    {
        return 'fos_user_profile';
    }
}
