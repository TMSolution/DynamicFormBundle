<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormItemConstraint;

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

             $queryFields = [                        'formItem.name',
                                    'constraint.name',
            ];

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
        ->add('id',Filters\NumberFilterType::class, ['label' => 'system.form_item_constraint.id'])                
                /*->add('options',Filters\ChoiceFilterType::class)*/;
            
            
            
                        if ( $this->context->get('formItem')){     

                $builder->add('formItem', HiddenEntityType::class, [
                    'label' => 'system.form_item_constraint.form_item',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormItem',
                    'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }
            else
            {
               
                $builder->add('formItem', Select2EntityType::class, [
                        'multiple' => false,
                        'remote_route' => 'typeahead',
                        'remote_params' =>['module'=>'system', 'alias' =>'form-item'],
                        'class' => 'TMSolution\DynamicFormBundle\Entity\FormItem',
                        'primary_key' => 'id',
                        'text_property' => 'name',
                        'minimum_input_length' => 0,
                        'allow_clear' => true,
                        'delay' => 250,
                        'cache' => true,
                        'scroll' => true,
                        'cache_timeout' => 60000, // if 'cache' is true
                        'language' => 'pl',
                        'placeholder' => 'system.form_item_constraint.form_item',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ]);       
                    
                 
            
            }            if ( $this->context->get('constraint')){     

                $builder->add('constraint', HiddenEntityType::class, [
                    'label' => 'system.form_item_constraint.constraint',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormConstraint',
                    'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }
            else
            {
               
                $builder->add('constraint', Select2EntityType::class, [
                        'multiple' => false,
                        'remote_route' => 'typeahead',
                        'remote_params' =>['module'=>'system', 'alias' =>'form-constraint'],
                        'class' => 'TMSolution\DynamicFormBundle\Entity\FormConstraint',
                        'primary_key' => 'id',
                        'text_property' => 'name',
                        'minimum_input_length' => 0,
                        'allow_clear' => true,
                        'delay' => 250,
                        'cache' => true,
                        'scroll' => true,
                        'cache_timeout' => 60000, // if 'cache' is true
                        'language' => 'pl',
                        'placeholder' => 'system.form_item_constraint.constraint',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ]);       
                    
                 
            
            }            
            /*$builder->get('options')
            ->addModelTransformer(new ArrayToJSONStringTransformer());*/;
            
            
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
        return 'system_form_item_constraint_filter';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}
