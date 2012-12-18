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
 * Themaker_ModuleViewAction
**/
class Themaker_SettingDownloadAction extends Themaker_AbstractViewAction
{
    const DATANAME = 'setting';

    public function executeViewSuccess($render) {
        $path_file = sprintf('%s/download/theme_%d.tar.gz', THEMAKER_TRUST_PATH, $this->mObject->getShow('setting_id'));
    
        if (!file_exists($path_file)) {
            die("Error: File(".$path_file.") does not exist");
        }

        if (!($fp = fopen($path_file, "r"))) {
            die("Error: Cannot open the file(".$path_file.")");
        }
        fclose($fp);

        if (($content_length = filesize($path_file)) == 0) {
            die("Error: File size is 0.(".$path_file.")");
        }

        header("Content-Disposition: inline; filename=\"".basename($path_file)."\"");
        header("Content-Length: ".$content_length);
        header("Content-Type: application/octet-stream");

        if (!readfile($path_file)) {
            die("Cannot read the file(".$path_file.")");
        }
        die();
        //parent::executeViewSuccess($render);
    }
}

?>
