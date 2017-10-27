<?php

namespace TMSolution\DynamicFormBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use TMSolution\DynamicFormBundle\Entity\FormTypeOption;

class LoadFormTypeOption extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;
    protected $dataTypes = ['action' => 'string',
        'allow_add' => 'boolean',
        'allow_delete' => 'boolean',
        'allow_extra_fields' => 'boolean',
        'always_empty' => 'boolean',
        'attr' => 'array',
        'auto_initialize' => 'boolean',
        'block_name' => 'string', //default//auto
        'by_reference' => 'boolean',
        'choice_attr' => ['array', 'callable', 'string'],
        'choice_label' => ['string', 'callable', 'class' => ['name' => 'Symfony\Component\PropertyAccess\PropertyPath']], //null - interface?
        'choice_loader' => ['interface' => ['name' => 'ChoiceLoaderInterface']], //,
        'choice_name' => ['callable', 'string'], //null
        'choice_translation_domain' => ['string', 'boolean', 'null'], //null
        'choice_value' => 'string', //or colable
        'choices' => 'array',
        'choices_as_values' => null, //deprected
        'class' => ['string' => ['required' => true]], // required
        'compound' => null, //not metter
        'constraints' => 'array', //null
        'currency' => 'string',
        'data' => 'mixed', //diffrent
        'data_class' => 'string',
        'date_format' => ['string', 'integer'], //'IntlDateFormatter::MEDIUM',
        'date_widget' => 'string',
        'days' => 'array',
        'default_protocol' => 'string',
        'delete_empty' => 'boolean',
        'disabled' => 'boolean',
        'divisor' => 'integer',
        'em' => ['string', 'class' => ["name" => 'Doctrine\Common\Persistence\ObjectManager']], // or 
        'empty_data' => 'array', //mixed or '' 
//    If data_class is set and required is true, then new $data_class();
//    If data_class is set and required is false, then null;
//    If data_class is not set and compound is true, then array() (empty array);
//    If data_class is not set and compound is false, then '' (empty string).
        'entry_options' => 'array',
        'entry_type' => ['string' => ['required' => true]], //auto i think
        'error_bubbling' => 'boolean',
        'error_mapping' => 'array',
        'expanded' => 'boolean', //false- choiceType
        'extra_fields_message' => 'string', //auto
        'first_name' => 'string',
        'first_options' => 'array',
        'format' => 'string', //or int //for Date
        'group_by' => 'array', //null
        'grouping' => 'integer',
        'hours' => 'array',
        'html5' => 'boolean',
        'inherit_data' => 'boolean',
        'input' => 'string',
        'invalid_message' => 'string', //auto// This value is not valid
        'invalid_message_parameters' => 'array',
        'label' => 'string', //guesed
        'label_attr' => 'array',
        'label_format' => 'string', //null
        'labels' => 'array', //auto
        'mapped' => 'boolean',
        'method' => 'string',
        'minutes' => 'array', //auto //0-59
        'model_timezone' => 'string', //auto from system
        'months' => 'array', //auto -1-12
        'multiple' => 'boolean',
        'options' => 'array',
        'placeholder' => ['string', 'boolean'], //auto
        'post_max_size_message' => 'string', //auto
        'preferred_choices' => 'array',
        'property_path' => 'mixed', //any in oryginal document //auto - fields name
        'prototype' => 'boolean',
        'prototype_data' => 'mixed', //null
        'prototype_name' => 'string',
        'query_builder' => ['class' => ['name' => 'Doctrine\ORM\QueryBuilder']],
        'required' => 'boolean',
        'rounding_mode' => 'string',
        'scale' => 'integer', //auto
        'second_name' => 'string',
        'second_options' => 'array',
        'seconds' => 'array', //auto
        'time_widget' => 'string', //auto
        'translation_domain' => 'string', //auto
        'trim' => 'boolean',
        'type' => ['string', 'class' => ['name' => 'Symfony\Component\Form\Extension\Core\Type\TextType']], // or in RepetatedType 
        'validation_groups' => 'array', //null
        'value' => 'mixed',
        'view_timezone' => 'string', //auto system timezone
        'weeks' => 'array',
        'widget' => 'string',
        'with_days' => 'boolean',
        'with_hours' => 'boolean',
        'with_invert' => 'boolean',
        'with_minutes' => 'boolean',
        'with_months' => 'boolean',
        'with_seconds' => 'boolean',
        'with_weeks' => 'boolean',
        'with_years' => 'boolean',
        'years' => 'array'
    ];
    protected $defaults = ['action' => '',
        'allow_add' => 'false',
        'allow_delete' => 'false',
        'allow_extra_fields' => 'false',
        'always_empty' => 'true',
        'attr' => '[]',
        'auto_initialize' => 'true',
        'block_name' => 'string', //default//auto
        'by_reference' => 'true',
        'choice_attr' => '[]',
        'choice_label' => 'null', //null
        'choice_loader' => 'ChoiceLoaderInterface',
        'choice_name' => 'null', //null
        'choice_translation_domain' => 'null', //null
        'choice_value' => 'null', //null
        'choices' => '[]',
        'choices_as_values' => 'null', //deprected
        'class' => 'null', //string - required
        'compound' => 'null', //not metter
        'constraints' => 'null', //null
        'currency' => 'EUR',
        'data' => 'null', //diffrent
        'data_class' => 'string',
        'date_format' => 'IntlDateFormatter::MEDIUM',
        'date_widget' => 'choice',
        'days' => '[]',
        'default_protocol' => 'http',
        'delete_empty' => 'false',
        'disabled' => 'false',
        'divisor' => '1',
        'em' => 'null', //auto
        'empty_data' => '[]', //mixed or ''
        'entry_options' => '[]',
        'entry_type' => 'string', //auto i think
        'error_bubbling' => 'false',
        'error_mapping' => '[]',
        'expanded' => 'false', //false- choiceType
        'extra_fields_message' => 'null', //auto
        'first_name' => 'first',
        'first_options' => '[]',
        'format' => 'IntlDateFormatter::MEDIUM', //for Date
        'group_by' => 'null', //null
        'grouping' => 'false',
        'hours' => '[0,23]',
        'html5' => 'true',
        'inherit_data' => 'null',
        'input' => 'datetime',
        'invalid_message' => 'null', //auto// This value is not valid
        'invalid_message_parameters' => '[]',
        'label' => 'null', //guesed
        'label_attr' => '[]',
        'label_format' => 'null', //null
        'labels' => 'null', //auto
        'mapped' => 'true',
        'method' => 'POST',
        'minutes' => 'null', //auto //0-59
        'model_timezone' => 'null', //auto from system
        'months' => 'null', //auto -1-12
        'multiple' => 'false',
        'options' => '[]',
        'placeholder' => 'string or boolean', //auto
        'post_max_size_message' => 'null', //auto
        'preferred_choices' => '[]',
        'property_path' => 'null', //auto - fields name
        'prototype' => 'true',
        'prototype_data' => 'null', //null
        'prototype_name' => '__name__',
        'query_builder' => 'null', //null
        'required' => 'true',
        'rounding_mode' => 'NumberToLocalizedStringTransformer::ROUND_HALFUP',
        'scale' => 'null', //auto
        'second_name' => 'second',
        'second_options' => '[]',
        'seconds' => '[0,59]', //auto
        'time_widget' => 'choice', //auto
        'translation_domain' => 'null', //auto
        'trim' => 'true',
        'type' => 'fractional', // or in RepetatedType Symfony\Component\Form\Extension\Core\Type\TextType
        'validation_groups' => 'null', //null
        'value' => '1',
        'view_timezone' => 'null', //auto system timezone
        'weeks' => '[0,52]',
        'widget' => 'choice',
        'with_days' => 'true',
        'with_hours' => 'true',
        'with_invert' => 'false',
        'with_minutes' => 'false',
        'with_months' => 'true',
        'with_seconds' => 'false',
        'with_weeks' => 'false',
        'with_years' => 'true',
        'years' => '[0,100]',
    ];

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    protected function getParameters() {

//        $parameters = ['TextType' => ['data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'trim', 'compound'],
//            'TextareaType' => ['attr', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'trim'],
//            'EmailType' => ['data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'trim'],
//            'IntegerType' => ['grouping', 'scale', 'rounding_mode', 'compound', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'invalid_message', 'invalid_message_parameters', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'MoneyType' => ['currency', 'divisor', 'grouping', 'scale', 'compound', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'invalid_message', 'invalid_message_parameters', 'label', 'label_attr', 'label_format', 'mapped', 'required',],
//            'NumberType' => ['grouping', 'scale', 'rounding_mode', 'compound', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'invalid_message', 'invalid_message_parameters', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'PasswordType' => ['always_empty', 'trim', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required',],
//            'PercentType' => ['scale', 'type', 'compound', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'invalid_message', 'invalid_message_parameters', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'SearchType' => ['disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'trim'],
//            'UrlType' => ['default_protocol', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'trim'],
//            'RangeType' => ['attr', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'mapped', 'required', 'trim'],
//            'ChoiceType' => ['choices', 'choice_attr', 'choice_label', 'choice_loader', 'choice_name', 'choice_translation_domain', 'choice_value', 'choices_as_values', 'expanded', 'group_by', 'multiple', 'placeholder', 'preferred_choices', 'compound', 'empty_data', 'error_bubbling', 'by_reference', 'data', 'disabled', 'error_mapping', 'inherit_data', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'translation_domain'],
//            'EntityType' => ['choice_label', 'class', 'em', 'query_builder', 'choice_name', 'choice_value', 'choices', 'data_class', 'choice_attr', 'choice_translation_domain', 'expanded', 'group_by', 'multiple', 'placeholder', 'preferred_choices', 'translation_domain', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'CountryType' => ['choices', 'error_bubbling', 'error_mapping', 'expanded', 'multiple', 'placeholder', 'preferred_choices', 'data', 'disabled', 'empty_data', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'LanguageType' => ['choices', 'error_bubbling', 'error_mapping', 'expanded', 'multiple', 'placeholder', 'preferred_choices', 'data', 'disabled', 'empty_data', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'LocaleType' => ['choices', 'error_bubbling', 'error_mapping', 'expanded', 'multiple', 'placeholder', 'preferred_choices', 'data', 'disabled', 'empty_data', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'TimezoneType' => ['choices', 'expanded', 'multiple', 'placeholder', 'preferred_choices', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'CurrencyType' => ['choices', 'error_bubbling', 'expanded', 'multiple', 'placeholder', 'preferred_choices', 'data', 'disabled', 'empty_data', 'label', 'label_attr', 'label_format', 'mapped', 'required',],
//            'DateType' => ['choice_translation_domain', 'days', 'placeholder', 'format', 'html5', 'input', 'model_timezone', 'months', 'view_timezone', 'widget', 'years', 'by_reference', 'compound', 'data_class', 'error_bubbling', 'data', 'disabled', 'error_mapping', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'mapped'],
//            'DateIntervalType' => ['widget', 'days', 'hours', 'minutes', 'months', 'seconds', 'weeks', 'input', 'labels', 'placeholder', 'with_days', 'with_hours', 'with_invert', 'with_minutes', 'with_months', 'with_seconds', 'with_weeks', 'with_years', 'years', 'data', 'disabled', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'mapped'],
//            'DateTimeType' => ['choice_translation_domain', 'date_format', 'date_widget', 'days', 'placeholder', 'format', 'hours', 'html5', 'input', 'minutes', 'model_timezone', 'months', 'seconds', 'time_widget', 'view_timezone', 'widget', 'with_minutes', 'with_seconds', 'years', 'by_reference', 'compound', 'data_class', 'error_bubbling', 'data', 'disabled', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'mapped'],
//            'TimeType' => ['choice_translation_domain', 'placeholder', 'hours', 'html5', 'input', 'minutes', 'model_timezone', 'seconds', 'view_timezone', 'widget', 'with_minutes', 'with_seconds', 'by_reference', 'compound', 'data_class', 'error_bubbling', 'data', 'disabled', 'error_mapping', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'mapped'],
//            'BirthdayType' => [ 'years', 'choice_translation_domain', 'days', 'placeholder', 'format', 'input', 'model_timezone', 'months', 'view_timezone', 'widget', 'data', 'disabled', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'mapped'],
//            'CheckboxType' => ['value', 'compound', 'empty_data', 'data', 'disabled', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'FileType' => ['multiple', 'compound', 'data_class', 'empty_data', 'disabled', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'RadioType' => ['value', 'data', 'disabled', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required'],
//            'CollectionType' => [ 'delete_empty', 'entry_options', 'entry_type', 'prototype', 'prototype_data', 'prototype_name', 'by_reference', 'empty_data', 'error_bubbling', 'error_mapping', 'label', 'label_attr', 'label_format', 'mapped', 'required', 'allow_add', 'allow_delete'],
//            'RepeatedType' => ['type', 'first_name', 'first_options', 'options', 'second_name', 'second_options', 'error_bubbling', 'data', 'error_mapping', 'invalid_message', 'invalid_message_parameters', 'mapped'],
//            'HiddenType' => ['compound', 'error_bubbling', 'required', 'data', 'error_mapping', 'mapped', 'property_path'],
//            'ButtonType' => ['attr', 'disabled', 'label', 'translation_domain'],
//            'ResetType' => ['attr', 'disabled', 'label', 'label_attr', 'translation_domain'],
//            'SubmitType' => ['attr', 'disabled', 'label', 'label_attr', 'label_format', 'translation_domain', 'validation_groups'],
//            'FormType' => ['action', 'allow_extra_fields', 'by_reference', 'compound', 'constraints', 'data', 'data_class', 'empty_data', 'error_bubbling', 'error_mapping', 'extra_fields_message', 'inherit_data', 'invalid_message', 'invalid_message_parameters', 'label_attr', 'label_format', 'mapped', 'method', 'post_max_size_message', 'property_path', 'required', 'trim', 'attr', 'auto_initialize', 'block_name', 'disabled', 'label', 'translation_domain'],
//        ];




        $parameters = ['TextType' => ['data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false, 'trim' => false, 'compound' => false],
            'TextareaType' => ['attr' => true, 'data' => true, 'disabled' => true, 'empty_data' => true, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false, 'trim' => false],
            'EmailType' => ['data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false, 'trim' => false],
            'IntegerType' => ['grouping' => false, 'scale' => false, 'rounding_mode' => false, 'compound' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'MoneyType' => ['currency' => false, 'divisor' => false, 'grouping' => false, 'scale' => true, 'compound' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'NumberType' => ['grouping' => false, 'scale' => false, 'rounding_mode' => false, 'compound' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'PasswordType' => ['always_empty' => false, 'trim' => false, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'PercentType' => ['scale' => false, 'type' => false, 'compound' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'SearchType' => ['disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false, 'trim' => false],
            'UrlType' => ['default_protocol' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false, 'trim' => false],
            'RangeType' => ['attr' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'mapped' => false, 'required' => false, 'trim' => false],
            'ChoiceType' => ['choices' => false, 'choice_attr' => false, 'choice_label' => false, 'choice_loader' => false, 'choice_name' => false, 'choice_translation_domain' => false, 'choice_value' => false, 'choices_as_values' => false, 'expanded' => false, 'group_by' => false, 'multiple' => false, 'placeholder' => false, 'preferred_choices' => false, 'compound' => false, 'empty_data' => false, 'error_bubbling' => false, 'by_reference' => false, 'data' => true, 'disabled' => true, 'error_mapping' => false, 'inherit_data' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false, 'translation_domain' => false],
            'EntityType' => ['choice_label' => false, 'class' => true, 'em' => false, 'query_builder' => false, 'choice_name' => false, 'choice_value' => false, 'choices' => false, 'data_class' => false, 'choice_attr' => false, 'choice_translation_domain' => false, 'expanded' => false, 'group_by' => false, 'multiple' => false, 'placeholder' => false, 'preferred_choices' => false, 'translation_domain' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'CountryType' => ['choices' => false, 'error_bubbling' => false, 'error_mapping' => false, 'expanded' => false, 'multiple' => false, 'placeholder' => false, 'preferred_choices' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'LanguageType' => ['choices' => false, 'error_bubbling' => false, 'error_mapping' => false, 'expanded' => false, 'multiple' => false, 'placeholder' => false, 'preferred_choices' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'LocaleType' => ['choices' => false, 'error_bubbling' => false, 'error_mapping' => false, 'expanded' => false, 'multiple' => false, 'placeholder' => false, 'preferred_choices' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'TimezoneType' => ['choices' => false, 'expanded' => false, 'multiple' => false, 'placeholder' => false, 'preferred_choices' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'CurrencyType' => ['choices' => false, 'error_bubbling' => false, 'expanded' => false, 'multiple' => false, 'placeholder' => false, 'preferred_choices' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false,],
            'DateType' => ['choice_translation_domain' => false, 'days' => false, 'placeholder' => false, 'format' => false, 'html5' => false, 'input' => false, 'model_timezone' => false, 'months' => false, 'view_timezone' => false, 'widget' => false, 'years' => false, 'by_reference' => false, 'compound' => false, 'data_class' => false, 'error_bubbling' => false, 'data' => true, 'disabled' => true, 'error_mapping' => false, 'inherit_data' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'mapped' => false],
            'DateIntervalType' => ['widget' => false, 'days' => false, 'hours' => false, 'minutes' => false, 'months' => false, 'seconds' => false, 'weeks' => false, 'input' => false, 'labels' => false, 'placeholder' => false, 'with_days' => false, 'with_hours' => false, 'with_invert' => false, 'with_minutes' => false, 'with_months' => false, 'with_seconds' => false, 'with_weeks' => false, 'with_years' => false, 'years' => false, 'data' => true, 'disabled' => true, 'inherit_data' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'mapped' => false],
            'DateTimeType' => ['choice_translation_domain' => false, 'date_format' => false, 'date_widget' => false, 'days' => false, 'placeholder' => false, 'format' => false, 'hours' => false, 'html5' => false, 'input' => false, 'minutes' => false, 'model_timezone' => false, 'months' => false, 'seconds' => false, 'time_widget' => false, 'view_timezone' => false, 'widget' => false, 'with_minutes' => false, 'with_seconds' => false, 'years' => false, 'by_reference' => false, 'compound' => false, 'data_class' => false, 'error_bubbling' => false, 'data' => true, 'disabled' => true, 'inherit_data' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'mapped' => false],
            'TimeType' => ['choice_translation_domain' => false, 'placeholder' => false, 'hours' => false, 'html5' => false, 'input' => false, 'minutes' => false, 'model_timezone' => false, 'seconds' => false, 'view_timezone' => false, 'widget' => false, 'with_minutes' => false, 'with_seconds' => false, 'by_reference' => false, 'compound' => false, 'data_class' => false, 'error_bubbling' => false, 'data' => true, 'disabled' => true, 'error_mapping' => false, 'inherit_data' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'mapped' => false],
            'BirthdayType' => ['years' => false, 'choice_translation_domain' => false, 'days' => false, 'placeholder' => false, 'format' => false, 'input' => false, 'model_timezone' => false, 'months' => false, 'view_timezone' => false, 'widget' => false, 'data' => true, 'disabled' => true, 'inherit_data' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'mapped' => false],
            'CheckboxType' => ['value' => false, 'compound' => false, 'empty_data' => false, 'data' => true, 'disabled' => true, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'FileType' => ['multiple' => false, 'compound' => false, 'data_class' => false, 'empty_data' => false, 'disabled' => true, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'RadioType' => ['value' => false, 'data' => true, 'disabled' => true, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false],
            'CollectionType' => ['delete_empty' => false, 'entry_options' => false, 'entry_type' => false, 'prototype' => false, 'prototype_data' => false, 'prototype_name' => false, 'by_reference' => false, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'label' => true, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'required' => false, 'allow_add' => false, 'allow_delete' => false],
            'RepeatedType' => ['type' => false, 'first_name' => false, 'first_options' => false, 'options' => false, 'second_name' => false, 'second_options' => false, 'error_bubbling' => false, 'data' => true, 'error_mapping' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'mapped' => false],
            'HiddenType' => ['compound' => false, 'error_bubbling' => false, 'required' => false, 'data' => true, 'error_mapping' => false, 'mapped' => false, 'property_path' => false],
            'ButtonType' => ['attr' => false, 'disabled' => true, 'label' => true, 'translation_domain' => false],
            'ResetType' => ['attr' => false, 'disabled' => true, 'label' => true, 'label_attr' => false, 'translation_domain' => false],
            'SubmitType' => ['attr' => false, 'disabled' => true, 'label' => true, 'label_attr' => false, 'label_format' => false, 'translation_domain' => false, 'validation_groups' => false],
            'FormType' => ['action' => false, 'allow_extra_fields' => false, 'by_reference' => false, 'compound' => false, 'constraints' => false, 'data' => true, 'data_class' => false, 'empty_data' => false, 'error_bubbling' => false, 'error_mapping' => false, 'extra_fields_message' => false, 'inherit_data' => false, 'invalid_message' => false, 'invalid_message_parameters' => false, 'label_attr' => false, 'label_format' => false, 'mapped' => false, 'method' => false, 'post_max_size_message' => false, 'property_path' => false, 'required' => false, 'trim' => false, 'attr' => false, 'auto_initialize' => false, 'block_name' => false, 'disabled' => true, 'label' => true, 'translation_domain' => false],
        ];




        return $parameters;
    }

    protected function findDefalutValue() {
        
    }

    public function configure($item, $parameter) {

        if (array_key_exists($parameter, $this->defaults)) {
            $this->defaults[$parameter] = $this->defaults[$parameter];
        }


        if (array_key_exists($parameter, $this->dataTypes)) {
            $dataTypes = $this->dataTypes[$parameter];

            if (is_string($dataTypes)) {
                $item->addDataType($this->getReference('_reference_FormDataType_' . $dataTypes));
            } else if (is_array($dataTypes)) {
                foreach ($dataTypes as $dataTypeName => $dataType) {

                    if (is_string($dataType)) {
                        $item->addDataType($this->getReference('_reference_FormDataType_' . $dataType));
                    } else if (is_array($dataType)) {
                        $item->addDataType($this->getReference('_reference_FormDataType_' . $dataTypeName));
                        //sprawdź czy requery
                        if (array_key_exists('required', $dataType)) {
                            $item->setOptionRequired($dataType['required']);
                        }

                        if (in_array($dataTypeName, ['class', 'interface']) && array_key_exists('name', $dataType)) {
                            echo "class name";
                            // $item->setDataTypeName($dataType['name']);
                        }
                    }
                }
            }
        }
    }

    public function load(ObjectManager $manager) {

        $manager->getClassMetadata(FormTypeOption ::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        foreach ($this->getParameters() as $key => $parameters) {

            foreach ($parameters as $parameter => $basic) {
              //  echo $parameter . '\n';
                $item = new FormTypeOption ();
                $item->setIsAdvanced(!$basic);
                $item->setFormType($this->getReference('_reference_FormType_' . $key));
                $item->setFormTypeOptionDict($this->getReference('_reference_FormTypeOptionDict_' . $parameter));
                $this->configure($item, $parameter);
                $this->addReference('_reference_FormTypeOption_' . $key . '_' . $parameter, $item);

                $manager->persist($item);
            }
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 3;
    }

}
