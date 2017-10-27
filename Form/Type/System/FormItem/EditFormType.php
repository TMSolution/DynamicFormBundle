<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormItem;

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
            ->add('name',null,  ['label' => 'system.form_item.name','constraints' => []])->add('formType', Select2EntityType::class, [
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
                        'placeholder' => 'system.form_item.form_type',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ])->add('formPage', Select2EntityType::class, [
                        'multiple' => false,
                        'remote_route' => 'typeahead',
                        'remote_params' =>['module'=>'system', 'alias' =>'form-page'],
                        'class' => 'TMSolution\DynamicFormBundle\Entity\FormPage',
                        'primary_key' => 'id',
                        'text_property' => 'name',
                        'minimum_input_length' => 0,
                        'allow_clear' => true,
                        'delay' => 250,
                        'cache' => true,
                        'scroll' => true,
                        'cache_timeout' => 60000, // if 'cache' is true
                        'language' => 'pl',
                        'placeholder' => 'system.form_item.form_page',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ])            
            ->add('position',null,  ['label' => 'system.form_item.position','constraints' => []])            
            ->add('required',null,  ['label' => 'system.form_item.required','constraints' => []]);          
                        if ($this->context->get('formType')){     

                $builder->add('formType', HiddenEntityType::class, [
                    'label' => 'system.form_item.form_type',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormType','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormType')->findOneById($this->context->get('formType')),'empty_data' => NULL,
                    'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }            if ($this->context->get('formPage')){     

                $builder->add('formPage', HiddenEntityType::class, [
                    'label' => 'system.form_item.form_page',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormPage','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormPage')->findOneById($this->context->get('formPage')),'empty_data' => NULL,
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
            'data_class' => 'TMSolution\DynamicFormBundle\Entity\FormItem',
            'attr' => array('novalidate' => 'novalidate')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_form_item_edit';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}
