<?php

ini_set('include_path', ini_get('include_path').':'.XOOPS_LIBRARY_PATH);
require_once XOOPS_LIBRARY_PATH.'/Zend/Loader.php';
//require_once 'C:\xampp\php\PEAR\Zend\Loader.php';

class Legacy_Gdata_Spreadsheets
{
	public $mClient = null;
	public $mSpreadsheetService = null;

	public function __construct()
	{
		$this->_loadClass();
		$this->_clientLogin();
		$this->mSpreadsheetService = new Zend_Gdata_Spreadsheets($this->mClient);
	}

	protected function _loadClass()
	{
		Zend_Loader::loadClass('Zend_Gdata');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
	}

	protected function _clientLogin()
	{
		$root = XCube_Root::getSingleton();
		$email = $root->getSiteConfig('Gdata', 'email');
		$password = $root->getSiteConfig('Gdata', 'password');
		$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
	
		// 認証済みHTTPクライアント作成(ClientLogin版)
		$this->mClient = Zend_Gdata_ClientLogin::getHttpClient($email, $password, $service);
	}

	public function getWorksheetList(/*** string ***/ $spreadsheetKey)
	{
		$documentQuery = new Zend_Gdata_Spreadsheets_DocumentQuery();
		$documentQuery->setSpreadsheetKey($spreadsheetKey);
	
		// get Worksheet feed
		$spreadsheetFeed = $this->mSpreadsheetService->getWorksheetFeed($documentQuery);
	
		// make  worksheet list
		$i = 0;
		$worksheetArr = array();
		foreach($spreadsheetFeed->entries as $worksheetEntry) {
		    $worksheetId = split('/', $spreadsheetFeed->entries[$i]->id->text);
		    $worksheetArr[$worksheetId[8]] = $worksheetEntry->title->text;
		    $i++;
		}
		return $worksheetArr;
	}

	public function getWorksheet(/*** string ***/ $spreadsheetKey, /*** string ***/ $worksheetId)
	{
		$query = new Zend_Gdata_Spreadsheets_ListQuery();
		$query->setSpreadsheetKey($spreadsheetKey);
		$query->setWorksheetId($worksheetId);
		$listFeed = $this->mSpreadsheetService->getListFeed($query);
		return new Legacy_Gdata_Spreadsheet_Worksheet($listFeed);
	}
}

class Legacy_Gdata_Spreadsheet_Worksheet
{
	public function __construct(/*** object ***/ $listFeed)
	{
		$this->mListFeed = $listFeed;
	}

	public function getRowIndex(/*** int ***/ $row)
	{
		return $row - 1;
	}

	public function getValue(/*** int ***/ $row, /*** string ***/ $column)
	{
		$entry = $this->mListFeed->entries[$this->getRowIndex($row)]->getCustomByName($column);
		return $entry->getText();
	}

	public function searchValue()
	{
	}

	public function exportCsv()
	{
		$csv = '';
		foreach($this->mListFeed->entries as $entry){
			$rowData = $entry->getCustom();
			$rowCsv = '';
			foreach($rowData as $cell){
				$rowCsv = $rowCsv ? $rowCsv.',' : $rowCsv;
				$rowCsv = $rowCsv . $cell->getText();
			}
			$csv .= $rowCsv."\n";
		}
		return $csv;
	}
}
?>