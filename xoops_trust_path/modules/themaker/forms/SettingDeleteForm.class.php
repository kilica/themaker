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

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Themaker_SettingDeleteForm
**/
class Themaker_SettingDeleteForm extends XCube_ActionForm
{
    /**
     * getTokenName
     * 
     * @param   void
     * 
     * @return  string
    **/
    public function getTokenName()
    {
        return "module.themaker.SettingDeleteForm.TOKEN";
    }

    /**
     * prepare
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function prepare()
    {
        //
        // Set form properties
        //
        $this->mFormProperties['setting_id'] = new XCube_IntProperty('setting_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['setting_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['setting_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['setting_id']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_SETTING_ID);
    }

    /**
     * load
     * 
     * @param   XoopsSimpleObject  &$obj
     * 
     * @return  void
    **/
    public function load(/*** XoopsSimpleObject ***/ &$obj)
    {
        $this->set('setting_id', $obj->get('setting_id'));
    }

    /**
     * update
     * 
     * @param   XoopsSimpleObject  &$obj
     * 
     * @return  void
    **/
    public function update(/*** XoopsSimpleObject ***/ &$obj)
    {
        $obj->set('setting_id', $this->get('setting_id'));
    }
}

?>
