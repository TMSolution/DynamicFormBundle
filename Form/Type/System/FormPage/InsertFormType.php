<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormPage;
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
        
        $builder            ->add('name',null,  ['label' => 'system.form_page.name','constraints' => []])            ->add('validateOnPageChange',null,  ['label' => 'system.form_page.validate_on_page_change','constraints' => []])            ->add('saveOnPageChange',null,  ['label' => 'system.form_page.save_on_page_change','constraints' => []])->add('dynamicForm', Select2EntityType::class, [
                        'multiple' => false,
                        'remote_route' => 'typeahead',
                        'remote_params' =>['module'=>'system', 'alias' =>'dynamic-form'],
                        'class' => 'TMSolution\DynamicFormBundle\Entity\DynamicForm',
                        'primary_key' => 'id',
                        'text_property' => 'name',
                        'minimum_input_length' => 0,
                        'allow_clear' => true,
                        'delay' => 250,
                        'cache' => true,
                        'scroll' => true,
                        'cache_timeout' => 60000, // if 'cache' is true
                        'language' => 'pl',
                        'placeholder' => 'system.form_page.dynamic_form',
                        // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                    ]);
            
                         if ($this->context->get('dynamicForm')){     

                $builder->add('dynamicForm', HiddenEntityType::class, [
                    'label' => 'system.form_page.dynamic_form',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\DynamicForm','data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\DynamicForm')->findOneById($this->context->get('dynamicForm')),'required' => false,
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
            'data_class' => 'TMSolution\DynamicFormBundle\Entity\FormPage',
            'attr' => array('novalidate' => 'novalidate'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_form_page_insert';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}

