<?php

namespace TMSolution\DynamicFormBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use TMSolution\DynamicFormBundle\Entity\FormTypeOptionDict;

class LoadFormTypeOptionDict extends AbstractFixture implements OrderedFixtureInterface {

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

    protected function getParameters() {

        $parameters = ['TextType' => ['data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'trim', 'compound'],
            'TextAreaType' => ['attr', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'trim'],
            'EmailType' => ['data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'trim'],
            'IntegerType' => ['grouping', 'scale', 'rounding_mode', 'compound', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'invalid_message', 'invalid_message_parameters', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'MoneyType' => ['currency', 'divisor', 'grouping', 'scale', 'compound', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'invalid_message', 'invalid_message_parameters', 'label', 'label_attr', 'label_format', 'mapped', 'required',],
            'NumberType' => ['grouping', 'scale', 'rounding_mode', 'compound', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'invalid_message', 'invalid_message_parameters', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'PasswordType' => ['always_empty', 'trim', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required',],
            'PercentType ' => ['scale', 'type', 'compound', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'invalid_message', 'invalid_message_parameters', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'SearchType' => ['disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'trim'],
            'UrlType' => ['default_protocol', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'trim'],
            'RangeType' => ['attr', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'mapped', 'required', 'trim'],
            'ChoiceType' => ['choices', 'choice_attr', 'choice_label', 'choice_loader', 'choice_name', 'choice_translation_domain', 'choice_value', 'choices_as_values', 'expanded', 'group_by', 'multiple', 'placeholder', 'preferred_choices', 'compound', 'empty_data', 'error_bubbling', 'by_reference', 'data', 'disabled', 'error_mapping', 'inherit_data', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'translation_domain'],
            'EntityType' => ['choice_label', 'class', 'em', 'query_builder', 'choice_name', 'choice_value', 'choices', 'data_class', 'choice_attr', 'choice_translation_domain', 'expanded', 'group_by', 'multiple', 'placeholder', 'preferred_choices', 'translation_domain', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'CountryType' => ['choices', 'error_bubbling', 'error_mapping', 'expanded', 'multiple', 'placeholder', 'preferred_choices', 'data', 'disabled', 'empty_data', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'LanguageType' => ['choices', 'error_bubbling', 'error_mapping', 'expanded', 'multiple', 'placeholder', 'preferred_choices', 'data', 'disabled', 'empty_data', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'LocaleType' => ['choices', 'error_bubbling', 'error_mapping', 'expanded', 'multiple', 'placeholder', 'preferred_choices', 'data', 'disabled', 'empty_data', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'TimezoneType' => ['choices', 'expanded', 'multiple', 'placeholder', 'preferred_choices', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'CurrencyType' => ['choices', 'error_bubbling', 'expanded', 'multiple', 'placeholder', 'preferred_choices', 'data', 'disabled', 'empty_data', 'label', 'label_attr', 'label_format', 'mapped', 'required',],
            'DateType' => ['choice_translation_domain', 'days', 'placeholder', 'format', 'html5', 'input', 'model_timezone', 'months', 'view_timezone', 'widget', 'years', 'by_reference', 'compound', 'data_class', 'error_bubbling', 'data', 'disabled', 'error_mapping', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'mapped'],
            'DateIntervalType' => ['widget', 'days', 'hours', 'minutes', 'months', 'seconds', 'weeks', 'input', 'labels', 'placeholder', 'widget', 'with_days', 'with_hours', 'with_invert', 'with_minutes', 'with_months', 'with_seconds', 'with_weeks', 'with_years', 'years', 'data', 'disabled', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'mapped'],
            'DateTimeType' => ['choice_translation_domain', 'date_format', 'date_widget', 'days', 'placeholder', 'format', 'hours', 'html5', 'input', 'minutes', 'model_timezone', 'months', 'seconds', 'time_widget', 'view_timezone', 'widget', 'with_minutes', 'with_seconds', 'years', 'by_reference', 'compound', 'data_class', 'error_bubbling', 'data', 'disabled', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'mapped'],
            'TimeType' => ['choice_translation_domain', 'placeholder', 'hours', 'html5', 'input', 'minutes', 'model_timezone', 'seconds', 'view_timezone', 'widget', 'with_minutes', 'with_seconds', 'by_reference', 'compound', 'data_class', 'error_bubbling', 'data', 'disabled', 'error_mapping', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'mapped'],
            'BirthdayType' => ['input', 'widget', 'years', 'choice_translation_domain', 'days', 'placeholder', 'format', 'input', 'model_timezone', 'months', 'view_timezone', 'widget', 'data', 'disabled', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'mapped'],
            'CheckboxType' => ['value', 'compound', 'empty_data', 'data', 'disabled', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'FileType' => ['multiple', 'compound', 'data_class', 'empty_data', 'disabled', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'RadioType' => ['value', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
            'CollectionType' => ['entry_type', 'allow_add', 'allow_delete', 'delete_empty', 'entry_options', 'entry_type', 'prototype', 'prototype_data', 'prototype_name', 'by_reference', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'allow_add', 'allow_delete'],
            'RepeatedType' => ['type', 'first_name', 'first_options', 'options', 'second_name', 'second_options', 'type', 'error_bubbling', 'data', 'error_mapping', 'invalid_message', 'invalid_message_parameters', 'mapped'],
            'HiddenType' => ['compound', 'error_bubbling', 'required', 'data', 'error_mapping', 'mapped', 'property_path'],
            'ButtonType' => ['attr', 'disabled', 'label', 'translation_domain'],
            'ResetType' => ['attr', 'disabled', 'label', 'label_attr', 'translation_domain'],
            'SubmitType' => ['attr', 'disabled', 'label', 'label_attr', 'label_format', 'translation_domain', 'validation_groups'],
            'FormType' => ['action', 'allow_extra_fields', 'by_reference', 'compound', 'constraints', 'data', 'data_class', 'empty_data', 'error_bubbling', 'error_mapping', 'extra_fields_message', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'label_attr', 'label_format', 'mapped', 'method', 'post_max_size_message', 'property_path', 'required', 'trim', 'attr', 'auto_initialize', 'block_name', 'disabled', 'label', 'translation_domain'],
        ];


        $result = [];

        foreach ($parameters as $typeParameters) {
            $result = array_merge($result, $typeParameters);
        }

        sort($result);
        $result = array_unique($result);
        
        return $result;
    }

    public function load(ObjectManager $manager) {

        $manager->getClassMetadata(FormTypeOptionDict::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        foreach ($this->getParameters() as $parameter) {

            $item = new FormTypeOptionDict();
            $item->setName('system.form_type_option_dict._'.$parameter);
            $item->setTechnicalName($parameter);
            $this->addReference('_reference_FormTypeOptionDict_' . $parameter, $item);
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
