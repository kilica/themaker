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
 * Themaker_SettingEditForm
**/
class Themaker_SettingEditForm extends XCube_ActionForm
{
    /**
     * getTokenName
     *
     * @param    void
     *
     * @return    string
    **/
    public function getTokenName()
    {
        return "module.themaker.SettingEditForm.TOKEN";
    }

    /**
     * prepare
     *
     * @param    void
     *
     * @return    void
    **/
    public function prepare()
    {
        //
        // Set form properties
        //
        $this->mFormProperties['setting_id'] = new XCube_IntProperty('setting_id');
        $this->mFormProperties['title'] = new XCube_StringProperty('title');
        $this->mFormProperties['uid'] = new XCube_IntProperty('uid');
        $this->mFormProperties['html_type'] = new XCube_StringProperty('html_type');
        $this->mFormProperties['layout_type'] = new XCube_IntProperty('layout_type');
        $this->mFormProperties['toppage_col'] = new XCube_IntProperty('toppage_col');
        $this->mFormProperties['subpage_col'] = new XCube_IntProperty('subpage_col');
        $this->mFormProperties['center_block'] = new XCube_IntProperty('center_block');
        $this->mFormProperties['site_width'] = new XCube_IntProperty('site_width');
        $this->mFormProperties['content_width'] = new XCube_IntProperty('content_width');
        $this->mFormProperties['left_width'] = new XCube_IntProperty('left_width');
        $this->mFormProperties['right_width'] = new XCube_IntProperty('right_width');
        $this->mFormProperties['color_pattern'] = new XCube_StringProperty('color_pattern');
        $this->mFormProperties['left_float'] = new XCube_IntProperty('left_float');
        $this->mFormProperties['color_scheme'] = new XCube_TextProperty('color_scheme');
        $this->mFormProperties['description'] = new XCube_TextProperty('description');
        $this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');
        $this->mFormProperties['tags'] = new XCube_TextProperty('tags');


        //
        // Set field properties
        //
       $this->mFieldProperties['setting_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['setting_id']->setDependsByArray(array('required'));
$this->mFieldProperties['setting_id']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_SETTING_ID);
       $this->mFieldProperties['title'] = new XCube_FieldProperty($this);
       $this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
       $this->mFieldProperties['title']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_TITLE);
       $this->mFieldProperties['title']->addMessage('maxlength', _MD_THEMAKER_ERROR_MAXLENGTH, _MD_THEMAKER_LANG_TITLE, '255');
       $this->mFieldProperties['title']->addVar('maxlength', '255');
       $this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
       $this->mFieldProperties['layout_type'] = new XCube_FieldProperty($this);
$this->mFieldProperties['layout_type']->setDependsByArray(array('required'));
$this->mFieldProperties['layout_type']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_LAYOUT_TYPE);
       $this->mFieldProperties['toppage_col'] = new XCube_FieldProperty($this);
$this->mFieldProperties['toppage_col']->setDependsByArray(array('required'));
$this->mFieldProperties['toppage_col']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_TOPPAGE_COL);
       $this->mFieldProperties['subpage_col'] = new XCube_FieldProperty($this);
$this->mFieldProperties['subpage_col']->setDependsByArray(array('required'));
$this->mFieldProperties['subpage_col']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_SUBPAGE_COL);
       $this->mFieldProperties['center_block'] = new XCube_FieldProperty($this);
$this->mFieldProperties['center_block']->setDependsByArray(array('required'));
$this->mFieldProperties['center_block']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_CENTER_BLOCK);
       $this->mFieldProperties['site_width'] = new XCube_FieldProperty($this);
$this->mFieldProperties['site_width']->setDependsByArray(array('required'));
$this->mFieldProperties['site_width']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_SITE_WIDTH);
       $this->mFieldProperties['content_width'] = new XCube_FieldProperty($this);
$this->mFieldProperties['content_width']->setDependsByArray(array('required'));
$this->mFieldProperties['content_width']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_CONTENT_WIDTH);
       $this->mFieldProperties['left_width'] = new XCube_FieldProperty($this);
$this->mFieldProperties['left_width']->setDependsByArray(array('required'));
$this->mFieldProperties['left_width']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_LEFT_WIDTH);
       $this->mFieldProperties['right_width'] = new XCube_FieldProperty($this);
$this->mFieldProperties['right_width']->setDependsByArray(array('required'));
$this->mFieldProperties['right_width']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_RIGHT_WIDTH);
       $this->mFieldProperties['color_pattern'] = new XCube_FieldProperty($this);
$this->mFieldProperties['color_pattern']->setDependsByArray(array('required'));
$this->mFieldProperties['color_pattern']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_COLOR_PATTERN);
       $this->mFieldProperties['left_float'] = new XCube_FieldProperty($this);
$this->mFieldProperties['left_float']->setDependsByArray(array('required'));
$this->mFieldProperties['left_float']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_LEFT_FLOAT);
       $this->mFieldProperties['color_scheme'] = new XCube_FieldProperty($this);
       $this->mFieldProperties['color_scheme']->setDependsByArray(array('required'));
       $this->mFieldProperties['color_scheme']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_COLOR_SCHEME);
       $this->mFieldProperties['description'] = new XCube_FieldProperty($this);
       $this->mFieldProperties['description']->setDependsByArray(array('required'));
       $this->mFieldProperties['description']->addMessage('required', _MD_THEMAKER_ERROR_REQUIRED, _MD_THEMAKER_LANG_DESCRIPTION);
       $this->mFieldProperties['posttime'] = new XCube_FieldProperty($this);
    }

    /**
     * load
     *
     * @param    XoopsSimpleObject  &$obj
     *
     * @return    void
    **/
    public function load(/*** XoopsSimpleObject ***/ &$obj)
    {
        $this->set('setting_id', $obj->get('setting_id'));
        $this->set('title', $obj->get('title'));
        $this->set('uid', $obj->get('uid'));
        $this->set('html_type', $obj->get('html_type'));
        $this->set('layout_type', $obj->get('layout_type'));
        $this->set('toppage_col', $obj->get('toppage_col'));
        $this->set('subpage_col', $obj->get('subpage_col'));
        $this->set('center_block', $obj->get('center_block'));
        $this->set('site_width', $obj->get('site_width'));
        $this->set('content_width', $obj->get('content_width'));
        $this->set('left_width', $obj->get('left_width'));
        $this->set('right_width', $obj->get('right_width'));
        $this->set('color_pattern', $obj->get('color_pattern'));
        $this->set('left_float', $obj->get('left_float'));
        $this->set('color_scheme', $obj->get('color_scheme'));
        $this->set('description', $obj->get('description'));
        $this->set('posttime', $obj->get('posttime'));
      $tags = is_array($obj->mTag) ? implode(' ', $obj->mTag) : null;
        if(count($obj->mTag)>0) $tags = $tags.' ';
        $this->set('tags', $tags);
    }

    /**
     * update
     *
     * @param    XoopsSimpleObject  &$obj
     *
     * @return    void
    **/
    public function update(/*** XoopsSimpleObject ***/ &$obj)
    {
        $obj->set('title', $this->get('title'));
        $obj->set('html_type', $this->_getHtmlType());
        $obj->set('layout_type', $this->get('layout_type'));
        $obj->set('toppage_col', $this->get('toppage_col'));
        $obj->set('subpage_col', $this->get('subpage_col'));
        $obj->set('center_block', $this->get('center_block'));
        $obj->set('site_width', $this->get('site_width'));
        $obj->set('content_width', $this->get('content_width'));
        $obj->set('left_width', $this->get('left_width'));
        $obj->set('right_width', $this->get('right_width'));
        $obj->set('color_pattern', $this->get('color_pattern'));
        $obj->set('left_float', $this->get('left_float'));
        $obj->set('color_scheme', $this->get('color_scheme'));
        $obj->set('description', $this->get('description'));
        $obj->mTag = explode(' ', trim($this->get('tags')));
    }

    protected function _getHtmlType()
    {
        $layout = $this->get('layout_type');
        switch($layout){
            case Themaker_LAYOUT_TYPE::FIXEDGRID960:
                $ret = Themaker_HTML_TYPE::XHTML;
                break;
            case Themaker_LAYOUT_TYPE::TWBOOTSTRAP:
                $ret = Themaker_HTML_TYPE::HTML5;
                break;
        }
        return $ret;
    }

    /**
     * _makeUnixtime
     *
     * @param    string    $key
     *
     * @return    void
    **/
    protected function _makeUnixtime($key)
    {
        $timeArray = explode('-', $this->get($key));
        return mktime(0, 0, 0, $timeArray[1], $timeArray[2], $timeArray[0]);
    }
}

?>
