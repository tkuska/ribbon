<?php

namespace tkuska\RibbonBundle\Ribbon;

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
