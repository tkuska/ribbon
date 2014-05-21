<?php

namespace tkuska\RibbonBundle\Ribbon;

use tkuska\RibbonBundle\Exception\ElementNotFoundException;
use tkuska\RibbonBundle\Exception\ElementAlreadyExistsException;

class Tab
{
    private $ribbon;

    private $name;

    private $route = '#';

    private $active = 0;

    private $sections;

    private $index;

    private $id;

    /**
     *
     * @param  string                          $id
     * @param  string                          $name
     * @param  array                           $options
     * @return \tkuska\RibbonBundle\Ribbon\Tab
     */
    public function __construct($id, $name, array $options=array())
    {
        $this->id = $id;
        $this->name = $name;
        $this->sections = new \Doctrine\Common\Collections\ArrayCollection();

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param  string                              $name
     * @param  array                               $options
     * @return \tkuska\RibbonBundle\Ribbon\Section
     */
    public function createSection($name, array $options=array())
    {
        if($this->sections[$name]){
            throw new ElementAlreadyExistsException(sprintf('Section "%s" already exists for tab "%s"', $name, $this->name));
        }
        $this->sections[$name] = new Section($name, $options);

        $this->sections[$name]->setTab($this);

        return $this->sections[$name];
    }

    /**
     *
     * @param  \tkuska\RibbonBundle\Ribbon\Section $section
     * @return \tkuska\RibbonBundle\Ribbon\Section
     */
    public function addSection(Section $section)
    {
        if($this->sections[$section->getName()]){
            throw new ElementAlreadyExistsException(sprintf('Section "%s" already exists for tab "%s"', $section->getName(), $this->name));
        }
        $section->setTab($this);

        $this->sections[$section->getName()] = $section;

        return $this->sections[$section->getName()];
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
    public function getSections()
    {
        return $this->sections;
    }

    /**
     *
     * @param  boolean                         $active
     * @return \tkuska\RibbonBundle\Ribbon\Tab
     */
    public function setActive($active = true)
    {
        if ($active === true) {
            if(!$this->ribbon){
                throw new ElementNotFoundException('Ribbon not found, tab is not attached to any ribbon.');
            }
            foreach ($this->ribbon->getTabs() as $id => $tab) {
                if ($id == $this->id) {
                    continue;
                }
                $tab->setActive(false);
            }
        }

        $this->active = $active;

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function isActive()
    {
        if ($this->active) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     *
     * @return string
     */
    public function setRoute($route)
    {        
        $this->route = $route;
        
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     *
     * @param  int                             $index
     * @return \tkuska\RibbonBundle\Ribbon\Tab
     */
    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     *
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     *
     * @param  string                              $name
     * @return \tkuska\RibbonBundle\Ribbon\Section
     */
    public function getSection($name)
    {
        if(!$this->sections[$name]){
            throw new ElementNotFoundException(sprintf('Section "%s" not found.', $name));
        }
        return $this->sections[$name];
    }

    /**
     *
     * @return \tkuska\RibbonBundle\Ribbon\Ribbon
     */
    public function getRibbon()
    {
        return $this->ribbon;
    }

    /**
     *
     * @param  \tkuska\RibbonBundle\Ribbon\Ribbon $ribbon
     * @return \tkuska\RibbonBundle\Ribbon\Tab
     */
    public function setRibbon(Ribbon $ribbon)
    {
        $this->ribbon = $ribbon;

        return $this;
    }

}
