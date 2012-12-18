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

/**
 * Themaker_SettingObject
**/
class Themaker_SettingObject extends Legacy_AbstractObject
{
    const PRIMARY = 'setting_id';
    const DATANAME = 'setting';

    /**
     * __construct
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function __construct()
    {
        parent::__construct();  
        $this->initVar('setting_id', XOBJ_DTYPE_INT, '', false);
        $this->initVar('title', XOBJ_DTYPE_STRING, '', false, 255);
        $this->initVar('uid', XOBJ_DTYPE_INT, '', false);
        $this->initVar('html_type', XOBJ_DTYPE_STRING, '', false, 32);
        $this->initVar('layout_type', XOBJ_DTYPE_INT, '', false);
        $this->initVar('toppage_col', XOBJ_DTYPE_INT, '', false);
        $this->initVar('subpage_col', XOBJ_DTYPE_INT, '', false);
        $this->initVar('center_block', XOBJ_DTYPE_INT, '', false);
        $this->initVar('site_width', XOBJ_DTYPE_INT, '', false);
        $this->initVar('content_width', XOBJ_DTYPE_INT, '', false);
        $this->initVar('left_width', XOBJ_DTYPE_INT, '', false);
        $this->initVar('right_width', XOBJ_DTYPE_INT, '', false);
        $this->initVar('color_pattern', XOBJ_DTYPE_STRING, '', false, 30);
        $this->initVar('left_float', XOBJ_DTYPE_INT, '', false);
        $this->initVar('color_scheme', XOBJ_DTYPE_TEXT, '', false);
        $this->initVar('description', XOBJ_DTYPE_TEXT, '', false);
        $this->initVar('posttime', XOBJ_DTYPE_INT, time(), false);
   }

    /**
     * getShowStatus
     * 
     * @param   void
     * 
     * @return  string
    **/
    public function getShowStatus()
    {
        switch($this->get('status')){
            case Lenum_Status::DELETED:
                return _MD_LEGACY_STATUS_DELETED;
            case Lenum_Status::REJECTED:
                return _MD_LEGACY_STATUS_REJECTED;
            case Lenum_Status::POSTED:
                return _MD_LEGACY_STATUS_POSTED;
            case Lenum_Status::PUBLISHED:
                return _MD_LEGACY_STATUS_PUBLISHED;
        }
    }

    public function getImageNumber()
    {
        return 0;
    }

}

/**
 * Themaker_SettingHandler
**/
class Themaker_SettingHandler extends Legacy_AbstractClientObjectHandler
{
    public /*** string ***/ $mTable = '{dirname}_setting';
    public /*** string ***/ $mPrimary = 'setting_id';
    public /*** string ***/ $mClass = 'Themaker_SettingObject';

    /**
     * __construct
     * 
     * @param   XoopsDatabase  &$db
     * @param   string  $dirname
     * 
     * @return  void
    **/
    public function __construct(/*** XoopsDatabase ***/ &$db,/*** string ***/ $dirname)
    {
        $this->mTable = strtr($this->mTable,array('{dirname}' => $dirname));
        parent::XoopsObjectGenericHandler($db);
    }

}

?>
