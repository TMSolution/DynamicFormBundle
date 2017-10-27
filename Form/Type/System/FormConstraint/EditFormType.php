<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormConstraint;

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
            ->add('name',null,  ['label' => 'system.form_constraint.name','constraints' => []])            
            ->add('technicalName',null,  ['label' => 'system.form_constraint.technical_name','constraints' => []])            
            ->add('options',null,  ['label' => 'system.form_constraint.options','constraints' => []])->add('formConstraintCategory', Select2EntityType::class, [
                        'multiple' => false,
                        'remote_route' => 'typeahead',
                        'remote_params' =>['module'=>'system', 'alias' =>'form-constraint-category'],
                        'class' => 'TMSolution\DynamicFormBundle\Entity\FormConstraintCategory',
                        'primary_key' => 'id',
                        'text_property' => 'name',
                        'minimum_input_length' => 0,
                        'allow_clear' => true,
                        'delay' => 250,
                        'cache' => true,
                        'scroll' => true,
                        'cache_timeout' => 60000, // if 'cache' is true
                        'language' => 'pl',
                        'placeholder' => 'system.form_constraint.form_constraint_category',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ]);          
                        if ($this->context->get('formConstraintCategory')){     

                $builder->add('formConstraintCategory', HiddenEntityType::class, [
                    'label' => 'system.form_constraint.form_constraint_category',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormConstraintCategory','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormConstraintCategory')->findOneById($this->context->get('formConstraintCategory')),'empty_data' => NULL,
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
            'data_class' => 'TMSolution\DynamicFormBundle\Entity\FormConstraint',
            'attr' => array('novalidate' => 'novalidate')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_form_constraint_edit';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}
