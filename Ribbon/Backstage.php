<?php

namespace kusior\RibbonBundle\Ribbon;

class Backstage
{
    private $name;

    private $route = '#';

    private $selected = 0;

    private $text;

    private $buttons;

    /**
     *
     * @param  string                                $name
     * @param  array                                 $options
     * @return \kusior\RibbonBundle\Ribbon\Backstage
     */
    public function __construct($name ='Backstage', array $options=array())
    {
        $this->name = $name;
        $this->buttons = new \Doctrine\Common\Collections\ArrayCollection();

        return $this;
    }

    /**
     *
     * @param  string                                $name
     * @param  array                                 $options
     * @return \kusior\RibbonBundle\Ribbon\Backstage
     */
    public function createButton($name, array $options=array())
    {
        $this->buttons[] = new Button($name, $options);

        return $this;
    }

    /**
     *
     * @param  \kusior\RibbonBundle\Ribbon\Button    $button
     * @return \kusior\RibbonBundle\Ribbon\Backstage
     */
    public function addButton(Button $button)
    {
        $this->buttons[] = $button;

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
     * @return \Doctrine\Common\Collections\ArrayCollection;
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

}
