<?php

namespace kusior\RibbonBundle\Ribbon;

class Tab
{
    private $ribbon;

    private $name;

    private $route = '#';

    private $active = 0;

    private $sections;

    private $index;

    private $id;

    private $parameters;

    /**
     *
     * @param  string                          $id
     * @param  string                          $name
     * @param  array                           $options
     * @return \kusior\RibbonBundle\Ribbon\Tab
     */
    public function __construct($id, $name, array $options=array())
    {
        $this->id = $id;
        $this->name = $name;
        $this->section = new \Doctrine\Common\Collections\ArrayCollection();

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
     * @return \kusior\RibbonBundle\Ribbon\Section
     */
    public function createSection($name, array $options=array())
    {
        $this->sections[$name] = new Section($name, $options);

        $this->sections[$name]->setTab($this);

        return $this->sections[$name];
    }

    /**
     *
     * @param  \kusior\RibbonBundle\Ribbon\Section $section
     * @return \kusior\RibbonBundle\Ribbon\Section
     */
    public function addSection(Section $section)
    {
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
     * @return \kusior\RibbonBundle\Ribbon\Tab
     */
    public function setActive($active = true)
    {
        if ($active === true) {
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
    public function getRoute()
    {
        return $this->route;
    }

    /**
     *
     * @param  int                             $index
     * @return \kusior\RibbonBundle\Ribbon\Tab
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
     * @return \kusior\RibbonBundle\Ribbon\Section
     */
    public function getSection($name)
    {
        return $this->sections[$name];
    }

    /**
     *
     * @return \kusior\RibbonBundle\Ribbon\Ribbon
     */
    public function getRibbon()
    {
        return $this->ribbon;
    }

    /**
     *
     * @param  \kusior\RibbonBundle\Ribbon\Ribbon $ribbon
     * @return \kusior\RibbonBundle\Ribbon\Tab
     */
    public function setRibbon(Ribbon $ribbon)
    {
        $this->ribbon = $ribbon;

        return $this;
    }

}
