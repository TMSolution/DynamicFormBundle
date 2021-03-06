<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormTypeOptionDict;
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
        
        $builder            ->add('name',null,  ['label' => 'system.form_type_option_dict.name','constraints' => [new Constraints\NotBlank()]])            ->add('technicalName',null,  ['label' => 'system.form_type_option_dict.technical_name','constraints' => [new Constraints\NotBlank()]]);
            
                         if ($this->context->get('formTypeOptions')){     

                $builder->add('formTypeOptions', HiddenEntityType::class, [
                    'label' => 'system.form_type_option_dict.form_type_options',
                    'class' => 'TMSolution\DynamicFormBundle\Entity\FormTypeOption',                    'data' =>  $this->entityManager->getRepository('TMSolution\DynamicFormBundle\Entity\FormTypeOption')->findById($this->context->get('formTypeOptions')),
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
            'data_class' => 'TMSolution\DynamicFormBundle\Entity\FormTypeOptionDict',
            'attr' => array('novalidate' => 'novalidate'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_form_type_option_dict_insert';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}

