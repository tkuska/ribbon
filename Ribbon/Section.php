<?php

namespace kusior\RibbonBundle\Ribbon;

class Section
{
    private $name;

    private $buttons;

    private $tab;

    /**
     *
     * @param  string                              $name
     * @return \kusior\RibbonBundle\Ribbon\Section
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
     * @return \kusior\RibbonBundle\Ribbon\Button
     */
    public function createButton($name, array $options = array())
    {
        $this->buttons[$name] = new Button($name, $options);

        $this->buttons[$name]->setSection($this);

        return $this->buttons[$name];
    }

    /**
     *
     * @param  \kusior\RibbonBundle\Ribbon\Button  $button
     * @return \kusior\RibbonBundle\Ribbon\Section
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
     * @return \kusior\RibbonBundle\Ribbon\Section
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
     * @return \kusior\RibbonBundle\Ribbon\Button
     */
    public function getButton($name)
    {
        return $this->buttons[$name];
    }

    /**
     *
     * @param  \kusior\RibbonBundle\Ribbon\Tab     $tab
     * @return \kusior\RibbonBundle\Ribbon\Section
     */
    public function setTab(Tab $tab)
    {
        $this->tab = $tab;

        return $this;
    }

    /**
     *
     * @return \kusior\RibbonBundle\Ribbon\Tab
     */
    public function getTab()
    {
        return $this->tab;
    }

}
