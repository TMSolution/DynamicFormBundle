<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\DynamicForm;
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
        
        $builder            ->add('name',null,  ['label' => 'system.dynamic_form.name','constraints' => []]);
            
             ;
            
            
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TMSolution\DynamicFormBundle\Entity\DynamicForm',
            'attr' => array('novalidate' => 'novalidate'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_dynamic_form_insert';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}

