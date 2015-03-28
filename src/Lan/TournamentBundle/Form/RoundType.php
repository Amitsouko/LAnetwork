<?php

namespace Lan\TournamentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoundType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('degree')
            ->add('dateCreation')
            ->add('dateMatch')
            ->add('parent')
            ->add('tournament')
            ->add('participants')
            ->add('teamParticipants')
            ->add('winner')
            ->add('teamWinner')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lan\TournamentBundle\Entity\Round'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lan_tournamentbundle_round';
    }
}
