<?php


namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_constraint_category")
 */
class FormConstraintCategory  implements Translatable {

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
     * @ORM\OneToMany(targetEntity="FormConstraint", mappedBy="FormConstraintCategory")
     */
    protected $formConstraints;
    
   
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
     * Constructor
     */
    public function __construct()
    {
        $this->formConstraints = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return FormConstraintCategory
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
     * Add formConstraint
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormConstraint $formConstraint
     *
     * @return FormConstraintCategory
     */
    public function addFormConstraint(\TMSolution\DynamicFormBundle\Entity\FormConstraint $formConstraint)
    {
        $this->formConstraints[] = $formConstraint;

        return $this;
    }

    /**
     * Remove formConstraint
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormConstraint $formConstraint
     */
    public function removeFormConstraint(\TMSolution\DynamicFormBundle\Entity\FormConstraint $formConstraint)
    {
        $this->formConstraints->removeElement($formConstraint);
    }

    /**
     * Get formConstraints
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormConstraints()
    {
        return $this->formConstraints;
    }
}
