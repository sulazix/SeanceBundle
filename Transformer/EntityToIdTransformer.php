<?php

namespace Interne\SeanceBundle\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;


class EntityToIdTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @var string
     */
    protected $class;


    public function __construct(ObjectManager $manager, $class)
    {
        $this->manager = $manager;
        $this->class = $class;
    }


    public function transform($entity)
    {
        if (null === $entity) {
            return;
        }
        return $entity->getId();
    }


    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }
        $entity = $this->manager
                       ->getRepository($this->class)
                       ->find($id);
        if (null === $entity) {
            throw new TransformationFailedException();
        }
        
        return $entity;
    }
}