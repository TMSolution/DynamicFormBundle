<?php

namespace TMSolution\DynamicFormBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use TMSolution\DynamicFormBundle\Entity\FormConstraint;

class LoadFormConstraint extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;
    protected $constraints = [
        "NotBlank" =>[ "technicalName" => "Symfony\Component\Validator\Constraints\NotBlank","constraintCategory"=>"Basic" ],
        "Blank" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Blank","constraintCategory"=>"Basic"],
        "NotNull" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\NotNull","constraintCategory"=>"Basic" ],
        "IsNull" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\IsNull","constraintCategory"=>"Basic" ],
        "IsTrue" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\IsTrue","constraintCategory"=>"Basic" ],
        "IsFalse" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\IsFalse","constraintCategory"=>"Basic" ],
        "Type" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Type","constraintCategory"=>"Basic" ],
        "Email" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Email","constraintCategory"=>"String" ],
        "Length" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Length","constraintCategory"=>"String" ],
        "Url" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Url","constraintCategory"=>"String" ],
        "Regex" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Regex","constraintCategory"=>"String" ],
        "Ip" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Ip","constraintCategory"=>"String" ],
        "Uuid" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Uuid","constraintCategory"=>"String" ],
        "Range" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Range","constraintCategory"=>"Number" ],
        "EqualTo" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\EqualTo","constraintCategory"=>"String" ],
        "NotEqualTo" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\NotEqualTo","constraintCategory"=>"Comparison" ],
        "IdenticalTo" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\IdenticalTo","constraintCategory"=>"Comparison" ],
        "NotIdenticalTo" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\NotIdenticalTo","constraintCategory"=>"Comparison" ],
        "LessThan" =>[ "technicalName" => "Symfony\Component\Validator\Constraints\LessThan","constraintCategory"=>"Comparison" ],
        "LessThanOrEqual" =>[ "technicalName" => "Symfony\Component\Validator\Constraints\LessThanOrEqual","constraintCategory"=>"Comparison" ],
        "GreaterThan" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\GreaterThan","constraintCategory"=>"Comparison" ],
        "GreaterThanOrEqual" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\GreaterThanOrEqual","constraintCategory"=>"Comparison" ],
        "Date" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Date","constraintCategory"=>"Date" ],
        "DateTime" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\DateTime","constraintCategory"=>"Date" ],
        "Choice" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Choice","constraintCategory"=>"Collection" ],
        "Collection" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Collection","constraintCategory"=>"Collection" ],
        "Count" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Count","constraintCategory"=>"Collection" ],
        "UniqueEntity" => [ "technicalName" => "Symfony\Component\Validator\Constraints\UniqueEntity","constraintCategory"=>"Collection" ],
        "Language" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Language","constraintCategory"=>"Collection"],
        "Locale" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Locale","constraintCategory"=>"Collection"],
        "Country" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Country","constraintCategory"=>"Collection" ],
        "File" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\File","constraintCategory"=>"File" ],
        "Image" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Image","constraintCategory"=>"File" ],
        "Bic" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Bic","constraintCategory"=>"Financial" ],
        "CardScheme" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\CardScheme","constraintCategory"=>"Financial" ],
        "Currency" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Currency","constraintCategory"=>"Financial" ],
        "Luhn" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Luhn","constraintCategory"=>"Financial" ],
        "Iban" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Iban","constraintCategory"=>"Financial" ],
        "Isbn" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Isbn","constraintCategory"=>"Financial" ],
        "Issn" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Issn","constraintCategory"=>"Financial" ],
        "Callback" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Callback", "constraintCategory"=>"Other"],
        "Expression" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Expression", "constraintCategory"=>"Other" ],
        "All" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\All", "constraintCategory"=>"Other" ],
        "UserPassword" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\UserPassword", "constraintCategory"=>"Other" ],
        "Valid" => [ "technicalName" =>"Symfony\Component\Validator\Constraints\Valid", "constraintCategory"=>"Other" ]
    ];

    public function load(ObjectManager $manager) {

        $manager->getClassMetadata(FormConstraint ::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        foreach ($this->constraints as $name => $arr) {

            $item = new FormConstraint();
            $item->setName($name);
            $item->setTechnicalName($arr["technicalName"]);
            $item->setFormConstraintCategory($this->getReference('_reference_FormConstraintCategory_'.$arr["constraintCategory"]));
            $manager->persist($item);
        }
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 2;
    }

}
