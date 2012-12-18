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

require_once THEMAKER_TRUST_PATH . '/class/AbstractFilterForm.class.php';

define('THEMAKER_SETTING_SORT_KEY_SETTING_ID', 1);
define('THEMAKER_SETTING_SORT_KEY_TITLE', 2);
define('THEMAKER_SETTING_SORT_KEY_UID', 3);
define('THEMAKER_SETTING_SORT_KEY_HTML_TYPE', 4);
define('THEMAKER_SETTING_SORT_KEY_LAYOUT_TYPE', 5);
define('THEMAKER_SETTING_SORT_KEY_TOPPAGE_COL', 6);
define('THEMAKER_SETTING_SORT_KEY_SUBPAGE_COL', 7);
define('THEMAKER_SETTING_SORT_KEY_CENTER_BLOCK', 8);
define('THEMAKER_SETTING_SORT_KEY_SITE_WIDTH', 9);
define('THEMAKER_SETTING_SORT_KEY_CONTENT_WIDTH', 10);
define('THEMAKER_SETTING_SORT_KEY_LEFT_WIDTH', 11);
define('THEMAKER_SETTING_SORT_KEY_RIGHT_WIDTH', 12);
define('THEMAKER_SETTING_SORT_KEY_COLOR_PATTERN', 13);
define('THEMAKER_SETTING_SORT_KEY_LEFT_FLOAT', 14);
define('THEMAKER_SETTING_SORT_KEY_COLOR_SCHEME', 15);
define('THEMAKER_SETTING_SORT_KEY_DESCRIPTION', 16);
define('THEMAKER_SETTING_SORT_KEY_POSTTIME', 17);

define('THEMAKER_SETTING_SORT_KEY_DEFAULT', THEMAKER_SETTING_SORT_KEY_SETTING_ID);

/**
 * Themaker_SettingFilterForm
**/
class Themaker_SettingFilterForm extends Themaker_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
        THEMAKER_SETTING_SORT_KEY_SETTING_ID => 'setting_id',
        THEMAKER_SETTING_SORT_KEY_TITLE => 'title',
        THEMAKER_SETTING_SORT_KEY_UID => 'uid',
        THEMAKER_SETTING_SORT_KEY_HTML_TYPE => 'html_type',
        THEMAKER_SETTING_SORT_KEY_LAYOUT_TYPE => 'layout_type',
        THEMAKER_SETTING_SORT_KEY_TOPPAGE_COL => 'toppage_col',
        THEMAKER_SETTING_SORT_KEY_SUBPAGE_COL => 'subpage_col',
        THEMAKER_SETTING_SORT_KEY_CENTER_BLOCK => 'center_block',
        THEMAKER_SETTING_SORT_KEY_SITE_WIDTH => 'site_width',
        THEMAKER_SETTING_SORT_KEY_CONTENT_WIDTH => 'content_width',
        THEMAKER_SETTING_SORT_KEY_LEFT_WIDTH => 'left_width',
        THEMAKER_SETTING_SORT_KEY_RIGHT_WIDTH => 'right_width',
        THEMAKER_SETTING_SORT_KEY_COLOR_PATTERN => 'color_pattern',
        THEMAKER_SETTING_SORT_KEY_LEFT_FLOAT => 'left_float',
        THEMAKER_SETTING_SORT_KEY_COLOR_SCHEME => 'color_scheme',
        THEMAKER_SETTING_SORT_KEY_DESCRIPTION => 'description',
        THEMAKER_SETTING_SORT_KEY_POSTTIME => 'posttime',

    );

    /**
     * getDefaultSortKey
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function getDefaultSortKey()
    {
        return THEMAKER_SETTING_SORT_KEY_DEFAULT;
    }

    /**
     * fetch
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function fetch()
    {
        parent::fetch();
    
        $root =& XCube_Root::getSingleton();
    
        if (($value = $root->mContext->mRequest->getRequest('setting_id')) !== null) {
            $this->mNavi->addExtra('setting_id', $value);
            $this->_mCriteria->add(new Criteria('setting_id', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
            $this->mNavi->addExtra('title', $value);
            $this->_mCriteria->add(new Criteria('title', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
            $this->mNavi->addExtra('uid', $value);
            $this->_mCriteria->add(new Criteria('uid', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('html_type')) !== null) {
            $this->mNavi->addExtra('html_type', $value);
            $this->_mCriteria->add(new Criteria('html_type', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('layout_type')) !== null) {
            $this->mNavi->addExtra('layout_type', $value);
            $this->_mCriteria->add(new Criteria('layout_type', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('toppage_col')) !== null) {
            $this->mNavi->addExtra('toppage_col', $value);
            $this->_mCriteria->add(new Criteria('toppage_col', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('subpage_col')) !== null) {
            $this->mNavi->addExtra('subpage_col', $value);
            $this->_mCriteria->add(new Criteria('subpage_col', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('center_block')) !== null) {
            $this->mNavi->addExtra('center_block', $value);
            $this->_mCriteria->add(new Criteria('center_block', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('site_width')) !== null) {
            $this->mNavi->addExtra('site_width', $value);
            $this->_mCriteria->add(new Criteria('site_width', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('content_width')) !== null) {
            $this->mNavi->addExtra('content_width', $value);
            $this->_mCriteria->add(new Criteria('content_width', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('left_width')) !== null) {
            $this->mNavi->addExtra('left_width', $value);
            $this->_mCriteria->add(new Criteria('left_width', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('right_width')) !== null) {
            $this->mNavi->addExtra('right_width', $value);
            $this->_mCriteria->add(new Criteria('right_width', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('color_pattern')) !== null) {
            $this->mNavi->addExtra('color_pattern', $value);
            $this->_mCriteria->add(new Criteria('color_pattern', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('left_float')) !== null) {
            $this->mNavi->addExtra('left_float', $value);
            $this->_mCriteria->add(new Criteria('left_float', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('color_scheme')) !== null) {
            $this->mNavi->addExtra('color_scheme', $value);
            $this->_mCriteria->add(new Criteria('color_scheme', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('description')) !== null) {
            $this->mNavi->addExtra('description', $value);
            $this->_mCriteria->add(new Criteria('description', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
            $this->mNavi->addExtra('posttime', $value);
            $this->_mCriteria->add(new Criteria('posttime', $value));
        }

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
