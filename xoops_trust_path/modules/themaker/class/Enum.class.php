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

class Themaker_HTML_TYPE extends Themaker_Enum
{
    const XHTML = 1;
    const HTML5 = 2;

    public function getPrefix()
    {
        return '_MD_THEMAKER_HTML_TYPE_';
    }
}

class Themaker_LAYOUT_TYPE extends Themaker_Enum
{
    const FIXEDGRID960 = 1;    //960px
    //const FLEXIBLE = 2;
    //const RESPONSIBLE = 3;
    const TWBOOTSTRAP = 4;    //Twitter Bootstrap

    public function getPrefix()
    {
        return '_MD_THEMAKER_LAYOUT_TYPE_';
    }

    public function getHtmlType()
    {
        $ret = array();
        $htmlType = new Themaker_HTML_TYPE();
        $htmlTypes = array_keys($htmlType->getList());
        $path = THEMAKER_TRUST_PATH.'/files/'.$this->getKeyString($type);
        $directories = glob("$path/*");

        foreach($this->getList() as $layout){
            foreach($directories as $dir){
                $dirname = basename($dir);
                if(in_array($dirname, $htmlTypes)){
                    $ret[$layout][] = $dirname;
                }
            }
        }
        return $ret;
    }
}

class Themaker_COLUMN extends Themaker_Enum
{
    const ONE = 1;
    const TWOLEFT = 2;
    const TWORIGHT = 3;
    const THREE = 4;

    public function getPrefix()
    {
        return '_MD_THEMAKER_COLUMN_';
    }
}

class Themaker_CENTER_BLOCK extends Themaker_Enum
{
    const NONE = 0;
    const STANDARD = 1;
    const FOOTER = 2;

    public function getPrefix()
    {
        return '_MD_THEMAKER_CENTER_BLOCK_';
    }
}

class Themaker_FLOAT extends Themaker_Enum
{
    const NONE = 0;
    const LEFT = 1;
    const RIGHT = 2;

    public function getPrefix()
    {
        return '_MD_THEMAKER_FLOAT_';
    }
}

abstract class Themaker_Enum
{
    /**
     * getList
     * 
     * @param   void
     * 
     * @return  int[]
    **/
    public function getList()
    {
        static $constantList = null;
        if(! $constantList){
            $classInfo = new ReflectionClass($this);
            $constantList = $classInfo->getConstants();
        }
        return $constantList;
    }

    /**
     * Get option list, mainly using at select box
     * 
     * @param   void
     * 
     * @return  string[]
    **/
    public function getOptionList()
    {
        $array = array_flip($this->getList());
        foreach(array_keys($array) as $key){
            $array[$key] = constant($this->getPrefix() . $array[$key]);
        }
        return $array;
    }

    /**
     * Get the string of option
     * 
     * @param   int
     * 
     * @return  string
    **/
    public function getMessage(/*** int ***/ $value)
    {
        return constant($this->getPrefix().$this->getKeyString($value, false));
    }

    /**
     * validate
     * 
     * @param   int
     * 
     * @return  bool
    **/
    public function validate(/*** int ***/ $value)
    {
        return in_array($value, $this->getList());
    }

    /**
     * getKeyString
     * 
     * @param   int        $value
     * @param    bool    $lowercase
     * 
     * @return  string
    **/
    public function getKeyString($value, $lowercase=true)
    {
        $array = array_flip($this->getList());
        return $lowercase ? strtolower($array[$value]) : $array[$value];
    }

    abstract public function getPrefix();
}

?>
