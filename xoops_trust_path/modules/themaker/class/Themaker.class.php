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

class Themaker
{
    public $mInPath = null;
    public $mOutPath = null;

    public function __construct(Themaker_SettingObject $obj)
    {
        $this->_mSetting = $obj;
        $this->mInPath = THEMAKER_TRUST_PATH . '/files';
        $this->mOutPath = THEMAKER_TRUST_PATH .'/outputs/'.$this->_getSetting('setting_id');
    }

    protected function _getDirname()
    {
        $this->_mSetting->getDirname();
    }

    public function generate()
    {
        //Copy common files for theme
        $this->_copyFiles($this->mInPath.'/common', $this->mOutPath);

        //Copy files by user's requirement
        //layout type: grid, flexible, responsible
        $layoutEnum = new Themaker_LAYOUT_TYPE();
        $layoutType = $layoutEnum->getKeyString($this->_getSetting('layout_type'), true);
        $inPath = $this->mInPath.'/'.$layoutType;

        //html type: xhtml, html5
        $htmlEnum = new Themaker_HTML_TYPE();
        $htmlType = $htmlEnum->getKeyString($this->_getSetting('html_type'));
        $this->_copyFiles($inPath.'/htmltype/'.$htmlType, $this->mOutPath);

        //column: 1col, 2col, 3col...
        $columnEnum = new Themaker_COLUMN();
        $topcolumn = $columnEnum->getKeyString($this->_getSetting('toppage_col'));
        $this->_copyFiles($inPath.'/column/'.$topcolumn, $this->mOutPath);
        rename($this->mOutPath.'/body.html', $this->mOutPath.'/body_top.html');
        $subcolumn = $columnEnum->getKeyString($this->_getSetting('subpage_col'));
        $this->_copyFiles($inPath.'/column/'.$subcolumn, $this->mOutPath);
        rename($this->mOutPath.'/body.html', $this->mOutPath.'/body_sub.html');

        //Center Block: standard, fatfooter
        $centerBlockEnum = new Themaker_CENTER_BLOCK();
        $centerBlock = $centerBlockEnum->getKeyString($this->_getSetting('center_block'));
        $this->_copyFiles($inPath.'/centerblock/'.$centerBlock, $this->mOutPath);

        $this->_loadNaviMenu();
        $this->_loadSubMenu();

        $this->_makeCenterBlock();
        $this->_makeStylesheet();    //columns, left/right
        $this->_makeColorStylesheet();
        $this->_makeManifesto();

        $this->_removePointers($this->mOutPath);
        $this->_archive();
    }

    protected function _makeCenterBlock()
    {
        $includeCenterFile = '<{include file="`$smarty.const.XOOPS_THEME_PATH`/`$xoops_theme`/center.html"}>';
        switch($this->_getSetting('center_block')){
        case Themaker_CENTER_BLOCK::STANDARD:
            $this->_write('CenterBlock', $includeCenterFile, $this->mOutPath.'/body_top.html');
            $this->_write('CenterBlock', $includeCenterFile, $this->mOutPath.'/body_sub.html');
            break;
        case Themaker_CENTER_BLOCK::FOOTER:
            $this->_write('CenterBlock', $includeCenterFile, $this->mOutPath.'/theme.html');
            break;
        }
    }

    protected function _makeStylesheet()
    {
        $path = $this->mOutPath.'/style.css';

        //site width
        $this->_write('site_width', $this->_getSetting('site_width'), $path);
        $this->_write('content_width', $this->_getSetting('content_width'), $path);

        //left column
        //float:
        $this->_write('left_float', $this->_getSetting('left_float'), $path);
        //width:
        $this->_write('left_width', $this->_getSetting('left_width'), $path);

        //right column
        //width:
        $this->_write('right_width', $this->_getSetting('right_width'), $path);
    }

    protected function _makeColorStylesheet()
    {
        $colorScheme = new Themaker_ColorScheme($this->_getSetting('color_scheme'), $this->_mSetting, $this->mInPath.'/ColorPattern/light.csv');

        $file = $this->mOutPath.'/color.css';
        $text = file_get_contents($file);
        foreach(array_keys($colorScheme->mPattern) as $point){
            $text = str_replace('{{'.$point.'}}', $colorScheme->getColor($point), $text);
        }
        file_put_contents($file, $text);
    }

    protected function _makeManifesto()
    {
        $path = $this->mOutPath.'/manifesto.ini.php';
        $columnEnum = new Themaker_COLUMN();
        $htmlEnum = new Themaker_HTML_TYPE();

        $this->_write('name', $this->_getSetting('title'), $path);
        $this->_write('author', Legacy_Utils::getUserName(Legacy_Utils::getUid()), $path);
        $this->_write('description', $htmlEnum->getMessage($this->_getSetting('html_type')) .', '. $columnEnum->getMessage($this->_getSetting('toppage_col')) .' / '. $columnEnum->getMessage($this->_getSetting('subpage_col')).','.$this->_getSetting('description'), $path);
    }

    protected function _getSetting(/*** string ***/ $key)
    {
        return $this->_mSetting->get($key);
    }

    protected function _loadNavimenu()
    {
        //if(! $this->_getSetting('mainmenu')) return;

        $navimenu = '<ul id="NaviMenu" class="clearfix"><li<{if $xoops_dirname=="module1"}> class="menuActive"<{/if}>><a href="#">menu1</a></li><li<{if $xoops_dirname=="module2"}> class="menuActive"<{/if}>><a href="#">menu2</a></li><li<{if $xoops_dirname=="module3"}> class="menuActive"<{/if}>><a href="#">menu3</a></li><li<{if $xoops_dirname=="module4"}> class="menuActive"<{/if}>><a href="#">menu4</a></li></ul>';
        $this->_write('navimenu', $navimenu, $this->mOutPath.'/theme.html');
    }

    protected function _loadSubmenu()
    {
        //if(! $this->_getSetting('submenu')) return;

        $submenu = '<ul id="SubMenu" class="clearfix"><li<{if $xoops_dirname=="module1"}> class="menuActive"<{/if}>><a href="#">menu1</a></li><li<{if $xoops_dirname=="module2"}> class="menuActive"<{/if}>><a href="#">menu2</a></li><li<{if $xoops_dirname=="module3"}> class="menuActive"<{/if}>><a href="#">menu3</a></li><li<{if $xoops_dirname=="module4"}> class="menuActive"<{/if}>><a href="#">menu4</a></li></ul>';
        $this->_write('submenu', $submenu, $this->mOutPath.'/theme.html');
    }

    protected function _write(/*** string ***/ $point, /*** string ***/ $string, /*** string ***/ $filePath)
    {
        $text = file_get_contents($filePath);
        $result = str_replace('{{'.$point.'}}', $string, $text);
        file_put_contents($filePath, $result);
    }

    /**
     * _clearOutput
     * 
     * @param   string    $outPath;
     * 
     * @return  void
    **/
    protected function _clearOutput(/*** string ***/ $outPath="")
    {
        if($outPath==""){
            $outPath = $this->mOutPath;
        }
        if(! file_exists($outPath)){
            mkdir($outPath);
        }
        elseif ($handle = opendir($outPath)){
            while (false !== ($item = readdir($handle))){
                if ($item != "." && $item != ".."){
                    if (is_dir($outPath."/$item")){
                        $this->_clearOutput($outPath."/$item");
                    }else{
                        unlink($outPath."/$item");
                    }
                }
            }
            closedir($handle);
            rmdir($outPath);
        }
    }

    /**
     * _copyFiles()
     * 
     * @param   string  $inPath
     * @param   string  $outPath
     * 
     * @return  void
    **/
    protected function _copyFiles(/*** string ***/ $inPath, /*** string ***/ $outPath)
    {
        if(! is_dir($outPath)) mkdir("$outPath");
    
        $handle = opendir($inPath);
        while($filename = readdir($handle)){
            if(strcmp($filename,".")!=0 && strcmp($filename,"..")!=0){
                if(substr($filename, 0,1)==='.') continue;
                if(is_dir("$inPath/$filename")){
                    if(!empty($filename) && !file_exists("$outPath/$filename")) mkdir("$outPath/$filename");
                    $this->_copyFiles("$inPath/$filename","$outPath/$filename");
                }
                else{
                    if(file_exists("$outPath/$filename")) unlink("$outPath/$filename");
                    copy("$inPath/$filename","$outPath/$filename");
                }
            }
        }
    }

    protected function _removePointers(/*** string ***/ $path)
    {
        $handle = opendir($path);
        while($filename = readdir($handle)){
            if(strcmp($filename,".")!=0 && strcmp($filename,"..")!=0){
                if(is_dir("$path/$filename")){
                    $this->_removePointers("$path/$filename");
                }
                else{
                    $file = file_get_contents("$path/$filename");
                    $file = str_replace('{{CenterBlock}}', '', $file);
                    file_put_contents("$path/$filename", $file);
                }
            }
        }
    }

    protected function _archive()
    {
        $tar = "(cd ".THEMAKER_TRUST_PATH."/outputs/".$this->_getSetting('setting_id')."; tar czf ".THEMAKER_TRUST_PATH."/download/theme_".$this->_getSetting('setting_id').".tar.gz .)";
        system($tar, $ret);
    }
}

/**
 *  Use http://colorschemedesigner.com/ as color scheme.
 *  Export XML color scheme on this site to set form text field.
*/
class Themaker_ColorScheme
{
    public $mColorScheme = array();
    public $mPattern = array();
    public $mSchemeType = 0;
    protected $_mSetting = null;

    public function __construct(/*** string ***/ $colorXml, /*** string ***/ $settingObj, /*** string ***/ $patternFile=null)
    {
        $this->_mSetting = $settingObj;
        $this->_parseColorScheme($colorXml);
        $this->_parsePattern($patternFile);
    }

    public function getColor(/*** string ***/ $pointer)
    {
        $colorCode = $this->_getColorCode($pointer);
        if(substr($colorCode, 0, 1)==='#'){    //rgb code like #ffffff
            return $colorCode;
        }
        else{
            return isset($this->mColorScheme[$colorCode]['rgb']) ? '#'.$this->mColorScheme[$colorCode]['rgb'] : '#'.$this->mColorScheme['complement-'.substr($colorCode, -1, 1)]['rgb'];
        }
    }

    protected function _getColorCode(/*** string ***/ $pointer)
    {
        return trim($this->mPattern[$pointer][$this->mSchemeType]);
    }

    protected function _parseColorScheme(/*** string ***/ $xml)
    {
        $xml = simplexml_load_string($xml);
        $this->_setSchemeType($xml->url);

        $objects = array();
        foreach($xml->colorset as $colorset){
            foreach($colorset->color as $color){
                $colorId = (string) $color['id'];
                $this->mColorScheme[$colorId]['rgb'] = (string) $color['rgb'];
                $this->mColorScheme[$colorId]['nr'] = (string) $color['nr'];
            }
        }
    }

    protected function _parsePattern($patternFile)
    {
        //$patternSet = file($patternFile);
        $patternSet = explode("\n", $this->_exportSpreadsheet());
        foreach($patternSet as $pattern){
            $patternArr = explode(',', $pattern);
            $this->mPattern[array_shift($patternArr)] = $patternArr;
        }
    }

    protected function _exportSpreadsheet()
    {
        require_once XOOPS_LIBRARY_PATH.'/GdataSpreadsheet.class.php';
        $spreadsheetKey = Themaker_Utils::getModuleConfig($this->_mSetting->getDirname(), 'spreadsheet_key');
        $spreadsheet = new Legacy_Gdata_Spreadsheets();

        $worksheet = $spreadsheet->getWorksheet($spreadsheetKey, $this->_mSetting->getShow('color_pattern'));
        return $worksheet->exportCsv();
    }

    protected function _setSchemeType($string)
    {
        $schemeType = substr(array_pop(explode('#', $string)), 2, 1);
        switch($schemeType){
        case 1:
            $this->mSchemeType = 1;    //One Color
            break;
        case 2:
            $this->mSchemeType = 2;    //Two Colors
            break;
        case 3:
        case 5:
            $this->mSchemeType = 3;    //Three Colors
            break;
        case 4:
        case 6:
            $this->mSchemeType = 4;    //Four Colors
            break;
        }
    }
}

?>
