<?php


namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_item_option_value")
 */
class FormItemOptionValue {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;    
    
    /**
     * @ORM\Column(name="value", type="string", length=4000, nullable=true)
     */
    protected $value;
  
    /**
     *
     * @ORM\ManyToOne(targetEntity="FormItem",inversedBy="formItemOptionsValues",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dynamic_form_item_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $formItem;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="FormTypeOption",inversedBy="formItemOptionsValues",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="form_item_option_value_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $formTypeOption;
   
    public function __toString() {
        
        return $this->getValue();
    }
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return FormItemOptionValue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set formItem
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormItem $formItem
     *
     * @return FormItemOptionValue
     */
    public function setFormItem(\TMSolution\DynamicFormBundle\Entity\FormItem $formItem)
    {
        $this->formItem = $formItem;

        return $this;
    }

    /**
     * Get formItem
     *
     * @return \TMSolution\DynamicFormBundle\Entity\FormItem
     */
    public function getFormItem()
    {
        return $this->formItem;
    }

    /**
     * Set formTypeOption
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormTypeOption $formTypeOption
     *
     * @return FormItemOptionValue
     */
    public function setFormTypeOption(\TMSolution\DynamicFormBundle\Entity\FormTypeOption $formTypeOption)
    {
        $this->formTypeOption = $formTypeOption;

        return $this;
    }

    /**
     * Get formTypeOption
     *
     * @return \TMSolution\DynamicFormBundle\Entity\FormTypeOption
     */
    public function getFormTypeOption()
    {
        return $this->formTypeOption;
    }
}
