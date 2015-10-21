<?php

namespace Interne\SeanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class TagType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('moveToStack','checkbox',array('label'=>'Les points seront déplacés dans le stack ?','required'=>false))
            ->add('isTrackable','checkbox',array('label'=>'Un historique des points sera créé ?','required'=>false))
            ->add('displayHome','checkbox',array('label'=>'Les points seront affichés sur la page d\'accueil','required'=>false))
        ;

    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Interne\SeanceBundle\Entity\Tag',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'seancebundle_TagType';
    }
}
