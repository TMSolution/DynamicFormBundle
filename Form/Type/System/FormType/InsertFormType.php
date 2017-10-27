<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormType;
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
        
        $builder            ->add('name',null,  ['label' => 'system.form_type.name','constraints' => [new Constraints\NotBlank()]])            ->add('technicalName',null,  ['label' => 'system.form_type.technical_name','constraints' => [new Constraints\NotBlank()]])            ->add('className',null,  ['label' => 'system.form_type.class_name','constraints' => [new Constraints\NotBlank()]])->add('parent', Select2EntityType::class, [
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
                    ])            ->add('active',null,  ['label' => 'system.form_type.active','constraints' => []])            ->add('cssIconClass',null,  ['label' => 'system.form_type.css_icon_class','constraints' => []]);
            
                         if ($this->context->get('parent')){     

                $builder->add('parent', HiddenEntityType::class, [
                    'label' => 'system.form_type.parent',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormType','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormType')->findOneById($this->context->get('parent')),'required' => false,
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
            'data_class' => 'TMSolution\DynamicFormBundle\Entity\FormType',
            'attr' => array('novalidate' => 'novalidate'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_form_type_insert';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}

