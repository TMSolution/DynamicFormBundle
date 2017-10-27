<?php

namespace TMSolution\DynamicFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dynamic_form")
 */
class DynamicForm {

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
     * @ORM\OneToMany(targetEntity="FormPage", mappedBy="dynamicForm")
     */
    protected $formPages;

    /**
     * Constructor
     */
    public function __construct() {
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Form
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Add formPage
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormPage $formPage
     *
     * @return Form
     */
    public function addFormPage(\TMSolution\DynamicFormBundle\Entity\FormPage $formPage) {
        $this->formPages[] = $formPage;

        return $this;
    }

    /**
     * Remove formPage
     *
     * @param \TMSolution\DynamicFormBundle\Entity\FormPage $formPage
     */
    public function removeFormPage(\TMSolution\DynamicFormBundle\Entity\FormPage $formPage) {
        $this->formPages->removeElement($formPage);
    }

    /**
     * Get formPages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormPages() {
        return $this->formPages;
    }

    public function __toString() {

        return (string)$this->getName();
    }

}
