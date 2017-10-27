<?php

namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_type")
 * 
 */
class FormType implements Translatable  {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=300, nullable=false)
     * @Gedmo\Translatable
     */
    protected $name;

    /**
     * @ORM\Column(name="technical_name", type="string", length=300, nullable=false)
     */
    protected $technicalName;

    /**
     * @ORM\Column(name="class_name", type="string", length=300, nullable=false)
     */
    protected $className;

    /**
     * @var \Callcenter
     *
     * @ORM\ManyToOne(targetEntity="FormType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="form_type_id", referencedColumnName="id", nullable=true)
     * })
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="FormTypeOption", mappedBy="formType")
     */
    protected $formTypeOptions;

    /**
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    protected $active;

    /**
     * @ORM\Column(name="css_icon_class", type="string", nullable=true)
     */
    protected $cssIconClass;

    /**
     * @ORM\OneToMany(targetEntity="FormItem", mappedBy="formType")
     */
    protected $formItems;

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;

    public function __toString() {

        return (string) $this->getName();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formTypeOptions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return FormType
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
     * Set technicalName
     *
     * @param string $technicalName
     *
     * @return FormType
     */
    public function setTechnicalName($technicalName)
    {
        $this->technicalName = $technicalName;

        return $this;
    }

    /**
     * Get technicalName
     *
     * @return string
     */
    public function getTechnicalName()
    {
        return $this->technicalName;
    }

    /**
     * Set className
     *
     * @param string $className
     *
     * @return FormType
     */
    public function setClassName($className)
    {
        $this->className = $className;

        return $this;
    }

    /**
     * Get className
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return FormType
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set cssIconClass
     *
     * @param string $cssIconClass
     *
     * @return FormType
     */
    public function setCssIconClass($cssIconClass)
    {
        $this->cssIconClass = $cssIconClass;

        return $this;
    }

    /**
     * Get cssIconClass
     *
     * @return string
     */
    public function getCssIconClass()
    {
        return $this->cssIconClass;
    }

    /**
     * Set parent
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormType $parent
     *
     * @return FormType
     */
    public function setParent(\TMSolution\DynamicFormBundle\Entity\FormType $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \TMSolution\DynamicFormBundle\Entity\FormType
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add formTypeOption
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormTypeOption $formTypeOption
     *
     * @return FormType
     */
    public function addFormTypeOption(\TMSolution\DynamicFormBundle\Entity\FormTypeOption $formTypeOption)
    {
        $this->formTypeOptions[] = $formTypeOption;

        return $this;
    }

    /**
     * Remove formTypeOption
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormTypeOption $formTypeOption
     */
    public function removeFormTypeOption(\TMSolution\DynamicFormBundle\Entity\FormTypeOption $formTypeOption)
    {
        $this->formTypeOptions->removeElement($formTypeOption);
    }

    /**
     * Get formTypeOptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormTypeOptions()
    {
        return $this->formTypeOptions;
    }

    /**
     * Add formItem
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormItem $formItem
     *
     * @return FormType
     */
    public function addFormItem(\TMSolution\DynamicFormBundle\Entity\FormItem $formItem)
    {
        $this->formItems[] = $formItem;

        return $this;
    }

    /**
     * Remove formItem
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormItem $formItem
     */
    public function removeFormItem(\TMSolution\DynamicFormBundle\Entity\FormItem $formItem)
    {
        $this->formItems->removeElement($formItem);
    }

    /**
     * Get formItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormItems()
    {
        return $this->formItems;
    }
}
