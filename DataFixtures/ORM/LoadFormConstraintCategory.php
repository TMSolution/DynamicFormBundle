<?php

namespace TMSolution\DynamicFormBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use TMSolution\DynamicFormBundle\Entity\FormConstraintCategory;

class LoadFormConstraintCategory extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;
    protected $constraintsCategories = [
        "Basic",
        "String",
        "Number",
        "Comparison",
        "Date",
        "Collection",
        "File",
        "Financial",
        "Other"
    ];

    public function load(ObjectManager $manager) {

        $manager->getClassMetadata(FormConstraintCategory ::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        foreach ($this->constraintsCategories as $constraintCategory) {
            
            $item = new FormConstraintCategory();
            $item->setName($constraintCategory);
            $this->addReference('_reference_FormConstraintCategory_'.$constraintCategory, $item);
            $manager->persist($item);
        }
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 1;
    }

}
