<?php

namespace TMSolution\DynamicFormBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use TMSolution\DynamicFormBundle\Entity\FormType;

class LoadFormType extends AbstractFixture implements OrderedFixtureInterface {

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
        $manager->getClassMetadata(FormType::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);


        $formTypes = [
            ['name'=>'form_type', 'name_pl'=>'Formularz','name_en'=>'Form', 'technical_name' => 'FormType', 'parent' => null, 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\FormType', 'active'=>false],
            ['name'=>'text_type', 'name_pl'=>'Tekst','name_en'=>'Text','technical_name' => 'TextType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\TextType', 'active'=>true],
            ['name'=>'textarea_type', 'name_pl'=>'Pole tekstowe','name_en'=>'Texarea','technical_name' => 'TextareaType', 'parent' => 'TextType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\TextareaType', 'active'=>true],
            ['name'=>'email_type', 'name_pl'=>'Email','name_en'=>'Email','technical_name' => 'EmailType', 'parent' => 'TextType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\EmailType', 'active'=>true],
            ['name'=>'integer_type', 'name_pl'=>'Liczba prosta','name_en'=>'Integer','technical_name' => 'IntegerType', 'parent' => 'TextType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\IntegerType', 'active'=>true],
            ['name'=>'money_type', 'name_pl'=>'Kwota','name_en'=>'Money','technical_name' => 'MoneyType', 'parent' => 'TextType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\MoneyType', 'active'=>true],
            ['name'=>'number_type', 'name_pl'=>'Liczba','name_en'=>'Number','technical_name' => 'NumberType', 'parent' => 'TextType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\NumberType', 'active'=>true],
            ['name'=>'password_type', 'name_pl'=>'Hasło','name_en'=>'Password','technical_name' => 'PasswordType', 'parent' => 'TextType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\PasswordType', 'active'=>false],
            ['name'=>'precent_type', 'name_pl'=>'Procent','name_en'=>'Percent','technical_name' => 'PercentType', 'parent' => 'TextType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\PercentType', 'active'=>true],
            ['name'=>'search_type', 'name_pl'=>'Pole wyszukiwania','name_en'=>'Search','technical_name' => 'SearchType', 'parent' => 'TextType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\SearchType', 'active'=>false],
            ['name'=>'url_type', 'name_pl'=>'URL','name_en'=>'URL','technical_name' => 'UrlType', 'parent' => 'TextType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\UrlType', 'active'=>true],
            ['name'=>'range_type', 'name_pl'=>'Zakres','name_en'=>'Range','technical_name' => 'RangeType', 'parent' => 'TextType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\RangeType', 'active'=>false],
            ['name'=>'choice_type', 'name_pl'=>'Pole wyboru','name_en'=>'Choice Type','technical_name' => 'ChoiceType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\ChoiceType', 'active'=>true],
            ['name'=>'entity_type', 'name_pl'=>'Obiekt biznesowy','name_en'=>'Bussines Object','technical_name' => 'EntityType', 'parent' => 'ChoiceType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\EntityType', 'active'=>true],
            ['name'=>'country_type', 'name_pl'=>'Kraj','name_en'=>'Country','technical_name' => 'CountryType', 'parent' => 'ChoiceType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\CountryType', 'active'=>false],
            ['name'=>'language_type', 'name_pl'=>'Język','name_en'=>'Language','technical_name' => 'LanguageType', 'parent' => 'ChoiceType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\LanguageType', 'active'=>false],
            ['name'=>'locale_type', 'name_pl'=>'Język','name_en'=>'Locale','technical_name' => 'LocaleType', 'parent' => 'ChoiceType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\LocaleType', 'active'=>false],
            ['name'=>'timezone_type', 'name_pl'=>'Strefa czasowa','name_en'=>'Timezone','technical_name' => 'TimezoneType', 'parent' => 'ChoiceType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\TimezoneType', 'active'=>false],
            ['name'=>'currency_type', 'name_pl'=>'Waluta','name_en'=>'Currency','technical_name' => 'CurrencyType', 'parent' => 'ChoiceType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\CurrencyType', 'active'=>true],
            ['name'=>'date_type', 'name_pl'=>'Data','name_en'=>'Date','technical_name' => 'DateType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\DateType', 'active'=>false],
            ['name'=>'date_interval_type', 'name_pl'=>'Przedział czasu','name_en'=>'Date interval','technical_name' => 'DateIntervalType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\DateIntervalType', 'active'=>false],
            ['name'=>'date_time_type', 'name_pl'=>'Data i czas','name_en'=>'Date and Time','technical_name' => 'DateTimeType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\DateTimeType', 'active'=>true],
            ['name'=>'time_type', 'name_pl'=>'Czas','name_en'=>'Time','technical_name' => 'TimeType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\TimeType', 'active'=>false],
            ['name'=>'birthday_type', 'name_pl'=>'Urodziny','name_en'=>'Birthday','technical_name' => 'BirthdayType', 'parent' => 'DateType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\BirthdayType', 'active'=>false],
            ['name'=>'checkbox_type', 'name_pl'=>'Pole checkbox','name_en'=>'Checkbox','technical_name' => 'CheckboxType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\CheckboxType', 'active'=>true],
            ['name'=>'file_type', 'name_pl'=>'Plik','name_en'=>'File','technical_name' => 'FileType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\FileType', 'active'=>true],
            ['name'=>'radio_type', 'name_pl'=>'Pole radio','name_en'=>'Radio','technical_name' => 'RadioType', 'parent' => 'CheckboxType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\RadioType', 'active'=>true],
            ['name'=>'collection_type', 'name_pl'=>'Kolekcja','name_en'=>'Collection','technical_name' => 'CollectionType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\CollectionType', 'active'=>false],
            ['name'=>'repeated_type', 'name_pl'=>'Pole z powtórzeniem','name_en'=>'Repeated field','technical_name' => 'RepeatedType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\RepeatedType', 'active'=>false],
            ['name'=>'hidden_type', 'name_pl'=>'Pole ukryte','name_en'=>'Hidden field','technical_name' => 'HiddenType', 'parent' => 'FormType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\HiddenType', 'active'=>true],
            ['name'=>'button_type', 'name_pl'=>'Przycisk','name_en'=>'Button','technical_name' => 'ButtonType', 'parent' => null, 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\ButtonType', 'active'=>false],
            ['name'=>'reset_type', 'name_pl'=>'Reset','name_en'=>'Reset','technical_name' => 'ResetType', 'parent' => 'ButtonType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\ResetType', 'active'=>false],
            ['name'=>'submit_type', 'name_pl'=>'Przycisk wyślij','name_en'=>'Submit button','technical_name' => 'SubmitType', 'parent' => 'ButtonType', 'class_name'=>'Symfony\Component\Form\Extension\Core\Type\SubmitType', 'active'=>false]];
            

        $counter = 0;
        
        foreach ($formTypes as $formType) {

            $item = new FormType();
            $item->setName($formType['name_en']);
            //$item->setName('system.form_type._'.$formType["name"]);
            $item->setClassName($formType["class_name"]);
            $item->setTechnicalName($formType["technical_name"]);
            $item->setActive($formType["active"]);
            $this->addReference('_reference_FormType_' .$formType["technical_name"] , $item);
            
            if($formType["parent"])
            {
                $item->setParent($this->getReference('_reference_FormType_' .$formType["parent"]));
            }
            
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
