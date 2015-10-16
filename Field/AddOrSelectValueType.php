<?php

namespace Interne\SeanceBundle\Field;

use Symfony\Component\Form\AbstractType;

class AddOrSelectValueType extends AbstractType
{
    public function getParent()
    {
        return 'textarea';
    }

    public function getName()
    {
        return 'addorselectvalue';
    }
}