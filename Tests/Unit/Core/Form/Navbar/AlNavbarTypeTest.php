<?php
/*
 * This file is part of the TwitterBootstrapBundle and it is distributed
 * under the MIT LICENSE. To use this application you must leave intact this copyright 
 * notice.
 *
 * Copyright (c) RedKite Labs <info@redkite-labs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For extra documentation and help please visit http://www.redkite-labs.com
 * 
 * @license    MIT LICENSE
 * 
 */

namespace RedKiteCms\Block\TwitterBootstrapBundle\Tests\Unit\Core\Form\Navbar;

use RedKiteLabs\RedKiteCmsBundle\Tests\Unit\Core\Form\Base\AlBaseType;
use RedKiteCms\Block\TwitterBootstrapBundle\Core\Form\Navbar\AlNavbarType;

/**
 * AlNavbarDropdownTypeTest
 *
 * @author RedKite Labs <info@redkite-labs.com>
 */
class AlNavbarTypeTest extends AlBaseType
{
    protected function configureFields()
    {
        return array(
            array(
                'name' => 'position',
                'type' => 'choice',
                'options' => array('choices' => array("" => "normal", "navbar-fixed-top" => "fixed top", "navbar-fixed-bottom" => "fixed bottom", "navbar-static-top" => "static top")),
            ),
            array(
                'name' => 'inverted',
                'type' => 'choice',
                'options' => array('choices' => array("" => "normal", "navbar-inverse" => "inverted")),
            ),
            array(
                'name' => 'save', 
                'type' => 'submit', 
                'options' => array('attr' => array('class' => 'al_editor_save btn btn-primary')),
            ),
        );
    }
    
    protected function getForm()
    {
        return new AlNavbarType();
    }
    
    public function testDefaultOptions()
    {
        $this->setBaseResolver();

        $this->getForm()->setDefaultOptions($this->resolver);
    }
    
    public function testGetName()
    {
        $this->assertEquals('al_json_block', $this->getForm()->getName());
    }
}