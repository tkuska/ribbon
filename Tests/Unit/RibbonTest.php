<?php

namespace tkuska\RibbonBundle\Tests\Unit;

use \tkuska\RibbonBundle\Ribbon\Ribbon;


class RibbonTest extends \PHPUnit_Framework_TestCase
{
    
    public function testConstruct(){      
        $ribbon = new Ribbon('Wstążka');                  
        $this->assertEquals('Wstążka', $ribbon->getName());
        
        $ribbon->setName('Ribbon');        
        $this->assertEquals('Ribbon', $ribbon->getName());
        $this->assertFalse($ribbon->hasBackstage());
        $this->assertEmpty(0, $ribbon->getTabs()->count());
    }    
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\TabNotFoundException
     */
    public function testActiveTabException(){
        $ribbon = new Ribbon();
        
        $tab = new \tkuska\RibbonBundle\Ribbon\Tab('tab1', 'Tab1');
        $ribbon->addTab($tab);
        $ribbon->createTab('tab2', 'Tab2');
        
        $ribbon->setActiveTab('tab3');
    }
    
    public function testActiveTab(){
        $ribbon = new Ribbon();
        
        $tab = new \tkuska\RibbonBundle\Ribbon\Tab('tab1', 'Tab1');
        $ribbon->addTab($tab);
        $ribbon->createTab('tab2', 'Tab2');
        
        $ribbon->setActiveTab('tab1');
        
        $this->assertTrue($tab->isActive());
        
    }
    
    public function testGettingTabById(){
        $ribbon = new Ribbon();
        
        $tab = new \tkuska\RibbonBundle\Ribbon\Tab('tab1', 'Tab1');
        $ribbon->addTab($tab);
        $ribbon->createTab('tab2', 'Tab2');
        
        $ribbon->setActiveTab('tab1');
        
        $this->assertEquals($tab, $ribbon->getTabById('tab1'));
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\TabAlreadyExistsException
     */
    public function testDuplicateTabIdsException(){
        $ribbon = new Ribbon();
        
        $tab = new \tkuska\RibbonBundle\Ribbon\Tab('tab1', 'Tab1');        
        $tab2 = new \tkuska\RibbonBundle\Ribbon\Tab('tab1', 'Tab2');
        
        $ribbon->addTab($tab);
        $ribbon->addTab($tab2);                
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\TabAlreadyExistsException
     */
    public function testDuplicateTabIds2Exception(){
        $ribbon = new Ribbon();  
        
        $ribbon->createTab('tab3', 'Tab1');
        $ribbon->createTab('tab3', 'Tab2');               
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\TabNotFoundException
     */
    public function testTabNotFoundException(){
        $ribbon = new Ribbon();  
        
        $ribbon->createTab('tab1', 'Tab1');
        $ribbon->createTab('tab2', 'Tab2'); 
        
        $ribbon->getTabByName('tab3');
    }
    
    public function testAddTab(){
        $ribbon = new Ribbon();  
        
        $ribbon->createTab('tab1', 'Tab1');   
        $ribbon->createTab('tab2', 'Tab2');      
        $tab = new \tkuska\RibbonBundle\Ribbon\Tab('tab3', 'Tab3');  
        $ribbon->addTab($tab);
        
        $this->assertContains($tab, $ribbon->getTabs());
        $this->assertCount(3, $ribbon->getTabs());
        
    }
    
    public function testGetTabByName(){
        $ribbon = new Ribbon();  
        
        $ribbon->createTab('tab1', 'Tab1');
        
        $this->assertEquals($ribbon->getTabById('tab1'), $ribbon->getTabByName('tab1'));
    }
    
    /**
     * @expectedException tkuska\RibbonBundle\Exception\TabNotFoundException
     */
    public function testBackStageNotFoundException(){
        $ribbon = new Ribbon();
        
        $ribbon->getBackstage();
    }
    
    public function testBackstage(){
        $ribbon = new Ribbon();                  
        
        $this->assertFalse($ribbon->hasBackstage());
        
        $ribbon->setBackstage('Zaplecze');        
        $this->assertTrue($ribbon->hasBackstage());
        
        $this->assertEquals('Zaplecze', $ribbon->getBackstage()->getName());
        
    }
    
    public function testAddBackStageButton(){
        $ribbon = new Ribbon();
        
        $this->assertFalse($ribbon->hasBackstage());
        $ribbon->addBackstageButton('Backstage button');
        
        $this->assertTrue($ribbon->hasBackstage());
        
        $this->assertCount(1, $ribbon->getBackstage()->getButtons());
        
        $ribbon2 = new Ribbon();
        
        $ribbon2->setBackstage('Zaplecze');
        $ribbon2->addBackstageButton('Button');
        
        $this->assertEquals('Zaplecze', $ribbon2->getBackstage()->getName());
        
        
    }
}
