<?php

namespace tkuska\RibbonBundle\Ribbon;

use tkuska\RibbonBundle\Exception\ElementNotFoundException;
use tkuska\RibbonBundle\Exception\ElementAlreadyExistsException;

class Section
{
    private $name;

    private $buttons;

    private $tab;

    /**
     *
     * @param  string                              $name
     * @return \tkuska\RibbonBundle\Ribbon\Section
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->buttons = new \Doctrine\Common\Collections\ArrayCollection();

        return $this;
    }

    /**
     *
     * @param  string                             $name
     * @param  array                              $options
     * @return \tkuska\RibbonBundle\Ribbon\Button
     */
    public function createButton($name, array $options = array())
    {
        if($this->buttons[$name]){
            throw new ElementAlreadyExistsException(sprintf('Button "%s" already exists for section "%s"', $name, $this->name));
        }
        $this->buttons[$name] = new Button($name, $options);

        $this->buttons[$name]->setSection($this);

        return $this->buttons[$name];
    }

    /**
     *
     * @param  \tkuska\RibbonBundle\Ribbon\Button  $button
     * @return \tkuska\RibbonBundle\Ribbon\Section
     */
    public function addButton(Button $button)
    {
        if($this->buttons[$button->getName()]){
            throw new ElementAlreadyExistsException(sprintf('Button "%s" already exists for section "%s"', $button->getName(), $this->name));
        }
        $button->setSection($this);

        $this->buttons[$button->getName()] = $button;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @param  string                              $name
     * @return \tkuska\RibbonBundle\Ribbon\Section
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     *
     * @param  string                             $name
     * @return \tkuska\RibbonBundle\Ribbon\Button
     */
    public function getButton($name)
    {
        if(!$this->buttons[$name]){
            throw new ElementNotFoundException(sprintf('Button "%s" not found.', $name));
        }
        return $this->buttons[$name];
    }

    /**
     *
     * @param  \tkuska\RibbonBundle\Ribbon\Tab     $tab
     * @return \tkuska\RibbonBundle\Ribbon\Section
     */
    public function setTab(Tab $tab)
    {
        $this->tab = $tab;

        return $this;
    }

    /**
     *
     * @return \tkuska\RibbonBundle\Ribbon\Tab
     */
    public function getTab()
    {
        return $this->tab;
    }

}
