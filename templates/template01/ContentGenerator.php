<?php
class ContentGenerator{
//=======================================
// HTML Version
//=======================================

	static function generateDealsHTML($deals,$utm_code='',$banner=array()){
	$html=$even=$odd='';
	foreach($deals as $k=>$deal){
		$deal_thumb=$deal['thumb'];
		$deal_title=$deal['title'];
		$deal_url=$deal['url'].'?'.$utm_code;
		$deal_price=$deal['price'];
		$deal_description=$deal['description'];
		$company_url=$deal['comp_url'];
		$company_name=$deal['comp_name'];
		
		if(fmod($k,2)==0){
			$even=<<<EOF
			<a target="_blank" href="$deal_url" style="color:inherit; text-decoration:none">
				<table width="280px" border="0" cellspacing="0" cellpadding="0" class="even">
					<tr height="30px">
						<td>
							<img src="$deal_thumb" width="280px" height="210px" style="display: block; ">
						</td>
					</tr>
					<tr height="60px">
						<td align="center">
							<div style="display:inline-block; margin:0 auto; padding:6px; max-width: 280px; font-family: 'Roboto', sans-serif; font-size: 18px !important; color: #ffffff; text-align:center; line-height: 30px !important; background:#000000; border-radius: 8px;">
							$deal_price
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<p style="margin:0; padding:0; width: auto; font-family: 'Roboto', sans-serif; font-size: 18px !important; font-weight:bold; color: #1f74a7; text-align:center; line-height: 1.42857143 !important;">
							$deal_title
							</p>
						</td>
					</tr>
					<tr>
						<td align="center">
							<span style="margin:0; padding:0; font-family: 'Roboto', sans-serif; font-size: 15px !important; font-weight:normal; color: #000000; text-align:center; line-height: 1.42857143 !important;">by </span>
							<a target="_blank" href="$company_url" style="color:inherit; text-decoration:none;margin:0; padding:0; font-family: 'Roboto', sans-serif; font-size: 15px !important; font-weight:normal; font-style: normal; color: #1f74a7; text-align:center; line-height: 1.42857143 !important;">$company_name</a>
						</td>
					</tr>
				</table>
			</a>
EOF;
		}else if(fmod($k,2)==1){
			$odd=<<<EOF
			<a target="_blank" href="$deal_url" style="color:inherit; text-decoration:none">
				<table width="280px" border="0" cellspacing="0" cellpadding="0">
					<tr height="30px">
						<td>
							<img src="$deal_thumb" width="280px" height="210px" style="display: block; ">
						</td>
					</tr>
					<tr height="60px">
						<td align="center">
							<div style="display:inline-block; margin:0 auto; padding:6px; max-width: 280px; font-family: 'Roboto', sans-serif; font-size: 18px !important; color: #ffffff; text-align:center; line-height: 30px !important; background:#000000; border-radius: 8px;">
							$deal_price
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<p style="margin:0; padding:0; width: auto; font-family: 'Roboto', sans-serif; font-size: 18px !important; font-weight:bold; color: #1f74a7; text-align:center; line-height: 1.42857143 !important;">
							$deal_title
							</p>
						</td>
					</tr>
					<tr>
						<td align="center">
							<span style="margin:0; padding:0; font-family: 'Roboto', sans-serif; font-size: 15px !important; font-weight:normal; color: #000000; text-align:center; line-height: 1.42857143 !important;">by </span>
							<a target="_blank" href="$company_url" style="color:inherit; text-decoration:none;margin:0; padding:0; font-family: 'Roboto', sans-serif; font-size: 15px !important; font-weight:normal; font-style: normal; color: #1f74a7; text-align:center; line-height: 1.42857143 !important;">$company_name</a>
						</td>
					</tr>
				</table>
			</a>
EOF;
		}
		
		if($even && $odd){
			$html.='
					<tr align="center">
					<td width="12px"></td>
					<td valign="top">
						<table bgcolor="#ffffff" width="576px" border="0" cellspacing="0" cellpadding="0">						
						<tr>
							<td width="280px" valign="top">'.$even.'</td>
							<td width="16px"><table width="16px" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0"><tr><td style="padding: 8px; font-size:0;">&nbsp;</td></tr></table></td>
							<td width="280px" valign="top">'.$odd.'</td>
						</tr>
						<tr>
							<td colspan="3"><table bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0"><tr><td style="padding: 5px; font-size:0;">&nbsp;</td></tr></table></td>
						</tr>
					</table>
					</td>
					<td width="12px"></td>
				</tr>
				<!--BANNER-->

				<tr height="16px" align="center"><!--WHITE SPACE-->
					<td colspan="3" valign="top" style="padding: 8px; font-size:0;">&nbsp;</td>
				</tr>
			';
			$even=$odd='';
		}		

	}
	return $html;
}
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
					<tr align="center">
				<td width="12px"></td>
				<td valign="top">
					<table width="280px" border="0" cellspacing="0" cellpadding="0">
					<tr height="30px">
						<td>
							<img src="$deal_thumb" width="280px" height="210px" style="display: block; ">
						</td>
					</tr>
					<tr height="60px">
						<td align="center">
							<div style="display:inline-block; margin:0 auto; padding:0; width: 120px; max-width: 280px; font-family: 'Roboto', sans-serif; font-size: 18px !important; color: #ffffff; text-align:center; line-height: 30px !important; background:#000000; border-radius: 8px;">
							$deal_price
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<p style="margin:0; padding:0; width: auto; font-family: 'Roboto', sans-serif; font-size: 18px !important; font-weight:bold; color: #1f74a7; text-align:center; line-height: 1.42857143 !important;">
							$deal_title
							</p>
						</td>
					</tr>
					<tr>
						<td align="center">
							<span style="margin:0; padding:0; font-family: 'Roboto', sans-serif; font-size: 15px !important; font-weight:normal; color: #000000; text-align:center; line-height: 1.42857143 !important;">by </span>
							<a target="_blank" href="$company_url" style="color:inherit; text-decoration:none"><label style="margin:0; padding:0; font-family: 'Roboto', sans-serif; font-size: 15px !important; font-weight:normal; font-style: normal; color: #1f74a7; text-align:center; line-height: 1.42857143 !important;">$company_name</label></a>
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
	$html=$featured=$regular_even=$regular_odd='';
	foreach($articles as $k=>$article){
		$article_title=$article['title'];
		$article_description=$article['description'];
		$article_url=$article['url'].'?'.$utm_code;
		$article_thumb="";
		if($k==0)
			$article_thumb=$article['thumb'];
		
		if($k==0){
			$featured.=<<<EOF
			<tr>
				<td>
					<a target="_blank" href="$article_url" style="color:inherit; text-decoration:none">
					<table bgcolor="#231f20" width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 332px; max-width: 600px; max-height: 300px;">
						<tr>
							<td width="350px" style="height:300px; max-height:300px; overflow:hidden;">
								<div style="width:350px; height:300px; max-height:300px; background:#231f20; overflow:hidden;">
									<img src="$article_thumb" height="100%" style="display: block;">
								</div>
							</td>
							<td width="250px" style="height:300px; max-height:300px; overflow:hidden;">
								<div style="width:250px; background:#231f20; overflow:hidden;">
									<table width="250px" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20px"></td>
											<td>
												<p style="margin:0 auto; padding:5px; font-family: 'Playfair Display', serif; font-size: 22px !important; font-weight:bold; color: #ffffff; text-align:left; line-height: 1.4 !important;">
												$article_title
												</p>
											</td>
											<td width="20px"></td>
										</tr>
										<tr>
											<td width="20px"></td>
											<td>
												<p style="margin:0 auto; padding:5px; font-family: 'Roboto', sans-serif; font-size: 14px !important; font-weight:normal; color: #ffffff; text-align:left; line-height: 1.6 !important;">
												$article_description
												</p>
											</td>
											<td width="20px"></td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>
					</a>
				</td>
			</tr>
EOF;
		}else{
			if(fmod($k,2)==0){
				$regular_even.=<<<EOF
				<a target="_blank" href="$article_url" style="color:inherit; text-decoration:none">
				<table style="min-width: 300px; max-width: 300px;" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td style="padding: 10px; font-size:0;">&nbsp;</td></tr></table></td>
					</tr>
					<tr>
						<td width="10px"></td>
						<td valign="top" height="45px">
							<p style="margin:0 auto; padding:0 0 5px; font-family: 'Roboto',sans-serif; font-size: 15px !important; font-weight:bold; color: #231f20; text-align:left; line-height: 1.42857143 !important;">
							$article_title
							</p>
						</td>
						<td width="20px"></td>
					</tr>
					<tr>
						<td width="10px"></td>
						<td>
							<table style="min-width: 270px; max-width: 270px;" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<p style="margin:0 auto; padding:0 30px 0 0; font-family: 'Roboto', sans-serif; font-size: 14px !important; font-weight:normal; color: #231f20; text-align:left; line-height: 1.42857143 !important;">
										$article_description
										</p>
									</td>
									<td valign="bottom">
										<div style="padding:5px 15px; font-family: 'Roboto', sans-serif; font-size:11px !important; color:#ffffff; background:#231f20; border-radius: 8px;">READ</div>
									</td>
								</tr>
							</table>
						</td>
						<td width="20px"></td>
					</tr>
					<tr>
						<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td style="padding: 10px; font-size:0;">&nbsp;</td></tr></table></td>
					</tr>
				</table>
				</a>
EOF;
			}else if(fmod($k,2)==1){
				$regular_odd.=<<<EOF
				<a target="_blank" href="$article_url" style="color:inherit; text-decoration:none">
				<table style="min-width: 300px; max-width: 300px;" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td style="padding: 10px; font-size:0;">&nbsp;</td></tr></table></td>
					</tr>
					<tr>
						<td width="20px"></td>
						<td valign="top" height="45px">
							<p style="margin:0 auto; padding:0 0 5px; font-family: 'Roboto',sans-serif; font-size: 15px !important; font-weight:bold; color: #231f20; text-align:left; line-height: 1.42857143 !important;">
							$article_title
							</p>
						</td>
						<td width="10px"></td>
					</tr>
					<tr>
						<td width="20px"></td>
						<td>
							<table style="min-width: 270px; max-width: 270px;" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<p style="margin:0 auto; padding:0 30px 0 0; font-family: 'Roboto', sans-serif; font-size: 14px !important; font-weight:normal; color: #231f20; text-align:left; line-height: 1.42857143 !important;">
										$article_description
										</p>
									</td>
									<td valign="bottom">
										<div style="padding:5px 15px; font-family: 'Roboto', sans-serif; font-size:11px !important; color:#ffffff; background:#231f20; border-radius: 8px;">READ</div>
									</td>
								</tr>
							</table>
						</td>
						<td width="10px"></td>
					</tr>
					<tr>
						<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td style="padding: 10px; font-size:0;">&nbsp;</td></tr></table></td>
					</tr>
				</table>
				</a>
EOF;
			}
		}
	}
	
	$html=<<<EOF
	<tr>
		<td>
			<table bgcolor="#ffc388" width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 332px; max-width: 600px;">
				<tr>
					<td valign="top">
						$regular_odd
					</td>
					<td valign="top">
						$regular_even
					</td>
				</tr>
			</table>
		</td>
	</tr>
EOF;
	$html=$featured.$html;
	
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