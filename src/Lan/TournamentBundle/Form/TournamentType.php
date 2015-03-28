<?php

namespace Lan\TournamentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TournamentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('type')
            ->add('description')
            ->add('dateCreation')
            ->add('dateUpdate')
            ->add('participants')
            ->add('teamParticipants')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lan\TournamentBundle\Entity\Tournament'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lan_tournamentbundle_tournament';
    }
}
