<?php

namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;


/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_type_option")
 * 
 */
class FormTypeOption implements Translatable  {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="default_value", type="string", length=300, nullable=true)
     */
    protected $defaultValue;

    /**
     *
     * @ORM\ManyToOne(targetEntity="FormType", inversedBy="formTypeOptions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="form_type_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $formType;

    /**
     *
     * @ORM\ManyToOne(targetEntity="FormTypeOptionDict")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="form_type_option_dict_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $formTypeOptionDict;

    /**
     * @ORM\ManyToMany(targetEntity="FormDataType",inversedBy="formTypeOptions")
     * @ORM\JoinTable(name="form_type_option_has_data_type",
     *      joinColumns={@ORM\JoinColumn(name="form_type_option_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="form_data_type_id", referencedColumnName="id", unique=false)}
     *      )
     */
    protected $dataTypes;

    /**
     * @ORM\Column(name="option_required", type="boolean", nullable=true)
     */
    protected $optionRequired;

    /**
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    protected $active;

    /**
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\Column(name="is_advanced", type="boolean", nullable=true)
     */
    protected $isAdvanced;
    
    
     /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dataTypes = new \Doctrine\Common\Collections\ArrayCollection();
    }

  
      
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
    
    
    public function __toString() {
        return (string) $this->id;
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
     * Set defaultValue
     *
     * @param string $defaultValue
     *
     * @return FormTypeOption
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * Get defaultValue
     *
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * Set optionRequired
     *
     * @param boolean $optionRequired
     *
     * @return FormTypeOption
     */
    public function setOptionRequired($optionRequired)
    {
        $this->optionRequired = $optionRequired;

        return $this;
    }

    /**
     * Get optionRequired
     *
     * @return boolean
     */
    public function getOptionRequired()
    {
        return $this->optionRequired;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return FormTypeOption
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
     * Set position
     *
     * @param integer $position
     *
     * @return FormTypeOption
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
     * Set isAdvanced
     *
     * @param boolean $isAdvanced
     *
     * @return FormTypeOption
     */
    public function setIsAdvanced($isAdvanced)
    {
        $this->isAdvanced = $isAdvanced;

        return $this;
    }

    /**
     * Get isAdvanced
     *
     * @return boolean
     */
    public function getIsAdvanced()
    {
        return $this->isAdvanced;
    }

    /**
     * Set formType
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormType $formType
     *
     * @return FormTypeOption
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
     * Set formTypeOptionDict
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormTypeOptionDict $formTypeOptionDict
     *
     * @return FormTypeOption
     */
    public function setFormTypeOptionDict(\TMSolution\DynamicFormBundle\Entity\FormTypeOptionDict $formTypeOptionDict)
    {
        $this->formTypeOptionDict = $formTypeOptionDict;

        return $this;
    }

    /**
     * Get formTypeOptionDict
     *
     * @return \TMSolution\DynamicFormBundle\Entity\FormTypeOptionDict
     */
    public function getFormTypeOptionDict()
    {
        return $this->formTypeOptionDict;
    }

    /**
     * Add dataType
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormDataType $dataType
     *
     * @return FormTypeOption
     */
    public function addDataType(\TMSolution\DynamicFormBundle\Entity\FormDataType $dataType)
    {
        $this->dataTypes[] = $dataType;

        return $this;
    }

    /**
     * Remove dataType
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormDataType $dataType
     */
    public function removeDataType(\TMSolution\DynamicFormBundle\Entity\FormDataType $dataType)
    {
        $this->dataTypes->removeElement($dataType);
    }

    /**
     * Get dataTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDataTypes()
    {
        return $this->dataTypes;
    }
}
