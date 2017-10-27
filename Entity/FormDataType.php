<?php


namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_data_type")
 */
class FormDataType {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=300, nullable=false)
     */
    protected $name;
    
    
    /**
     * @ORM\Column(name="technical_name", type="string", length=300, nullable=false)
     */
    protected $technicalName;
    
     /**
     * @ORM\ManyToMany(targetEntity="FormTypeOption", mappedBy="formDataTypes") 
     */
    protected $formTypeOptions;

   
    
    public function __toString() {
        return (string)$this->getName();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formTypeOptions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return FormDataType
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
     * @return FormDataType
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
     * Add formTypeOption
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormTypeOption $formTypeOption
     *
     * @return FormDataType
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
}
