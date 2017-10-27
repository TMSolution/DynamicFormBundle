<?php

namespace TMSolution\DynamicFormBundle\Form\Type\System\FormDataSetItem;

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
            ->add('value',null,  ['label' => 'system.form_data_set_item.value','constraints' => []]);          
            ;
            
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TMSolution\DynamicFormBundle\Entity\FormDataSetItem',
            'attr' => array('novalidate' => 'novalidate')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_form_data_set_item_edit';
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}
