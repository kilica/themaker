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

if(!defined('THEMAKER_TRUST_PATH'))
{
    define('THEMAKER_TRUST_PATH',XOOPS_TRUST_PATH . '/modules/themaker');
}

require_once THEMAKER_TRUST_PATH . '/class/ThemakerUtils.class.php';
require_once THEMAKER_TRUST_PATH . '/class/Enum.class.php';

/**
 * Themaker_AssetPreloadBase
**/
class Themaker_AssetPreloadBase extends XCube_ActionFilter
{
    public $mDirname = null;

    /**
     * prepare
     * 
     * @param   string  $dirname
     * 
     * @return  void
    **/
    public static function prepare(/*** string ***/ $dirname)
    {
        static $setupCompleted = false;
        if(!$setupCompleted)
        {
            $setupCompleted = self::_setup($dirname);
        }
    }

    /**
     * _setup
     * 
     * @param   void
     * 
     * @return  bool
    **/
    public static function _setup(/*** string ***/ $dirname)
    {
        $root =& XCube_Root::getSingleton();
        $instance = new self($root->mController);
        $instance->mDirname = $dirname;
        $root->mController->addActionFilter($instance);
        return true;
    }

    /**
     * preBlockFilter
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function preBlockFilter()
    {
        $file = THEMAKER_TRUST_PATH . '/class/callback/DelegateFunctions.class.php';
        $this->mRoot->mDelegateManager->add('Module.themaker.Global.Event.GetAssetManager','Themaker_AssetPreloadBase::getManager');
        $this->mRoot->mDelegateManager->add('Legacy_Utils.CreateModule','Themaker_AssetPreloadBase::getModule');
        $this->mRoot->mDelegateManager->add('Legacy_Utils.CreateBlockProcedure','Themaker_AssetPreloadBase::getBlock');
        $this->mRoot->mDelegateManager->add('Module.'.$this->mDirname.'.Global.Event.GetNormalUri','Themaker_CoolUriDelegate::getNormalUri', $file);

        $this->mRoot->mDelegateManager->add('Legacy_TagClient.GetClientList','Themaker_TagClientDelegate::getClientList', THEMAKER_TRUST_PATH.'/class/callback/TagClient.class.php');
        $this->mRoot->mDelegateManager->add('Legacy_TagClient.'.$this->mDirname.'.GetClientData','Themaker_TagClientDelegate::getClientData', THEMAKER_TRUST_PATH.'/class/callback/TagClient.class.php');  }

    /**
     * getManager
     * 
     * @param   Themaker_AssetManager  &$obj
     * @param   string  $dirname
     * 
     * @return  void
    **/
    public static function getManager(/*** Themaker_AssetManager ***/ &$obj,/*** string ***/ $dirname)
    {
        require_once THEMAKER_TRUST_PATH . '/class/AssetManager.class.php';
        $obj = Themaker_AssetManager::getInstance($dirname);
    }

    /**
     * getModule
     * 
     * @param   Legacy_AbstractModule  &$obj
     * @param   XoopsModule  $module
     * 
     * @return  void
    **/
    public static function getModule(/*** Legacy_AbstractModule ***/ &$obj,/*** XoopsModule ***/ $module)
    {
        if($module->getInfo('trust_dirname') == 'themaker')
        {
            require_once THEMAKER_TRUST_PATH . '/class/Module.class.php';
            $obj = new Themaker_Module($module);
        }
    }

    /**
     * getBlock
     * 
     * @param   Legacy_AbstractBlockProcedure  &$obj
     * @param   XoopsBlock  $block
     * 
     * @return  void
    **/
    public static function getBlock(/*** Legacy_AbstractBlockProcedure ***/ &$obj,/*** XoopsBlock ***/ $block)
    {
        $moduleHandler =& Themaker_Utils::getXoopsHandler('module');
        $module =& $moduleHandler->get($block->get('mid'));
        if(is_object($module) && $module->getInfo('trust_dirname') == 'themaker')
        {
            require_once THEMAKER_TRUST_PATH . '/blocks/' . $block->get('func_file');
            $className = 'Themaker_' . substr($block->get('show_func'), 4);
            $obj = new $className($block);
        }
    }
}

?>
