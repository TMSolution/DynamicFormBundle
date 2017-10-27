<?php

namespace TMSolution\DynamicFormBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use TMSolution\DynamicFormBundle\Entity\FormDataType;

class LoadFormDataType extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $manager->getClassMetadata(FormDataType::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $dataTypes = [
            "null",
            "boolean",
            "integer",
            "double",
            "string",
            "array",
            "class",
            "interface",
            "mixed",
            "callable"
        ];

        foreach ($dataTypes as $dataType) {

            $item = new FormDataType();
            $item->setName($dataType);
            $item->setTechnicalName($dataType);
            $this->addReference('_reference_FormDataType_'.$dataType, $item);
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
