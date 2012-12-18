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

require_once THEMAKER_TRUST_PATH . '/class/AbstractEditAction.class.php';
require_once THEMAKER_TRUST_PATH . '/class/Themaker.class.php';

/**
 * Themaker_SettingEditAction
**/
class Themaker_SettingEditAction extends Themaker_AbstractEditAction
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
     * @param   void
     * 
     * @return  bool
    **/
    public function prepare()
    {
        parent::prepare();
        if($this->mObject->isNew()){
            if($this->mRoot->mContext->mUser->isInRole('Site.RegisteredUser')){
                $this->mObject->set('uid', $this->mRoot->mContext->mXoopsUser->get('uid'));
            }
            $this->mObject->set('color_scheme', '<palette>
<url>http://colorschemedesigner.com/#3C51Kw0w0w0w0</url>
<colorspace>RGB;</colorspace>
<colorset id="primary" title="Primary Color">
<color id="primary-1" nr="1" rgb="0E53A7" r="14" g="83" b="167"/>
<color id="primary-2" nr="2" rgb="274E7D" r="39" g="78" b="125"/>
<color id="primary-3" nr="3" rgb="04346C" r="4" g="52" b="108"/>
<color id="primary-4" nr="4" rgb="4284D3" r="66" g="132" b="211"/>
<color id="primary-5" nr="5" rgb="6899D3" r="104" g="153" b="211"/>
</colorset>
<colorset id="secondary-a" title="Secondary Color A">
<color id="secondary-a-1" nr="1" rgb="1924B1" r="25" g="36" b="177"/>
<color id="secondary-a-2" nr="2" rgb="2F3584" r="47" g="53" b="132"/>
<color id="secondary-a-3" nr="3" rgb="081073" r="8" g="16" b="115"/>
<color id="secondary-a-4" nr="4" rgb="4C57D8" r="76" g="87" b="216"/>
<color id="secondary-a-5" nr="5" rgb="7279D8" r="114" g="121" b="216"/>
</colorset>
<colorset id="secondary-b" title="Secondary Color B">
<color id="secondary-b-1" nr="1" rgb="009999" r="0" g="153" b="153"/>
<color id="secondary-b-2" nr="2" rgb="1D7373" r="29" g="115" b="115"/>
<color id="secondary-b-3" nr="3" rgb="006363" r="0" g="99" b="99"/>
<color id="secondary-b-4" nr="4" rgb="33CCCC" r="51" g="204" b="204"/>
<color id="secondary-b-5" nr="5" rgb="5CCCCC" r="92" g="204" b="204"/>
</colorset>
</palette>');
        }
    
        return true;
    }

/*
$("#legacy_xoopsform_html_type").bind("change", function(){
htmlType = jQuery("#legacy_xoopsform_html_type :selected").val();
jQuery("#legacy_xoopsform_html_type").append(jQuery("<option value="1">test1</option>"));
});
*/

    /**
     * executeViewInput
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_setting_edit.html');
        $render->setAttribute('actionForm', $this->mActionForm);
        $render->setAttribute('object', $this->mObject);
        $render->setAttribute('dirname', $this->mAsset->mDirname);
        $render->setAttribute('dataname', self::DATANAME);

        //Enums
        $render->setAttribute('enum_htmlType', new Themaker_HTML_TYPE());
        $render->setAttribute('enum_layoutType', new Themaker_LAYOUT_TYPE());
        $render->setAttribute('enum_column', new Themaker_COLUMN());
        $render->setAttribute('enum_centerBlock', new Themaker_CENTER_BLOCK());
        $render->setAttribute('enum_float', new Themaker_FLOAT());

        //Color Pattern list
        require_once XOOPS_LIBRARY_PATH.'/GdataSpreadsheet.class.php';
        $spreadsheet = new Legacy_Gdata_Spreadsheets();
        $worksheets = $spreadsheet->getWorksheetList($this->mModule->getModuleConfig('spreadsheet_key'));
        $render->setAttribute('worksheetList', $worksheets);

        //set tag usage
        $render->setAttribute('tag_dirname', $this->mRoot->mContext->mModuleConfig['tag_dirname']);
        $enum_htmlType = new Themaker_HTML_TYPE();
  }

    protected function _doExecute()
    {
        $ret = parent::_doExecute();
        $generator = new Themaker($this->mObject);
        $generator->generate();
        return $ret;
    }

}
?>
