<?php


namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_constraint")
 */
class FormConstraint implements Translatable {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;    
    
    /**
     * @ORM\Column(name="name", type="string", length=4000, nullable=true)
     * @Gedmo\Translatable 
     */
    protected $name;
    
    /**
     * @ORM\Column(name="technical_name", type="string", length=4000, nullable=true)
     */
    protected $technicalName;
    
    /**
    * @ORM\Column(name="options", type="array", nullable=true)
    */
    protected $options;
    
    /**
     * @ORM\ManyToOne(targetEntity="FormConstraintCategory",inversedBy = "formConstraints" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="constraint_category_id", referencedColumnName="id", nullable=true)
     * })
     */
    protected $formConstraintCategory;
    
    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;
    
    
    
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
     * Set name
     *
     * @param string $name
     *
     * @return FormConstraint
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
     * @return FormConstraint
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
     * Set options
     *
     * @param array $options
     *
     * @return FormConstraint
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set formConstraintCategory
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormConstraintCategory $formConstraintCategory
     *
     * @return FormConstraint
     */
    public function setFormConstraintCategory(\TMSolution\DynamicFormBundle\Entity\FormConstraintCategory $formConstraintCategory = null)
    {
        $this->formConstraintCategory = $formConstraintCategory;

        return $this;
    }

    /**
     * Get formConstraintCategory
     *
     * @return \TMSolution\DynamicFormBundle\Entity\FormConstraintCategory
     */
    public function getFormConstraintCategory()
    {
        return $this->formConstraintCategory;
    }
}
