<?php

namespace tkuska\RibbonBundle\Tests\Unit;

use \tkuska\RibbonBundle\Ribbon\Button;


class ButtonTest extends \PHPUnit_Framework_TestCase
{
    
    public function testCreateButton(){
        $button = new Button('button', array(
            'image' => 'path/to/image',
            'disabled' => 'path/to/disable',
            'hot' => 'path/to/hot',
            'route' => 'route name',
            'help' => 'button descriotion',
            'state' => Button::STATE_NORMAL,
            'class' => 'button-class',
            'type'  => Button::TYPE_SMALL,
            'id'    => 'button1'
        ));
        
       $this->assertEquals('path/to/image', $button->getImage());
       $this->assertEquals('path/to/disable', $button->getDisabled());
       $this->assertEquals('path/to/hot', $button->getHot());
       $this->assertEquals('route name', $button->getRoute());
       $this->assertEquals('button descriotion', $button->getHelp());
       $this->assertEquals(Button::STATE_NORMAL, $button->getState());
       $this->assertEquals('button-class', $button->getClass());  
       $this->assertEquals(Button::TYPE_SMALL, $button->getType());
       $this->assertEquals('button1', $button->getId());
       
       $button->setId('button3');
       $button->setState(Button::STATE_HOT);
       $button->setClass('new-class');       
       
       $this->assertEquals('button3', $button->getId());
       $this->assertEquals('new-class', $button->getClass());
       $this->assertEquals(Button::STATE_HOT, $button->getState());
       $params = array('elementid' => 1, 'element2' => 'test');
       $button->setParameters($params);
       
       $this->assertEquals($params, $button->getParameters());
    }
}
