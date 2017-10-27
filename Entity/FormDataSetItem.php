<?php


namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_data_set_item")
 */
class FormDataSetItem {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;    
    
    /**
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    protected $value;
   
     /**
     * @ORM\OneToMany(targetEntity="FormItem", mappedBy="formType")
     */
    protected $formItem;
    
   
  
   
    
     public function __toString() {
        
        return $this->getValue();
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formItem = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return FormDataSetItem
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
     * Add formItem
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormItem $formItem
     *
     * @return FormDataSetItem
     */
    public function addFormItem(\TMSolution\DynamicFormBundle\Entity\FormItem $formItem)
    {
        $this->formItem[] = $formItem;

        return $this;
    }

    /**
     * Remove formItem
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormItem $formItem
     */
    public function removeFormItem(\TMSolution\DynamicFormBundle\Entity\FormItem $formItem)
    {
        $this->formItem->removeElement($formItem);
    }

    /**
     * Get formItem
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormItem()
    {
        return $this->formItem;
    }
}
