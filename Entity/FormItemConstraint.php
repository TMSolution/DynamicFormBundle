<?php

namespace TMSolution\DynamicFormBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_item_constraint")
 */

class FormItemConstraint
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\Column(name="options", type="array", nullable=true)
    */
    private $options;

    /**
     *
     * @ORM\ManyToOne(targetEntity="FormItem",inversedBy="formItemConstraints",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="form_item_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $formItem;

    /**
     *
     * @ORM\ManyToOne(targetEntity="FormConstraint",inversedBy="formItemConstraints",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="constraint_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $constraint;


    public function __toString() {
        
        return (string)$this->id;
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
     * Set options
     *
     * @param array $options
     *
     * @return FormItemConstraint
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
     * Set formItem
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormItem $formItem
     *
     * @return FormItemConstraint
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
     * Set constraint
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormConstraint $constraint
     *
     * @return FormItemConstraint
     */
    public function setConstraint(\TMSolution\DynamicFormBundle\Entity\FormConstraint $constraint)
    {
        $this->constraint = $constraint;

        return $this;
    }

    /**
     * Get constraint
     *
     * @return \TMSolution\DynamicFormBundle\Entity\FormConstraint
     */
    public function getConstraint()
    {
        return $this->constraint;
    }
}
