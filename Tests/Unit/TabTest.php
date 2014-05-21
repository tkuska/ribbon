<?php

namespace tkuska\RibbonBundle\Tests\Unit;

use \tkuska\RibbonBundle\Ribbon\Tab;


class TabTest extends \PHPUnit_Framework_TestCase
{    
    public function testTabName(){
        $tab = new Tab('tab', 'TAB');
        
        $this->assertEquals('TAB', $tab->getName());
    }
    
    public function testTabActive(){
        $tab = new Tab('tab', 'TAB');
        
        $this->assertFalse($tab->isActive());    
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\ElementNotFoundException
     */
    public function testRibbonNotFoundException(){
        $tab = new Tab('tab', 'TAB');
        
        $tab->setActive();
    }
    
    public function testRibbon(){
        $ribbon = new \tkuska\RibbonBundle\Ribbon\Ribbon();
        
        $tab = new Tab('tab', 'TAB');
        $tab->setRibbon($ribbon);
        $ribbon2 = $tab->getRibbon();
        
        $this->assertEquals($ribbon, $ribbon2);
        $this->assertCount(0, $ribbon->getTabs());
        
    }
    
    public function testChangingActiveTab(){
        $ribbon = new \tkuska\RibbonBundle\Ribbon\Ribbon();
        
        $tab = new Tab('tab', 'TAB');
        $tab2 = new Tab('tab2', 'TAB');
        $tab3 = new Tab('tab3', 'TAB');
        $ribbon->addTab($tab);
        $tab->setActive();
        $ribbon->addTab($tab2);
        $ribbon->addTab($tab3);
                
        $this->assertTrue($tab->isActive());
        $this->assertFalse($tab2->isActive());
        $this->assertFalse($tab3->isActive());
        
        $tab3->setActive();        
        
        $this->assertFalse($tab->isActive());
        $this->assertFalse($tab2->isActive());
        $this->assertTrue($tab3->isActive());        
    }
    
    public function testIndex(){
        $tab = new Tab('tab', 'TAB');
        
        $tab->setIndex(3);
        
        $this->assertEquals(3, $tab->getIndex());
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\ElementNotFoundException
     */
    public function testSectionNotFound(){
        $tab = new Tab('tab', 'TAB');
        
        $tab->getSection('section');
    }
    
    public function testSection(){        
        $tab = new Tab('tab', 'TAB');
        
        $tab->createSection('section1');   
        $tab->createSection('section2');      
        $section = new \tkuska\RibbonBundle\Ribbon\Section('section3');  
        $tab->addSection($section);
        
        $this->assertContains($section, $tab->getSections());
        $this->assertCount(3, $tab->getSections());
        $this->assertEquals($section, $tab->getSection('section3'));
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\ElementAlreadyExistsException
     */
    public function testCreateSectionDuplicate(){        
        $tab = new Tab('tab', 'TAB');
        
        $tab->createSection('section1');   
        $tab->createSection('section1');      
        
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\ElementAlreadyExistsException
     */
    public function testAddSectionDuplicate(){        
        $tab = new Tab('tab', 'TAB');
        
        $section = new \tkuska\RibbonBundle\Ribbon\Section('section3');  
        $section2 = new \tkuska\RibbonBundle\Ribbon\Section('section3'); 
        $tab->addSection($section);     
        $tab->addSection($section2);    
    }
    
    public function testRoute(){        
        $tab = new Tab('tab', 'TAB');
        
        $tab->setRoute('test');
        
        $this->assertEquals('test', $tab->getRoute());
    }
}
