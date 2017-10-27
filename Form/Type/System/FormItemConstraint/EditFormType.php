<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormItemConstraint;

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
            ->add('options',null,  ['label' => 'system.form_item_constraint.options','constraints' => []])->add('formItem', Select2EntityType::class, [
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
                    ])->add('constraint', Select2EntityType::class, [
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
                        if ($this->context->get('formItem')){     

                $builder->add('formItem', HiddenEntityType::class, [
                    'label' => 'system.form_item_constraint.form_item',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormItem','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormItem')->findOneById($this->context->get('formItem')),'empty_data' => NULL,
                    'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }            if ($this->context->get('constraint')){     

                $builder->add('constraint', HiddenEntityType::class, [
                    'label' => 'system.form_item_constraint.constraint',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormConstraint','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormConstraint')->findOneById($this->context->get('constraint')),'empty_data' => NULL,
                    'required' => false,
                    'constraints' => [new Constraints\NotBlank()]
                ]);

            }            
            $builder->get('options')
            ->addModelTransformer(new ArrayToJSONStringTransformer());;
            
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TMSolution\DynamicFormBundle\Entity\FormItemConstraint',
            'attr' => array('novalidate' => 'novalidate')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_form_item_constraint_edit';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}
