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

/**
 * Themaker_SettingViewAction
**/
class Themaker_SettingViewAction extends Themaker_AbstractViewAction
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

        return true;
    }

    /**
     * executeViewSuccess
     *
     * @param    XCube_RenderTarget    &$render
     *
     * @return    void
    **/
    public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_setting_view.html');
        $render->setAttribute('object', $this->mObject);
        $render->setAttribute('dirname', $this->mAsset->mDirname);
        $render->setAttribute('dataname', self::DATANAME);

        //Enums
        $render->setAttribute('enum_htmlType', new Themaker_HTML_TYPE());
        $render->setAttribute('enum_layoutType', new Themaker_LAYOUT_TYPE());
        $render->setAttribute('enum_column', new Themaker_COLUMN());
        $render->setAttribute('enum_centerBlock', new Themaker_CENTER_BLOCK());
        $render->setAttribute('enum_float', new Themaker_FLOAT());

        //download file check
        $canDownload = (file_exists(THEMAKER_TRUST_PATH.'/download/theme_'.$this->mObject->getShow('setting_id').'.tar.gz')) ? true : false;
        $render->setAttribute('canDownload', $canDownload);
    }
}

?>
