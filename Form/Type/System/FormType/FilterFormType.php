<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormType;

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

             $queryFields = ['entity.name','entity.technicalName','entity.className',                        'parent.name',
            'entity.active','entity.cssIconClass',];

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
        ->add('id',Filters\NumberFilterType::class, ['label' => 'system.form_type.id'])                
                ->add('name',Filters\TextFilterType::class, ['label' => 'system.form_type.name'])                
                ->add('technicalName',Filters\TextFilterType::class, ['label' => 'system.form_type.technical_name'])                
                ->add('className',Filters\TextFilterType::class, ['label' => 'system.form_type.class_name'])               
                ->add('active',Filters\BooleanFilterType::class, ['label' => 'system.form_type.active','translation_domain' => 'messages'])                
                ->add('cssIconClass',Filters\TextFilterType::class, ['label' => 'system.form_type.css_icon_class']);
            
            
            
                        if ( $this->context->get('parent')){     

                $builder->add('parent', HiddenEntityType::class, [
                    'label' => 'system.form_type.parent',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormType',
                    'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }
            else
            {
               
                $builder->add('parent', Select2EntityType::class, [
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
                        'placeholder' => 'system.form_type.parent',
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
        return 'system_form_type_filter';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}
