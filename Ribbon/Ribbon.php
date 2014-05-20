<?php

namespace tkuska\RibbonBundle\Ribbon;

use tkuska\RibbonBundle\Exception\TabAlreadyExistsException;
use tkuska\RibbonBundle\Exception\TabNotFoundException;

class Ribbon
{
    private $name;

    private $tabs;

    private $backstage;

    /**
     *
     * @param  string $name
     * @return \tkuska\RibbonBundle\Ribbon\Ribbon
     */
    public function __construct($name = '')
    {
        $this->tabs = new \Doctrine\Common\Collections\ArrayCollection();

        $this->name = $name;

        return $this;
    }

    /**
     * Adds existing tab to ribbon
     * 
     * @param  \tkuska\RibbonBundle\Ribbon\Tab $tab
     * @return \tkuska\RibbonBundle\Ribbon\Tab
     */
    public function addTab(Tab $tab)
    {
        if($this->tabs[$tab->getId()]){
            throw new TabAlreadyExistsException(sprintf('Tab "%s" already exists.', $tab->getId()));
        }
        
        $tab->setRibbon($this);
        $tab->setIndex(count($this->tabs));
        $this->tabs[$tab->getId()] = $tab;

        return $this->tabs[$tab->getId()];
    }

    /**
     * Creates new tab
     * 
     * @param  string                          $id
     * @param  string                          $name
     * @param  array                           $options
     * @return \tkuska\RibbonBundle\Ribbon\Tab
     */
    public function createTab($id, $name, array $options=array())
    {
        if($this->tabs[$id]){
            throw new TabAlreadyExistsException(sprintf('Tab "%s" already exists.', $id));
        }
        
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
     * @return \tkuska\RibbonBundle\Ribbon\Ribbon
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
     * @return \tkuska\RibbonBundle\Ribbon\Ribbon
     */
    public function setActiveTab($id)
    {
        if(!$this->tabs[$id]){
            throw new TabNotFoundException(sprintf('Cannot find tab "%s"', $id));
        }
        $this->tabs[$id]->setActive();

        return $this;
    }

    /**
     * @deprecated use getTabById instead
     * @param  string                          $id
     * @return \tkuska\RibbonBundle\Ribbon\Tab
     */
    public function getTabByName($id)
    {
        return $this->getTabById($id);
    }
    
    /**
     *
     * @param  string                          $id
     * @return \tkuska\RibbonBundle\Ribbon\Tab
     */
    public function getTabById($id)
    {
        if(!$this->tabs[$id]){
            throw new TabNotFoundException(sprintf('Cannot find tab "%s"', $id));
        }
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
     * @return string
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     *
     * @param  string                             $name
     * @param  array                              $options
     * @return \tkuska\RibbonBundle\Ribbon\Ribbon
     */
    public function setBackstage($name, $options = array())
    {
        $this->backstage = new Backstage($name, $options);

        return $this;
    }

    /**
     *
     * @return \tkuska\RibbonBundle\Ribbon\Backstage
     */
    public function getBackstage()
    {           
        if(!$this->backstage){
            throw new TabNotFoundException('There is no backstage defined for this ribbon.');
        }
        
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
    public function hasBackstage()
    {
        if ($this->backstage) {
            return true;
        } else {
            return false;
        }
    }

}
