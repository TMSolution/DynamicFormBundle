<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormItemOptionValue;

use Flexix\PrototypeControllerBundle\Form\Type\ContextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Flexix\GeneratorBundle\Transformer\ArrayToJSONStringTransformer;
use Flexix\HiddenEntityTypeBundle\Form\Type\HiddenEntityType;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;


class EditFormType extends ContextType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            ->add('value',null,  ['label' => 'system.form_item_option_value.value','constraints' => []])->add('formItem', Select2EntityType::class, [
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
                        'placeholder' => 'system.form_item_option_value.form_item',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ])->add('formTypeOption', Select2EntityType::class, [
                        'multiple' => false,
                        'remote_route' => 'typeahead',
                        'remote_params' =>['module'=>'system', 'alias' =>'form-type-option'],
                        'class' => 'TMSolution\DynamicFormBundle\Entity\FormTypeOption',
                        'primary_key' => 'id',
                        'text_property' => 'name',
                        'minimum_input_length' => 0,
                        'allow_clear' => true,
                        'delay' => 250,
                        'cache' => true,
                        'scroll' => true,
                        'cache_timeout' => 60000, // if 'cache' is true
                        'language' => 'pl',
                        'placeholder' => 'system.form_item_option_value.form_type_option',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ]);          
                        if ($this->context->get('formItem')){     

                $builder->add('formItem', HiddenEntityType::class, [
                    'label' => 'system.form_item_option_value.form_item',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormItem','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormItem')->findOneById($this->context->get('formItem')),'empty_data' => NULL,
                    'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }            if ($this->context->get('formTypeOption')){     

                $builder->add('formTypeOption', HiddenEntityType::class, [
                    'label' => 'system.form_item_option_value.form_type_option',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormTypeOption','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormTypeOption')->findOneById($this->context->get('formTypeOption')),'empty_data' => NULL,
                    'required' => false,
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
            'data_class' => 'TMSolution\DynamicFormBundle\Entity\FormItemOptionValue',
            'attr' => array('novalidate' => 'novalidate')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_form_item_option_value_edit';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}
