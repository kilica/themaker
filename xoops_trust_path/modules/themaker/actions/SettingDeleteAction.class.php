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

require_once THEMAKER_TRUST_PATH . '/class/AbstractDeleteAction.class.php';

/**
 * Themaker_SettingDeleteAction
**/
class Themaker_SettingDeleteAction extends Themaker_AbstractDeleteAction
{
    const DATANAME = 'setting';



    /**
     * hasPermission
     *
     * @param    void
     *
     * @return    bool
    **/
    public function hasPermission()
    {
        return $this->mRoot->mContext->mUser->isInRole('Site.RegisteredUser') ? true : false;
    }

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

        return true;
    }

    /**
     * executeViewInput
     *
     * @param    XCube_RenderTarget    &$render
     *
     * @return    void
    **/
    public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_setting_delete.html');
        $render->setAttribute('actionForm', $this->mActionForm);
        $render->setAttribute('object', $this->mObject);
    }
}

?>
