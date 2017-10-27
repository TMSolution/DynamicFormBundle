<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormTypeOption;
use Flexix\PrototypeControllerBundle\Form\Type\ContextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Flexix\GeneratorBundle\Transformer\ArrayToJSONStringTransformer;
use Flexix\HiddenEntityTypeBundle\Form\Type\HiddenEntityType;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;


class InsertFormType extends ContextType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder            ->add('defaultValue',null,  ['label' => 'system.form_type_option.default_value','constraints' => []])->add('formType', Select2EntityType::class, [
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
                    ])->add('formTypeOptionDict', Select2EntityType::class, [
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
                    ])            ->add('optionRequired',null,  ['label' => 'system.form_type_option.option_required','constraints' => []])            ->add('active',null,  ['label' => 'system.form_type_option.active','constraints' => []])            ->add('position',null,  ['label' => 'system.form_type_option.position','constraints' => []])            ->add('isAdvanced',null,  ['label' => 'system.form_type_option.is_advanced','constraints' => []]);
            
                         if ($this->context->get('formType')){     

                $builder->add('formType', HiddenEntityType::class, [
                    'label' => 'system.form_type_option.form_type',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormType','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormType')->findOneById($this->context->get('formType')),'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }            if ($this->context->get('formTypeOptionDict')){     

                $builder->add('formTypeOptionDict', HiddenEntityType::class, [
                    'label' => 'system.form_type_option.form_type_option_dict',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormTypeOptionDict','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormTypeOptionDict')->findOneById($this->context->get('formTypeOptionDict')),'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }            if ($this->context->get('dataTypes')){     

                $builder->add('dataTypes', HiddenEntityType::class, [
                    'label' => 'system.form_type_option.data_types',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormDataType',                    'data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormDataType')->findById($this->context->get('dataTypes')),
                    'multiple' => true,'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            };
            
            
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TMSolution\DynamicFormBundle\Entity\FormTypeOption',
            'attr' => array('novalidate' => 'novalidate'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_form_type_option_insert';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}

