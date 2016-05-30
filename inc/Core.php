<?php
class Core{
//=======================================
// PDO Setting
//=======================================
	static function getdbh(){
		if(!isset($GLOBALS['dbh'])){
			try{
				$GLOBALS['dbh']=new PDO('mysql:dbname=emaillist;host=localhost', 'emaillist', 'list1234');
				$GLOBALS['dbh']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch (PDOException $e){
				die('Connection failed: '.$e->getMessage());
			}
		}
		
		return $GLOBALS['dbh'];
	}
	
//=======================================
// Model Functions
//=======================================
	static function SentEmails($vars=array()){
		$dbh=self::getdbh();
		if(count($vars)==0)
			return false;
		//$stm="insert into `sent_emails_test` (`subject`, `date`, `edmname`, `platform`, `type`, `list`, `total`) values (?, ?, ?, ?, ?, ?, ?)";
		$stm="insert into `sent_emails` (`subject`, `date`, `edmname`, `platform`, `type`, `list`, `total`) values (?, ?, ?, ?, ?, ?, ?)";
		
		$params[]=$vars['subject'];
		$params[]=$vars['date'];
		$params[]=$vars['edmname'];
		$params[]=$vars['platform'];
		$params[]=$vars['type'];
		$params[]=$vars['list'];
		$params[]=$vars['total'];
		
		$sql=$dbh->prepare($stm);
		$sql->execute($params);
	}
	
	static function EDMContent($vars=array()){
		$dbh=self::getdbh();
		if(count($vars)==0)
			return false;
		//$stm="insert into `edm_content_test` (`date`, `subject`, `pre_header`, `type`, `edmname`, `utm`, `list`, `country`, `data_json`, `ts`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stm="insert into `edm_content` (`date`, `subject`, `pre_header`, `type`, `edmname`, `utm`, `list`, `country`, `data_json`, `ts`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		$params[]=$vars['date'];
		$params[]=$vars['subject'];
		$params[]=$vars['pre_header'];
		$params[]=$vars['type'];
		$params[]=$vars['edmname'];
		$params[]=$vars['utm'];
		$params[]=$vars['list'];
		$params[]=$vars['country'];
		$params[]=$vars['data_json'];
		$params[]=$vars['ts'];
		
		$sql=$dbh->prepare($stm);
		$sql->execute($params);
	}
	
	static function JSONContent($elements=array(), $articles=array(), $deals=array()){
		$data_array=array();
		
		$header_footers=$elements['header_footer'];
		if(count($header_footers)>0){
			$string_arr=array();
			foreach($header_footers as $k=>$v){
				$data_array[]=array(
					'dt_type'=>'header_footer|'.$k, 
					'dt_array'=>"|{{".$k."}}=>[[".$v."]]|"
				);
			}
		}
		
		if(count($articles)>0){
			foreach($articles as $article){
				$string_arr=array();
				foreach($article as $k=>$v){
					$string_arr[]="|{{".$k."}}=>[[".$v."]]|";
				}
				$data_array[]=array(
					'dt_type'=>'article', 
					'dt_array'=>implode('|,|', $string_arr)
				);
			}
		}
		
		if(count($deals)>0){
			foreach($deals as $deal){
				$string_arr=array();
				foreach($deal as $k=>$v){
					$string_arr[]="|{{".$k."}}=>[[".$v."]]|";
				}
				$data_array[]=array(
					'dt_type'=>'deal', 
					'dt_array'=>addslashes(implode('|,|', $string_arr))
				);
			}
		}
		
		$data_json=addslashes(json_encode($data_array));
		
		return $data_json;
	}
}