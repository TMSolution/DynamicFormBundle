<?php

namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_item")
 */
class FormItem {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=300, nullable=true)
     */
    protected $name;

    /**
     *
     * @ORM\ManyToOne(targetEntity="FormType",inversedBy="formItems")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="form_type_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $formType;

    /**
     *
     * @ORM\ManyToOne(targetEntity="FormPage",inversedBy="formItems")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dynamic_form_page_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $formPage;

    /**
     * @ORM\OneToMany(targetEntity="FormItemOptionValue", mappedBy="formItem",cascade={"persist","remove"})
     */
    protected $formItemOptionsValues;

    /**
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    protected $position;
    
    
    
    
    /**
     * @ORM\Column(name="required", type="boolean", nullable=true)
     */
    protected $required; 

    
    
    public function __toString() {

        return (string) $this->getFormType()->getName();
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formItemOptionsValues = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return FormItem
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return FormItem
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set required
     *
     * @param boolean $required
     *
     * @return FormItem
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get required
     *
     * @return boolean
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Set formType
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormType $formType
     *
     * @return FormItem
     */
    public function setFormType(\TMSolution\DynamicFormBundle\Entity\FormType $formType)
    {
        $this->formType = $formType;

        return $this;
    }

    /**
     * Get formType
     *
     * @return \TMSolution\DynamicFormBundle\Entity\FormType
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * Set formPage
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormPage $formPage
     *
     * @return FormItem
     */
    public function setFormPage(\TMSolution\DynamicFormBundle\Entity\FormPage $formPage)
    {
        $this->formPage = $formPage;

        return $this;
    }

    /**
     * Get formPage
     *
     * @return \TMSolution\DynamicFormBundle\Entity\FormPage
     */
    public function getFormPage()
    {
        return $this->formPage;
    }

    /**
     * Add formItemOptionsValue
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormItemOptionValue $formItemOptionsValue
     *
     * @return FormItem
     */
    public function addFormItemOptionsValue(\TMSolution\DynamicFormBundle\Entity\FormItemOptionValue $formItemOptionsValue)
    {
        $this->formItemOptionsValues[] = $formItemOptionsValue;

        return $this;
    }

    /**
     * Remove formItemOptionsValue
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormItemOptionValue $formItemOptionsValue
     */
    public function removeFormItemOptionsValue(\TMSolution\DynamicFormBundle\Entity\FormItemOptionValue $formItemOptionsValue)
    {
        $this->formItemOptionsValues->removeElement($formItemOptionsValue);
    }

    /**
     * Get formItemOptionsValues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormItemOptionsValues()
    {
        return $this->formItemOptionsValues;
    }
}
