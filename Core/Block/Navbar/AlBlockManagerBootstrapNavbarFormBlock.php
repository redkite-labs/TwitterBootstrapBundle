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

namespace RedKiteCms\Block\TwitterBootstrapBundle\Core\Block\Navbar;

use RedKiteCms\Block\TwitterBootstrapBundle\Core\Block\Button\AlBlockManagerBootstrapButtonBlock;
use Symfony\Component\DependencyInjection\ContainerInterface;
use RedKiteLabs\RedKiteCmsBundle\Core\Content\Validator\AlParametersValidatorInterface;

/**
 * Defines the Block Manager to handle a Bootstrap navbar button
 *
 * @author RedKite Labs <info@redkite-labs.com>
 */
class AlBlockManagerBootstrapNavbarFormBlock extends AlBlockManagerBootstrapButtonBlock
{
    private $bootstrapVersion;
    
    public function __construct(ContainerInterface $container, AlParametersValidatorInterface $validator = null)
    {
        parent::__construct($container, $validator);
        
        $this->bootstrapVersion = $this->container->get('red_kite_cms.active_theme')->getThemeBootstrapVersion(); 
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDefaultValue()
    {
        $alignment = 'navbar-left';
        if($this->bootstrapVersion == '2.x') {
            $alignment = 'pull-left';
        }
        $value = '
            {
                "0" : {
                    "method": "POST",
                    "action": "#",
                    "enctype": "",
                    "placeholder": "Search",
                    "role": "Search",
                    "button_text": "Go",
                    "alignment": "' . $alignment . '"
                }
            }
        ';
        
        return array('Content' => $value);
    }
    
    /**
     * {@inheritdoc}
     */
    protected function renderHtml()
    {
        $data = $this->decodeJsonContent($this->alBlock->getContent());
        
        $template = sprintf('TwitterBootstrapBundle:Content:Navbar/Form/%s/navbar_form.html.twig', $this->bootstrapVersion);
        
        return array('RenderView' => array(
            'view' => $template,
            'options' => array(
                'data' => $data[0], 
            ),
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function editorParameters()
    {
        $items = $this->decodeJsonContent($this->alBlock->getContent());
        
        $bootstrapFormFactory = $this->container->get('twitter_bootstrap.bootstrap_form_factory');
        $form = $bootstrapFormFactory->createForm('Navbar\Form', 'AlNavbarFormType', $items[0]);
        
        return array(
            "template" => "TwitterBootstrapBundle:Editor:Navbar/Form/navbar_form_editor.html.twig",
            "title" => "Navbar form editor",
            "form" => $form->createView(),
        );
    }
}