<?php


namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_data_set")
 */
class FormDataSet {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;    
    
    /**
     * @ORM\Column(name="creation_date", type="datetime", nullable=false)
     */
    protected $creationDate;
    
    /**
     * @ORM\Column(name="form_data_set", type="text", nullable=true)
     */
    protected $formDataSet;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="DynamicForm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dynamic_form_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $dynamicForm;
   

  

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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return FormDataSet
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set formDataSet
     *
     * @param string $formDataSet
     *
     * @return FormDataSet
     */
    public function setFormDataSet($formDataSet)
    {
        $this->formDataSet = $formDataSet;

        return $this;
    }

    /**
     * Get formDataSet
     *
     * @return string
     */
    public function getFormDataSet()
    {
        return $this->formDataSet;
    }

    /**
     * Set form
     *
     * @param \TMSolution\DynamicFormBundle\Entity\Form $form
     *
     * @return FormDataSet
     */
    public function setForm(\TMSolution\DynamicFormBundle\Entity\Form $form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get form
     *
     * @return \TMSolution\DynamicFormBundle\Entity\Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Set dynamicForm
     *
     * @param \TMSolution\DynamicFormBundle\Entity\DynamicForm $dynamicForm
     *
     * @return FormDataSet
     */
    public function setDynamicForm(\TMSolution\DynamicFormBundle\Entity\DynamicForm $dynamicForm)
    {
        $this->dynamicForm = $dynamicForm;

        return $this;
    }

    /**
     * Get dynamicForm
     *
     * @return \TMSolution\DynamicFormBundle\Entity\DynamicForm
     */
    public function getDynamicForm()
    {
        return $this->dynamicForm;
    }
}
