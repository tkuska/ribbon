<?php

namespace tkuska\RibbonBundle\Ribbon;

class Button
{
    const STATE_NORMAL = '';

    const STATE_HOT = 'hot';

    const STATE_DISABLED = 'disabled';

    const TYPE_SMALL = 'small';

    const TYPE_LARGE = 'large';

    private $id;

    private $name;

    private $normal;

    private $hot;

    private $disabled;

    private $state = self::STATE_NORMAL;

    private $route = '#';

    private $type = self::TYPE_LARGE;

    private $help;

    private $class;

    private $parameters;

    private $section;

    /**
     *
     * @param  string                             $name
     * @param  array                              $options
     * @return \tkuska\RibbonBundle\Ribbon\Button
     */
    public function __construct($name, array $options=array())
    {
        $this->name = $name;

        if (isset($options['image'])) {
            $this->setImage($options['image']);
        }
        if (isset($options['disabled'])) {
            $this->disabled = $options['disabled'];
        }
        if (isset($options['hot'])) {
            $this->hot = $options['hot'];
        }
        if (isset($options['desc'])) {
            $this->help=$options['desc'];
        }
        if (isset($options['route'])) {
            $this->route = $options['route'];
        }
        if (isset($options['help'])) {
            $this->help = $options['help'];
        }
        if (isset($options['state'])) {
            $this->state = $options['state'];
        }
        if (isset($options['class'])) {
            $this->class = $options['class'];
        }

        return $this;
    }

    /**
     *
     * @param  string                             $image
     * @return \tkuska\RibbonBundle\Ribbon\Button
     */
    public function setImage($image)
    {
        $this->normal=$image;
        if (is_null($this->hot)) {
            $this->hot = $image;
        }
        if (is_null($this->disabled)) {
            $this->disabled = $image;
        }

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getImage()
    {
        return $this->normal;
    }

    /**
     *
     * @return string
     */
    public function getHot()
    {
        return $this->hot;
    }

    /**
     *
     * @return string
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    public function getHelp()
    {
        return $this->help;
    }

    /**
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->help;
    }

    /**
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @param  string                             $state
     * @return \tkuska\RibbonBundle\Ribbon\Button
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
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
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
     * @param  array                              $elementid
     * @return \tkuska\RibbonBundle\Ribbon\Button
     */
    public function setParameters(array $elementid = array())
    {
        $this->parameters = $elementid;

        return $this;
    }

    /**
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     *
     * @return \tkuska\RibbonBundle\Ribbon\Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     *
     * @param  \tkuska\RibbonBundle\Ribbon\Section $section
     * @return \tkuska\RibbonBundle\Ribbon\Button
     */
    public function setSection(Section $section)
    {
        $this->section = $section;

        return $this;
    }

}
