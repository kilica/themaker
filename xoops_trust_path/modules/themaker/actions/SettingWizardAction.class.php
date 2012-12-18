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

require_once THEMAKER_TRUST_PATH . '/class/AbstractViewAction.class.php';
require_once THEMAKER_TRUST_PATH . '/class/Themaker.class.php';

/**
 * Themaker_SettingWizardAction
**/
class Themaker_SettingWizardAction extends Themaker_AbstractViewAction
{
    const DATANAME = 'setting';

    /**
     * prepare
     *
     * @param    void
     *
     * @return    bool
    **/
    public function prepare()
    {
        parent::prepare();
        $generator = new Themaker($this->mObject);
        $generator->generate();

        return true;
    }

    /**
     * executeViewSuccess
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
    {
        $this->mRoot->mController->executeRedirect($this->_getNextUri($this->_getConst('DATANAME')), 1, _MD_THEMAKER_MESSAGE_THEME_GENERATED);
    }
}

?>
