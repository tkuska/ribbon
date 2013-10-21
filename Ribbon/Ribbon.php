<?php

namespace kusior\RibbonBundle\Ribbon;

class Ribbon
{
    private $name;

    private $tabs;

    private $backstage;

    /**
     *
     * @param  string                             $name
     * @return \kusior\RibbonBundle\Ribbon\Ribbon
     */
    public function __construct($name = '')
    {
        $this->tabs = new \Doctrine\Common\Collections\ArrayCollection();

        $this->name = $name;

        return $this;
    }

    /**
     *
     * @param  \kusior\RibbonBundle\Ribbon\Tab $tab
     * @return \kusior\RibbonBundle\Ribbon\Tab
     */
    public function addTab(Tab $tab)
    {
        $tab->setRibbon($this);
        $tab->setIndex(count($this->tabs));
        $this->tabs[$id] = $tab;

        return $this->tabs[$id];
    }

    /**
     *
     * @param  string                          $id
     * @param  string                          $name
     * @param  array                           $options
     * @return \kusior\RibbonBundle\Ribbon\Tab
     */
    public function createTab($id, $name, array $options=array())
    {
        $tab =new Tab($id, $name, $options);

        $tab->setRibbon($this);
        $tab->setIndex(count($this->tabs));
        $this->tabs[$id] = $tab;

        return $this->tabs[$id];
    }

    /**
     *
     * @param  string                             $name
     * @param  array                              $options
     * @return \kusior\RibbonBundle\Ribbon\Ribbon
     */
    public function addBackstageButton($name, array $options=array())
    {
        if (!$this->backstage) {
            $this->backstage = new Backstage();
        }

        $this->backstage->createButton($name, $options);

        return $this;
    }

    /**
     *
     * @param  string                             $id
     * @return \kusior\RibbonBundle\Ribbon\Ribbon
     */
    public function setActiveTab($id)
    {
        $this->tabs[$id]->setActive();

        return $this;
    }

    /**
     *
     * @param  string                          $id
     * @return \kusior\RibbonBundle\Ribbon\Tab
     */
    public function getTabByName($id)
    {
        return $this->tabs[$id];
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
     * @param  string                             $name
     * @param  array                              $options
     * @return \kusior\RibbonBundle\Ribbon\Ribbon
     */
    public function setBackstage($name, $options = array())
    {
        $this->backstage = new Backstage($name, $options);

        return $this;
    }

    /**
     *
     * @return \kusior\RibbonBundle\Ribbon\Backstage
     */
    public function getBackstage()
    {
        return $this->backstage;
    }

    /**
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     *
     * @return boolean
     */
    public function getHasBackstage()
    {
        if ($this->backstage) {
            return true;
        } else {
            return false;
        }
    }

}
