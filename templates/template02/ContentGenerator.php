<?php
class ContentGenerator{
//=======================================
// HTML Version
//=======================================

	
	static function DealHTML($deals,$utm_code='',$banner=array()){
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
	
	static function ArticleHTML($articles,$utm_code=''){
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
	
//=======================================
// TEXT Version
//=======================================
	static function DealText($deals){
		$text='';
  foreach ($deals as $deal) {
		$title=$deal['title'];
		$description=(isset($deal['description'])?$deal['description']:'');
		$comp_name=$deal['comp_name'];
		$price=$deal['price'];
		$url=$deal['url'];
		
		$text.=<<<EOF
*$title*
$description
$comp_name
$price
$url

EOF;
		}
		
		return $text;
	}
	
	static function ArticleText($articles){
		$text='';
		foreach($articles as $article){
			$title=$article['title'];
			$description=(isset($article['description'])?$article['description']:'');
			$url=$article['url'];
			
			$text.=<<<EOF
*$title*
$description
$url

EOF;
		}
		
		return $text;
	}
}