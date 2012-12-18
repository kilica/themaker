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

require_once THEMAKER_TRUST_PATH . '/class/AbstractListAction.class.php';

/**
 * Themaker_SettingListAction
**/
class Themaker_SettingListAction extends Themaker_AbstractListAction
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
     * executeViewIndex
     *
     * @param    XCube_RenderTarget    &$render
     *
     * @return    void
    **/
    public function executeViewIndex(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_setting_list.html');
        $render->setAttribute('objects', $this->mObjects);
        $render->setAttribute('dirname', $this->mAsset->mDirname);
        $render->setAttribute('dataname', self::DATANAME);
        $render->setAttribute('pageNavi', $this->mFilter->mNavi);

        //Enums
        $render->setAttribute('enum_htmlType', new Themaker_HTML_TYPE());
        $render->setAttribute('enum_layoutType', new Themaker_LAYOUT_TYPE());
        $render->setAttribute('enum_column', new Themaker_COLUMN());
        $render->setAttribute('enum_centerBlock', new Themaker_CENTER_BLOCK());
        $render->setAttribute('enum_float', new Themaker_FLOAT());
    }
}

?>
