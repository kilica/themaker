<?php
/**
 * @file
 * @package themaker
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
    exit;
}

require_once THEMAKER_TRUST_PATH . '/class/AbstractAction.class.php';

/**
 * Themaker_Admin_IndexAction
**/
class Themaker_Admin_IndexAction extends Themaker_AbstractAction
{
    /**
     * getDefaultView
     *
     * @param    void
     *
     * @return    Enum
    **/
    public function getDefaultView()
    {
        return THEMAKER_FRAME_VIEW_SUCCESS;
    }

    /**
     * executeViewSuccess
     *
     * @param    XCube_RenderTarget    &$render
     *
     * @return    void
    **/
    public function executeViewSuccess(&$render)
    {
        $render->setTemplateName('admin.html');
        $render->setAttribute('adminMenu', $this->mModule->getAdminMenu());
    }
}

?>