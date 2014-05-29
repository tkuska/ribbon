<?php

namespace tkuska\RibbonBundle\Tests\Unit;

use \tkuska\RibbonBundle\Ribbon\Section;


class SectionTest extends \PHPUnit_Framework_TestCase
{    
    public function testSectionName(){
        $section = new Section('section');
        
        $this->assertEquals('section', $section->getName());
        
        $section->setName('New section');
        
        $this->assertEquals('New section', $section->getName());
    }
    
    public function testTab(){
        $tab = new \tkuska\RibbonBundle\Ribbon\Tab('tab', 'TAB');
        
        $section = new Section('section');
        $section->setTab($tab);
        
        $this->assertEquals($tab, $section->getTab());        
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\ElementNotFoundException
     */
    public function testButtonNotFound(){
        $section = new Section('section');
        
        $section->getButton('button');
    }
    
    public function testButton(){        
        $section = new Section('section');
        
        $section->createButton('button1');   
        $section->createButton('button2');      
        $button = new \tkuska\RibbonBundle\Ribbon\Button('button3');  
        $section->addButton($button);
        
        $this->assertContains($button, $section->getButtons());
        $this->assertCount(3, $section->getButtons());
        $this->assertEquals($button, $section->getButton('button3'));
        $this->assertEquals($button->getSection(), $section);
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\ElementAlreadyExistsException
     */
    public function testCreateButtonDuplicate(){        
        $section = new Section('section');
        
        $section->createButton('button1');   
        $section->createButton('button1');      
        
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\ElementAlreadyExistsException
     */
    public function testAddButtonDuplicate(){        
        $section = new Section('section', 'TAB');
        
        $button = new \tkuska\RibbonBundle\Ribbon\Button('button3');  
        $button2 = new \tkuska\RibbonBundle\Ribbon\Button('button3'); 
        $section->addButton($button);     
        $section->addButton($button2);    
    }
    
}
