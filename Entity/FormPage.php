<?php


namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form_page")
 */
class FormPage {

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
     * @ORM\Column(name="validate_on_page_change", type="boolean", nullable=true)
     */
    protected $validateOnPageChange;
    
    /**
     * @ORM\Column(name="save_on_page_change", type="boolean", nullable=true)
     */
    protected $saveOnPageChange;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="DynamicForm",inversedBy="formPages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dynamic_form_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $dynamicForm;
    
    /**
     * @ORM\OneToMany(targetEntity="FormItem", mappedBy="formPage")
     */
    protected $formItems;

  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return FormPage
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
     * Set validateOnPageChange
     *
     * @param boolean $validateOnPageChange
     *
     * @return FormPage
     */
    public function setValidateOnPageChange($validateOnPageChange)
    {
        $this->validateOnPageChange = $validateOnPageChange;

        return $this;
    }

    /**
     * Get validateOnPageChange
     *
     * @return boolean
     */
    public function getValidateOnPageChange()
    {
        return $this->validateOnPageChange;
    }

    /**
     * Set saveOnPageChange
     *
     * @param boolean $saveOnPageChange
     *
     * @return FormPage
     */
    public function setSaveOnPageChange($saveOnPageChange)
    {
        $this->saveOnPageChange = $saveOnPageChange;

        return $this;
    }

    /**
     * Get saveOnPageChange
     *
     * @return boolean
     */
    public function getSaveOnPageChange()
    {
        return $this->saveOnPageChange;
    }

   

    /**
     * Add formItem
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormItem $formItem
     *
     * @return FormPage
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
    
    
    public function __toString() {
        
        return (string)$this->name;
    }

    /**
     * Set dynamicForm
     *
     * @param \TMSolution\DynamicFormBundle\Entity\DynamicForm $dynamicForm
     *
     * @return FormPage
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
