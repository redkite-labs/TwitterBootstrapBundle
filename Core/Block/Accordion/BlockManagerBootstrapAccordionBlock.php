<?php
/*
 * This file is part of the RedKite CMS Application and it is distributed
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

namespace RedKiteLabs\RedKiteCms\TwitterBootstrapBundle\Core\Block\Accordion;

use RedKiteLabs\RedKiteCms\RedKiteCmsBundle\Core\Content\Block\JsonBlock\BlockManagerJsonBlockCollection;

/**
 * Defines the Block Manager to handle a Bootstrap Accordion
 *
 * @author RedKite Labs <info@redkite-labs.com>
 */
class BlockManagerBootstrapAccordionBlock extends BlockManagerJsonBlockCollection
{
    /**
     * Defines the App-Block's default value
     *
     * @return array
     */
    public function getDefaultValue()
    {
        $value = '
            {
                "0" : {
                    "type": "BootstrapAccordionPanelBlock"
                },
                "1" : {
                    "type": "BootstrapAccordionPanelBlock"
                }
            }';

        return array('Content' => $value);
    }

    /**
     * Renders the App-Block's content view
     *
     * @return string|array
     */
    protected function renderHtml()
    {
        $items = $this->decodeJsonContent($this->alBlock->getContent());
        $bootstrapVersion = $this->container->get('red_kite_cms.active_theme')->getThemeBootstrapVersion();
        $template = sprintf('TwitterBootstrapBundle:Content:Accordion/%s/accordion.html.twig', $bootstrapVersion);

        return array('RenderView' => array(
            'view' => $template,
            'options' => array('items' => $items),
        ));
    }
}
