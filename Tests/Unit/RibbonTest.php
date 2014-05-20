<?php

namespace tkuska\RibbonBundle\Tests\Unit;

use \tkuska\RibbonBundle\Ribbon\Ribbon;


class RibbonTest extends \PHPUnit_Framework_TestCase
{
    
    public function testName(){
        $ribbon = new Ribbon('Main menu');  
        
        $this->assertEquals($ribbon->getName(), 'Main menu');
        $this->assertFalse($ribbon->hasBackstage());
        $this->assertEmpty($ribbon->getTabs());
    }    
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testActiveTabException(){
        $ribbon = new Ribbon();
        
        $tab = new \tkuska\RibbonBundle\Ribbon\Tab('tab1', 'Tab1');
        $ribbon->addTab($tab);
        $ribbon->createTab('tab2', 'Tab2');
        
        $ribbon->setActiveTab('tab3');
    }
    
}
