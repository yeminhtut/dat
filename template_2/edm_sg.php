<?php
//=======================================
// PHP Settings
//=======================================
	ini_set("max_execution_time", 0);
	set_time_limit(0);
	//ini_set('memory_limit', '320M');
	echo "Started at: ".date('Y-m-d H:i:s')."\n";
	
//=======================================
// Script Inputs (Editable)
//=======================================
	$domain=array('edm@tripzilla.com' => 'TripZilla Singapore');
	$SENDRATE=60; // number of emails to send per minute
	$starttime=time();
	$listname=isset($argv[1]) ? $argv[1] : '';
	$DEBUG=true;
	if (isset($argv[2]) && $argv[2]=='real')
	$DEBUG=false;
    
	if (isset($argv[3])){
		$start=$argv[3];
		if (strpos($start, '-')!== false && strpos($start, '_')!== false && strpos($start, ':')!== false){
			$start=str_replace("_", " ", $start);
			$starttime=strtotime("$start");
			
			if ($starttime == 0 || $starttime == -1 ){
				echo "Warning : Invalid Time Given."; die(display_help_text());
			}
			
			if($starttime > strtotime("now +3 day" ) || $starttime <  strtotime("now")){
				echo "Warning : Maximum schedule time is 3 day from now.";  die(display_help_text());
			}
		} else{
			echo "Warning : Wrong format of time given."; die(display_help_text());
		}
	}else{
		$sleep=250000;
	}
	
	if ($listname !='list0' && $listname != 'list1a' && $listname != 'list1b' && $listname != 'list2')
		die(display_help_text());
	
//=======================================
// PDO Connection
//=======================================
	try {
    $dbh=new PDO('mysql:dbname=emaillist;host=localhost', 'emaillist', 'list1234');
		if ($listname == 'list0') {
			$sql="SELECT `id`, `email`,`name` AS fullname FROM emaillist.`users` WHERE country='sg' AND groupid='9' AND `status`='enabled' AND platform='tripzilla' ORDER BY `id` DESC";
			$domain=array('newsletter@tripzilla.sg' => 'TripZilla Singapore');
			$SENDRATE=120;
    }elseif ($listname == 'list1a') {
			$sql="SELECT `id`, `email`,`name` AS fullname FROM emaillist.`users` WHERE country='sg' AND groupid='8' AND `status`='enabled' AND platform='tripzilla' ORDER BY `id` DESC";
			$domain=array('newsletter@tripzilla.sg' => 'TripZilla Singapore');
			$SENDRATE=200;
    }elseif ($listname == 'list1b') {	
			$sql="SELECT `id`, `email`,`name` AS fullname FROM emaillist.`users` WHERE country='sg' AND groupid='1' AND `status`='enabled' AND platform='tripzilla' AND (`id` %4=2) ORDER BY `id` ASC";
			$domain=array('newsletter@tripzilla.sg' => 'TripZilla Singapore');		
			$SENDRATE=350;
    }elseif ($listname == 'list2') {
			$sql="SELECT `id`, `email`,`name` AS fullname FROM emaillist.`users` WHERE country='sg' AND groupid='2' ORDER BY id ASC LIMIT 0,7500";
    }
		
    if ($DEBUG) $sql .= " LIMIT 1";
    $rows=$dbh->query($sql);
    if (!$rows)
      die("SQL Error\n");
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		exit;
	}
	
//=======================================
// Swift Mailer Setup
//=======================================
	require_once '/var/www/sites/edm/Swift/lib/swift_required.php';
	$transport=Swift_SendmailTransport::newInstance();
	//$transport=Swift_SmtpTransport::newInstance('localhost', 25)->setUsername('')->setPassword('');
	$mailer=Swift_Mailer::newInstance($transport);
	$numSent=0;
	$failedRecipients=array();
	$failedEmails=array();
	
//=======================================
// EDM content configuration
//=======================================
	require(dirname(__FILE__).'/edm_config.php');
	
//=======================================
// Code to send emails
//=======================================
	$plain_tpl=file_get_contents(dirname(__FILE__).'/edm_content_text.php');
	
	//Create Message object and set static content here, outside the loop
	$plain=do_fetch_str($plain_tpl,array('articles'=>$articles,'deals'=>$deals));
	$message=Swift_Message::newInstance($subject)
	->setFrom($domain)
	->addPart($plain,'text/plain');
	
	$headers=$message->getHeaders();
	
	if ($listname == 'list0'){
		$html_tpl=file_get_contents(dirname(__FILE__).'/edm_content_html_member.php');
	} else if ($listname == 'list1a'){  
		$html_tpl=file_get_contents(dirname(__FILE__).'/edm_content_html_active.php');
	} else if ($listname == 'list1b'){
		$html_tpl=file_get_contents(dirname(__FILE__).'/edm_content_html_inactive.php');
	} else if ($listname == 'list2'){
		$html_tpl=file_get_contents(dirname(__FILE__).'/edm_content_html_new.php');
	}    
  
	if (isset($argv[3])){
		$headers->addTextHeader('X-Mailgun-Deliver-By',time());
		$deliverby=$headers->get('X-Mailgun-Deliver-By');
	}
	
	$headers->addTextHeader ( 'X-Mailgun-Variables', '{"edmname": "'.$tag.'"}' );
  
	$vars=array(
		'subject' => $subject, 
		'pre_header' => $pre_header, 
		'articles' => $articles, 
		'deals' => $deals, 
		'utm_code' => $utm_code, 
		'listname' => $listname, 
		'elements' => $elements
	);
  
	$count=0;
	foreach ($rows as $row) {
		$id=(int)$row['id'];
		$name=trim($row['fullname']) ? trim($row['fullname']) : '';
		$email=trim($row['email']);	
    $hash=substr(md5($email),-8); // for unsubscribe link  
    $vars['id']=$id;
    $vars['name']=$name;
    $vars['email']=$email;
    $vars['hash']=$hash;
    $html=do_fetch_str($html_tpl,$vars);
    try {
			if ($DEBUG){
				// $email=array(
				// 	'ye.minhtut@travelogy.com'=>'Ye Min'
				// );
								
				$email=array(
					'paulo@travelogy.com' => 'Paulo', 
					'ye.minhtut@travelogy.com' => 'Ye Min', 
					'alvin@travelogy.com' => 'Alvin', 
					'miranda@travelogy.com' => 'Miranda', 
					'zhengning@travelogy.com' => 'Zhengning',
					'nurmani@travelogy.com' => 'Nurmani',
					'suerou@travelogy.com' => 'Sue Rou Lim'
				);
			}else{
				if (isset($argv[3])){
					$sendtime=$starttime + floor($count/$SENDRATE)*60;
					$deliverby->setValue($sendtime);
				}else{
					usleep($sleep);
				}        
			}
			$message->setTo($email)->setBody($html, 'text/html');
			$numSent += $mailer->send($message, $failedRecipients);
		}
		catch (Swift_RfcComplianceException $e) {
			$failedEmails[]=$e->getMessage();
			print('Email address not valid:' . $e->getMessage() ."\n");
		}
		if ($DEBUG)
			echo ++$count." ($id) ".date('Y-m-d H:i:s')."\n";
		else{
			if (isset($argv[3])){
				echo ++$count." ($id) (mg header) $email ".date('Y-m-d H:i:s',$sendtime)."\n";
			}else{
				echo ++$count." ($id) (usleep) $email ".date('Y-m-d H:i:s')."\n";
			}  
		}
	}
	
  if ($listname=='list2') {
    $dbh->exec("UPDATE emaillist.`users` SET groupid='1' WHERE country='sg' AND groupid='2' ORDER BY id ASC LIMIT 7500");
  }
	
  $str ="Singapore EDM Email Sent"."\n";
  $str .= "$listname: Sent $numSent messages. Count : $count, Last id: $id"."\n";
  $str .= "Errors: ".implode(', ',$failedEmails)." ".implode(', ',$failedRecipients)."\n";
  $str .= "Ended at: ".date('Y-m-d H:i:s')."\n";
  $str .= "First email to deliver by :".date('Y-m-d H:i:s',$starttime)."\n";
  if (isset($argv[3])){
    $str .= "Last Email to deliver by (mg header): ".date('Y-m-d H:i:s',$sendtime)."\n";
  }else{
    $str .= "Last Email to deliver by (usleep): ".date('Y-m-d H:i:s')."\n";
  }
  
  echo $str;
  if (!$DEBUG)
    mail('eric.koh@travelogy.com, benjamin@travelogy.com, weiting@travelogy.com, alvin@travelogy.com, paulo@travelogy.com, ye.minhtut@travelogy.com, chinglee@travelogy.com', 'Singapore EDM Email Sent', $str); 
  
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

function generateDealsText($deals){
  $deals_txt='';
  foreach ($deals as $d) {
    $deals_txt.='*'.$d['title'].'*
'.$d['description'].'
';
  if ($d['comp_name']!='')
  $deals_txt.= $d['comp_name'].'
';
  $deals_txt.= $d['price'].'
'.$d['url'].'

';
  }
  return $deals_txt;
}

function generateArticlesText($articles){
	$deals_txt='';
	foreach($articles as $d){
		$deals_txt.='*'.$d['title'].'*
'.$d['url'].'

';
	}
	return $deals_txt;
}

function generateDealsHTML($deals,$utm_code='',$banner=array()){
	$html='';
	
	$banner_position=round((count($deals)/2))-1;
	foreach($deals as $k=>$deal){
		$deal_thumb=$deal['thumb'];
		$deal_title=$deal['title'];
		$deal_url=$deal['url'].'?'.$utm_code;
		$deal_price=$deal['price'];
		$deal_description=$deal['description'];
		$company_url=$deal['comp_url'];
		$company_name=$deal['comp_name'];
		
		$img_tracker='';
		if(strpos($company_name, 'Singtel')!==false){
			$img_tracker='<IMG SRC="https://ad.doubleclick.net/ddm/trackimp/N4021.1922721TRIPZILLA/B9599503.130443764;dc_trk_aid=303257562;dc_trk_cid=69901497;ord='.time().';dc_lat=;dc_rdid=;tag_for_child_directed_treatment=?" BORDER="0" HEIGHT="1" WIDTH="1" ALT="Advertisement">';
		}
		
		$html.=<<<EOF
<!--PACKAGE/DEAL-->
<tr align="center">
	<td width="12px"></td>
	<td valign="top">
		<table border="0" cellspacing="0" cellpadding="0" width="576px" style="font-size: 0; border:1px solid #e8e8e8;">
			<tr>
				<td width="574px" height="260px" valign="top">
					<a target="_blank" href="$deal_url" style="color:inherit; text-decoration:none">
					<img src="$deal_thumb" width="574px" height="260px">$img_tracker
					</a>
				</td>
			</tr>
			<tr>
				<td width="574px" valign="top" style="padding:10px 10px 0;">
					<a target="_blank" href="$deal_url" style="color:inherit; text-decoration:none">
					<p style="margin:0; padding:0; font-family: Arial,sans-serif; font-size:24px!important; font-weight:normal; color:#000; text-align:left; line-height:24px !important;">
						<!--[if mso]>
						<font face="Arial,sans-serif" size="3" color="000" style="margin:0; padding:0; width:169px; height:33px; font-weight:bold; color:#000; line-height:1.42857143!important">
						<![endif]-->
						$deal_title
						<!--[if mso]>
						</font>
						<![endif]-->
					</p>
					</a>
					<p style="margin:0; padding:5px 0 0; font-family: Arial,sans-serif; font-size:16px!important; font-weight:normal; color:#333; text-align:left; line-height:16px !important;">
					<a target="_blank" href="$company_url" style="color:inherit; text-decoration:none">
						<!--[if mso]>
						<font face="Arial,sans-serif" size="2" color="333" style="margin:0; padding:5px 0 0; font-weight:normal; color:#333; line-height:16px !important">
						<![endif]-->
						$company_name
						<!--[if mso]>
						</font>
						<![endif]-->
					</a> | <span style="font-weight:bold; color:#f81;">
						<!--[if mso]>
						<font face="Arial,sans-serif" size="2" color="f81" style="margin:0; padding:5px 0 0; font-weight:bold; color:#f81; line-height:16px !important">
						<![endif]-->
						$deal_price
						<!--[if mso]>
						</font>
						<![endif]-->
					</span>
					</p>
					<p style="margin:0; padding:20px 0 10px; font-family: Arial,sans-serif; font-size:18px!important; font-weight:normal; color:#333; text-align:left; line-height:22px !important;">
						<!--[if mso]>
						<font face="Arial,sans-serif" size="2" color="333" style="margin:0; padding:20px 0 10px; font-weight:normal; color:#333; line-height:14px !important">
						<![endif]-->
						$deal_description
						<!--[if mso]>
						</font>
						<![endif]-->
					</p>
				</td>
			</tr>
			<tr>
				<td width="330px" valign="top" style="padding:10px;">
					<a target="_blank" href="$deal_url" style="color:inherit; text-decoration:none">
					<p style="margin:0; padding:0; font-family: Arial,sans-serif; font-size:18px!important; font-weight:bold; color:#f81; text-align:right; line-height:22px !important;">
						<!--[if mso]>
						<font face="Arial,sans-serif" size="2" color="f81" style="margin:0; padding:20px 0 10px; font-weight:bold; color:#f81; line-height:14px !important">
						<![endif]-->
						FIND OUT MORE <span style="font-size: 18px !important; line-height: 0 !important;">&rsaquo;</span>
						<!--[if mso]>
						</font>
						<![endif]-->
					</p>
					</a>
				</td>
			</tr>
		</table>
	</td>
	<td width="12px"></td>
</tr>
<!--PACKAGE/DEAL-->

<tr height="16px" align="center"><!--WHITE SPACE-->
	<td colspan="3" valign="top" style="padding: 8px; font-size:0;">&nbsp;</td>
</tr>
EOF;
		
		if($k==$banner_position && (isset($banner['img1']) && isset($banner['link1']))){
			$banner_img=$banner['img1'];
			$banner_link=$banner['link1'];
			
			$html.=<<<EOF
<!--BANNER-->
<tr align="center">
	<td width="12px"></td>
	<td valign="top">
		<table border="0" cellspacing="0" cellpadding="0" width="576px" style="font-size: 0;">
			<tr>
				<td width="576px" height="96" valign="top">
					<a target="_blank" href="$banner_link" style="color:inherit; text-decoration:none">
						<img src="$banner_img" width="576px" height="96px">
					</a>
				</td>
			</tr>
		</table>
	</td>
	<td width="12px"></td>
</tr>
<!--BANNER-->

<tr height="16px" align="center"><!--WHITE SPACE-->
	<td colspan="3" valign="top" style="padding: 8px; font-size:0;">&nbsp;</td>
</tr>
EOF;
		}
	}
	
	return $html;
}

function generateArticlesHTML($articles,$utm_code=''){
	$html='';
	foreach($articles as $k=>$article){
		$article_thumb=$article['thumb'];
		$article_title=$article['title'];
		$article_description=$article['description'];
		$article_url=$article['url'].'?'.$utm_code;
		
		$html.=<<<EOF
<!--ARTICLE-->
<tr align="center">
	<td width="12px"></td>
	<td width="576px" valign="top">
		<a target="_blank" href="$article_url" style="color:inherit; text-decoration:none">
			<table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-size: 0; border:1px solid #e8e8e8;">
				<tr>
					<td width="244px" valign="top" rowspan="2">
						<img src="$article_thumb" width="244px">
					</td>
					<td width="330px" valign="top" style="padding:10px;">
						<p style="margin:0; padding:0; font-family: Arial,sans-serif; font-size:24px!important; font-weight:normal; color:#000; text-align:left; line-height:24px !important;">
							<!--[if mso]>
							<font face="Arial,sans-serif" size="3" color="000" style="margin:0; padding:20px 0; font-weight:normal; color:#000; line-height:24px !important">
							<![endif]-->
							$article_title
							<!--[if mso]>
							</font>
							<![endif]-->
						</p>
						<p style="margin:0; padding:20px 0; font-family: Arial,sans-serif; font-size:18px!important; font-weight:normal; color:#333; text-align:left; line-height:22px !important;">
							<!--[if mso]>
							<font face="Arial,sans-serif" size="2" color="333" style="margin:0; padding:20px 0; font-weight:normal; color:#333; line-height:14px !important">
							<![endif]-->
							$article_description
							<!--[if mso]>
							</font>
							<![endif]-->
						</p>
					</td>
				</tr>
				<tr>
					<td width="330px" valign="top" style="padding:10px;">
						<p style="margin:0; padding:0; font-family: Arial,sans-serif; font-size:18px!important; font-weight:bold; color:#f81; text-align:right; line-height:22px !important;">
							<!--[if mso]>
							<font face="Arial,sans-serif" size="2" color="f81" style="margin:0; padding:0; font-weight:bold; color:#f81; line-height:14px !important">
							<![endif]-->
							READ MORE <span style="font-size: 18px !important; line-height: 0 !important;">&rsaquo;</span>
							<!--[if mso]>
							</font>
							<![endif]-->
						</p>
					</td>
				</tr>
			</table>
		</a>
	</td>
	<td width="12px"></td>
</tr>
<!--ARTICLE-->

<tr height="16px" align="center"><!--WHITE SPACE-->
	<td colspan="3" valign="top" style="padding: 8px; font-size:0;">&nbsp;</td>
</tr>
EOF;
	}
	
	return $html;
}

function display_help_text() {
	return "
USAGE: php edm_sg.php <list> [<test>] [<time>]
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
