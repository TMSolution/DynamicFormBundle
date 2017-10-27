<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormTypeOption;

use Flexix\PrototypeControllerBundle\Form\Type\ContextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints;
use Flexix\GeneratorBundle\Transformer\ArrayToJSONStringTransformer;
use Flexix\HiddenEntityTypeBundle\Form\Type\HiddenEntityType;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;


class FilterFormType extends ContextType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    
      
    
      
        $builder
        ->add('_keyword', Filters\TextFilterType::class, array(
            'required' => false,
            'mapped' =>false,
            'attr' => array(
            'placeholder' => 'Search..'
            ),
            'apply_filter' => function(QueryInterface $filterQuery, $field, $values)  {

            if ($values['value'] === null || $values['value'] === '') {
            return null;
            }

            /** @var Expr $expr */
            $expr = $filterQuery->getExpr();

             $queryFields = ['entity.defaultValue',                        'formType.name',
                                    'formTypeOptionDict.name',
            'entity.optionRequired','entity.active','entity.position','entity.isAdvanced',];

            $params = [];
            $expression = $expr->orX();  ///andX for must match all


            foreach ($queryFields as $field) {
            $paramName = sprintf('p_%s', str_replace('.', '_', $field));
            $ex = $expr->like($field, ':' . $paramName);
            $expression->add($ex);
            $params[$paramName] = '%' . $values['value'] . '%';
            }

            return $filterQuery->createCondition($expression, $params);
            }))
        ->add('id',Filters\NumberFilterType::class, ['label' => 'system.form_type_option.id'])                
                ->add('defaultValue',Filters\TextFilterType::class, ['label' => 'system.form_type_option.default_value'])               
                ->add('optionRequired',Filters\BooleanFilterType::class, ['label' => 'system.form_type_option.option_required','translation_domain' => 'messages'])               
                ->add('active',Filters\BooleanFilterType::class, ['label' => 'system.form_type_option.active','translation_domain' => 'messages'])                
                ->add('position',Filters\NumberFilterType::class, ['label' => 'system.form_type_option.position'])               
                ->add('isAdvanced',Filters\BooleanFilterType::class, ['label' => 'system.form_type_option.is_advanced','translation_domain' => 'messages']);
            
            
            
                        if ( $this->context->get('formType')){     

                $builder->add('formType', HiddenEntityType::class, [
                    'label' => 'system.form_type_option.form_type',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormType',
                    'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }
            else
            {
               
                $builder->add('formType', Select2EntityType::class, [
                        'multiple' => false,
                        'remote_route' => 'typeahead',
                        'remote_params' =>['module'=>'system', 'alias' =>'form-type'],
                        'class' => 'TMSolution\DynamicFormBundle\Entity\FormType',
                        'primary_key' => 'id',
                        'text_property' => 'name',
                        'minimum_input_length' => 0,
                        'allow_clear' => true,
                        'delay' => 250,
                        'cache' => true,
                        'scroll' => true,
                        'cache_timeout' => 60000, // if 'cache' is true
                        'language' => 'pl',
                        'placeholder' => 'system.form_type_option.form_type',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ]);       
                    
                 
            
            }            if ( $this->context->get('formTypeOptionDict')){     

                $builder->add('formTypeOptionDict', HiddenEntityType::class, [
                    'label' => 'system.form_type_option.form_type_option_dict',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormTypeOptionDict',
                    'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }
            else
            {
               
                $builder->add('formTypeOptionDict', Select2EntityType::class, [
                        'multiple' => false,
                        'remote_route' => 'typeahead',
                        'remote_params' =>['module'=>'system', 'alias' =>'form-type-option-dict'],
                        'class' => 'TMSolution\DynamicFormBundle\Entity\FormTypeOptionDict',
                        'primary_key' => 'id',
                        'text_property' => 'name',
                        'minimum_input_length' => 0,
                        'allow_clear' => true,
                        'delay' => 250,
                        'cache' => true,
                        'scroll' => true,
                        'cache_timeout' => 60000, // if 'cache' is true
                        'language' => 'pl',
                        'placeholder' => 'system.form_type_option.form_type_option_dict',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ]);       
                    
                 
            
            }            if ( $this->context->get('dataTypes')){     

                $builder->add('dataTypes', HiddenEntityType::class, [
                    'label' => 'system.form_type_option.data_types',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormDataType',
                    'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }
            else
            {
               
                $builder->add('dataTypes', Select2EntityType::class, [
                        'multiple' => false,
                        'remote_route' => 'typeahead',
                        'remote_params' =>['module'=>'system', 'alias' =>'form-data-type'],
                        'class' => 'TMSolution\DynamicFormBundle\Entity\FormDataType',
                        'primary_key' => 'id',
                        'text_property' => 'name',
                        'minimum_input_length' => 0,
                        'allow_clear' => true,
                        'delay' => 250,
                        'cache' => true,
                        'scroll' => true,
                        'cache_timeout' => 60000, // if 'cache' is true
                        'language' => 'pl',
                        'placeholder' => 'system.form_type_option.data_types',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ]);       
                    
                 
            
            };
            
            
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
            'validation_groups' => array('filtering')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_form_type_option_filter';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}
