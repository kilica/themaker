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

require_once XOOPS_TRUST_PATH . '/modules/themaker/preload/AssetPreload.class.php';
Themaker_AssetPreloadBase::prepare(basename(dirname(dirname(__FILE__))));

?>
