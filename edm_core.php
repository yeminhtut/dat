<?php
//=======================================
// Include Functions
//=======================================
die('die here');exit;
  require(dirname(__FILE__).'/inc/Core.php');
	
//=======================================
// PHP Settings
//=======================================
	ini_set("max_execution_time", 0);
	set_time_limit(0);
	//ini_set('memory_limit', '320M');
	$timestamp=date('Y-m-d H:i:s');
	echo "Started at: ".$timestamp."\n";
	
//=======================================
// Script Inputs (Editable)
//=======================================
	$domain=array('edm@tripzilla.com' => 'TripZilla Singapore');
	$SENDRATE=60; // number of emails to send per minute
	$starttime=time();
	$listname=(isset($argv[1])?$argv[1]:'');
	
	$DEBUG=true;
	if(isset($argv[2]) && $argv[2]=='real'){
		$DEBUG=false;
	}
	
	if(isset($argv[3])){
		$start=$argv[3];
		if(strpos($start, '-')!==false && strpos($start, '_')!==false && strpos($start, ':')!==false){
			$start=str_replace("_", " ", $start);
			$starttime=strtotime("$start");
			
			if($starttime==0 || $starttime==-1){
				echo "Warning : Invalid Time Given.";
				die(display_help_text());
			}
			
			if($starttime > strtotime("now +3 day") || $starttime < strtotime("now")){
				echo "Warning : Maximum schedule time is 3 day from now.";
				die(display_help_text());
			}
		}else{
			echo "Warning : Wrong format of time given.";
			die(display_help_text());
		}
	}else{
		$sleep=250000;
	}
	
	if($listname!='list0' && $listname!='list1a' && $listname!='list1b' && $listname!='list2'){
		die(display_help_text());
	}
	
//=======================================
// PDO Connection
//=======================================
	try{
    $dbh=new PDO('mysql:dbname=emaillist;host=localhost', 'emaillist', 'list1234');
		if($listname=='list0'){
			$sql="SELECT `id`, `email`,`name`, `platform`, `lastactive`, `name` AS fullname FROM emaillist.`users` u WHERE `country` = 'sg' AND `groupid` = '9' AND `status` = 'enabled' AND `platform` = 'tripzilla' GROUP BY email UNION SELECT `id`, `email`,`name`, `platform`, `lastactive`, `name` AS fullname FROM emaillist.`users` u WHERE `country` = 'sg' AND `groupid` = '9' AND `status` = 'enabled' AND `platform` = 'magazine'  AND NOT EXISTS(SELECT * FROM `users` u2 WHERE u2.email = u.email AND u2.country=u.country AND u2.groupid = u.groupid AND u2.platform='tripzilla' AND u2.status!='enabled') GROUP BY email ORDER BY id DESC";
			$domain=array('newsletter@tripzilla.sg' => 'TripZilla Singapore');
			$SENDRATE=120;
    }else if($listname=='list1a'){
			$sql="SELECT `id`, `email`,`name` AS fullname FROM emaillist.`users` WHERE country='sg' AND groupid='8' AND `status`='enabled' AND platform='tripzilla' ORDER BY `id` DESC";
			$domain=array('newsletter@tripzilla.sg' => 'TripZilla Singapore');
			$SENDRATE=200;
    }else if($listname=='list1b'){
			$sql="SELECT `id`, `email`,`name` AS fullname FROM emaillist.`users` WHERE country='sg' AND groupid='1' AND `status`='enabled' AND platform='tripzilla' AND (`id` %4=3) ORDER BY `id` ASC";
			$domain=array('newsletter@tripzilla.sg' => 'TripZilla Singapore');		
			$SENDRATE=350;
    }else if($listname=='list2'){
			$sql="SELECT `id`, `email`,`name` AS fullname FROM emaillist.`users` WHERE country='sg' AND groupid='2' ORDER BY id ASC LIMIT 0,7500";
    }
		
    if($DEBUG){
			$sql.=" LIMIT 1";
		}
		
    $rows=$dbh->query($sql);
    if (!$rows){
			die("SQL Error\n");
		}
	}catch(PDOException $e){
		echo 'Connection failed: '.$e->getMessage();
		exit;
	}
	
//=======================================
// Swift Mailer Setup
//=======================================
	require_once '/var/www/sites/edm/Swift/lib/swift_required.php';
	$transport=Swift_SendmailTransport::newInstance();
	$mailer=Swift_Mailer::newInstance($transport);
	$numSent=0;
	$failedRecipients=array();
	$failedEmails=array();
	
//=======================================
// EDM content configuration
//=======================================
	require(dirname(__FILE__).'/edm_config.php');
	require(dirname(__FILE__).'/templates/'.$template_type.'/ContentGenerator.php');
	
//=======================================
// Code to send emails
//=======================================
	$plain_tpl=file_get_contents(dirname(__FILE__).'/templates/'.$template_type.'/edm_text.php');
	
	//Create Message object and set static content here, outside the loop
	$plain=do_fetch_str($plain_tpl, array('articles'=>$articles, 'deals'=>$deals, 'tag'=>$tag));
	$message=Swift_Message::newInstance($subject)
	->setFrom($domain)
	->addPart($plain,'text/plain');
	
	$headers=$message->getHeaders();
	
	if($listname=='list0'){
		$html_tpl=file_get_contents(dirname(__FILE__).'/templates/'.$template_type.'/edm_html_member.php');
	}else if($listname=='list1a'){  
		$html_tpl=file_get_contents(dirname(__FILE__).'/templates/'.$template_type.'/edm_html_active.php');
	}else if($listname=='list1b'){
		$html_tpl=file_get_contents(dirname(__FILE__).'/templates/'.$template_type.'/edm_html_inactive.php');
	}else if($listname=='list2'){
		$html_tpl=file_get_contents(dirname(__FILE__).'/templates/'.$template_type.'/edm_html_new.php');
	}
  
	if(isset($argv[3])){
		$headers->addTextHeader('X-Mailgun-Deliver-By',time());
		$deliverby=$headers->get('X-Mailgun-Deliver-By');
	}
	
	$headers->addTextHeader('X-Mailgun-Variables', '{"edmname": "'.$tag.'"}');
  
	$vars=array(
		'subject' => $subject, 
		'pre_header' => $pre_header, 
		'articles' => $articles, 
		'deals' => $deals, 
		'utm_code' => $utm_code, 
		'tag' => $tag, 
		'listname' => $listname, 
		'elements' => $elements
	);
  
	$count=0;
	foreach($rows as $row){
		$id=(int)$row['id'];
		$name=trim($row['fullname'])?trim($row['fullname']):'';
		$email=trim($row['email']);
    $hash=substr(md5($email),-8); // for unsubscribe link
    $vars['id']=$id;
    $vars['name']=$name;
    $vars['email']=$email;
    $vars['hash']=$hash;
		
    $html=do_fetch_str($html_tpl,$vars);
		
    try{
			if($DEBUG){
				//ONLY sent to listed emails (TEST)
				$email=$test_emails;
			}else{
				if(isset($argv[3])){
					$sendtime=$starttime+floor($count/$SENDRATE)*60;
					$deliverby->setValue($sendtime);
				}else{
					usleep($sleep);
				}
			}
			
			$message->setTo($email)->setBody($html, 'text/html');
			$numSent+=$mailer->send($message, $failedRecipients);
		}catch(Swift_RfcComplianceException $e){
			$failedEmails[]=$e->getMessage();
			print('Email address not valid:'.$e->getMessage()."\n");
		}
		
		if($DEBUG){
			echo ++$count." ($id) ".date('Y-m-d H:i:s')."\n";
		}else{
			if(isset($argv[3])){
				echo ++$count." ($id) (mg header) $email ".date('Y-m-d H:i:s',$sendtime)."\n";
			}else{
				echo ++$count." ($id) (usleep) $email ".date('Y-m-d H:i:s')."\n";
			}
		}
	}
	
  if($listname=='list2'){
    $dbh->exec("UPDATE emaillist.`users` SET groupid='1' WHERE country='sg' AND groupid='2' ORDER BY id ASC LIMIT 7500");
  }
	
  $str="Singapore EDM Email Sent"."\n";
  $str.="$listname: Sent $numSent messages. Count : $count, Last id: $id"."\n";
  $str.="Errors: ".implode(', ',$failedEmails)." ".implode(', ',$failedRecipients)."\n";
  $str.="Ended at: ".date('Y-m-d H:i:s')."\n";
  $str.="First email to deliver by :".date('Y-m-d H:i:s',$starttime)."\n";
  if(isset($argv[3])){
    $str.="Last Email to deliver by (mg header): ".date('Y-m-d H:i:s',$sendtime)."\n";
  }else{
    $str.="Last Email to deliver by (usleep): ".date('Y-m-d H:i:s')."\n";
  }
  
  echo $str;
	
//=======================================
// Reporting Sent status
//=======================================
  if(!$DEBUG){
		$report_subject="Singapore EDM Email Sent";
		$report_emails=array(
			'eric.koh@travelogy.com', 
			'benjamin@travelogy.com', 
			'weiting@travelogy.com', 
			'alvin@travelogy.com', 
			'paulo@travelogy.com', 
			'ye.minhtut@travelogy.com', 
			'chinglee@travelogy.com'
		);
		$report_emails=implode(', ', $report_emails);
		//send Report via email
		mail($report_emails, $report_subject, $str);
		
		
		$sentemails_vars['subject']=$subject;
		$sentemails_vars['date']=date('Y-m-d');
		$sentemails_vars['edmname']=$tag;
		$sentemails_vars['platform']='tripzilla_sg';
		$sentemails_vars['type']='weekly';
		$sentemails_vars['list']=$listname;
		if(in_array($listname, array('list0', 'list1a', 'list1b', 'list2')))
			$sentemails_vars['list']=str_replace('list', '', $listname);
		$sentemails_vars['total']=$numSent;
		Core::SentEmails($sentemails_vars);
		
		$edmcontent_vars['date']=date('Y-m-d');
		$edmcontent_vars['subject']=$subject;
		$edmcontent_vars['pre_header']='-';
		if(isset($pre_header))
			$edmcontent_vars['pre_header']=$pre_header;
		$edmcontent_vars['type']='weekly';
		$edmcontent_vars['edmname']=$tag;
		$edmcontent_vars['utm']=$utm_code;
		$edmcontent_vars['list']=$listname;
		$edmcontent_vars['country']='sg';
		$edmcontent_vars['data_json']=Core::JSONContent($elements, $articles, $deals);
		$edmcontent_vars['ts']=$timestamp;
		Core::EDMContent($edmcontent_vars);
	}
  
//=======================================
// Private Functions
//=======================================
function do_fetch_str($str,$vars=''){
	if(is_array($vars))
		extract($vars);
	ob_start();
	eval('?>'.$str);
	return ob_get_clean();
}

function display_help_text() {
	return "
USAGE: php edm_core.php <list> [<test>] [<time>]
  - <list>
  list0 for subscribers T_Subscribe table
  list1a for cleaned list database (with opens and clicks)
  list1b for cleaned list database (without opens and clicks)
  list2 for uncleaned list database
  - <test>
  real *** really send! ***
  - <time>
  Numeric number *** Start Time ***
  eg : YYYY-MM-DD_HH:MM:SS (in 24 hour)
       eg - 2013-12-20_09:30:00
       eg - 2013-12-20_21:30:00
NOTE : If parameter [<test>] is set and parameter [<time>] is not set, it will send using usleep.
       If both parameter [<test>] and [<time>] is set, it will send using sendrate and mg header.
";
}