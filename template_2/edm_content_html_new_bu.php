<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
		<title><?=$subject?> - <?=$pre_header?></title>
	</head>
	<body style="margin: 0; padding: 0;" bgcolor="#ffffff">
		<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
			<tr>
				<td>
					<table width="600" height="auto" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
						<tr height="32px">
							<td colspan="3" valign="top" style="padding: 16px; font-size:0; background: #ffffff;">&nbsp;</td>
						</tr>
						<tr align="center">
							<td colspan="3" valign="top">
								<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr height="24px">
										<td colspan="3" valign="top" style="padding: 12px; font-size:0;">&nbsp;</td>
									</tr>
									<tr>
										<td valign="top" style="padding: 6px; font-size:0;">&nbsp;</td>
										<td>
											<table border="0" cellspacing="0" cellpadding="0" width="576px">
												<tr>
													<td>
														<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 300px; max-width: 576px;">
															<tr>
																<td>
																	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 230px; max-width: 230px;">
																		<tr>
																			<td width="230px" style="min-width: 230px; max-width: 230px;">
																				<a target="_blank" href="<?=$elements['header']['logo_url']?>" style="color:inherit; text-decoration:none">
																					<img src="<?=$elements['header']['logo_img']?>" height="45" style="display: block;">
																				</a>
																			</td>
																		</tr>
																	</table>
																</td>
																<td valign="bottom">
																	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 346px; max-width: 346px;">
																		<tr>
																			<td width="auto" align="right" style="padding:0 0 5px;">
																				<img src="<?=$elements['header']['quote_img']?>" height="16" />
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<td valign="top" style="padding: 6px; font-size:0;">&nbsp;</td>
									</tr>
									<tr height="12px">
										<td colspan="3" valign="top" style="padding: 6px; font-size:0;">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr align="center">
							<td colspan="3" valign="top">
								<table border="0" cellspacing="0" cellpadding="0" width="600px" height="35" style="font-size:0; border-top:1px solid #e8e8e8; border-bottom:1px solid #e8e8e8;">
									<tr>
										<td width="169px">
											<a target="_blank" href="<?=$elements['header']['navigation1_url']?>" style="display: table-cell; vertical-align: middle; width:169px; height:35px; padding:0; font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 13px !important; font-weight:bold; text-align:center; text-decoration:none; color:#231f20;"><?=$elements['header']['navigation1_text']?></a>
										</td>
										<td width="4px">
											<div style="width:1px; height:24px; padding:0; border-right:1px dashed #d7d7d7;"></div>
										</td>
										<td width="125px">
											<a target="_blank" href="<?=$elements['header']['navigation2_url']?>" style="display: table-cell; vertical-align: middle; width:125px; height:35px; padding:0; font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 13px !important; font-weight:bold; text-align:center; text-decoration:none; color:#231f20;"><?=$elements['header']['navigation2_text']?></a>
										</td>
										<td width="4px">
											<div style="width:1px; height:24px; padding:0; border-right:1px dashed #d7d7d7;"></div>
										</td>
										<td width="169px">
											<a target="_blank" href="<?=$elements['header']['navigation3_url']?>" style="display: table-cell; vertical-align: middle; width:169px; height:35px; padding:0; font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 13px !important; font-weight:bold; text-align:center; text-decoration:none; color:#231f20;"><?=$elements['header']['navigation3_text']?></a>
										</td>
										<td width="4px">
											<div style="width:1px; height:24px; padding:0; border-right:1px dashed #d7d7d7;"></div>
										</td>
										<td width="125px">
											<a target="_blank" href="<?=$elements['header']['navigation4_url']?>" style="display: table-cell; vertical-align: middle; width:125px; height:35px; padding:0; font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 13px !important; font-weight:bold; text-align:center; text-decoration:none; color:#f81;"><?=$elements['header']['navigation4_text']?></a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr height="16px" align="center"><!--WHITE SPACE-->
							<td colspan="3" valign="top" style="padding: 8px; font-size:0;">&nbsp;</td>
						</tr>
						<tr align="center"><!--SEPARATOR 1-->
							<td width="12px"></td>
							<td valign="top">
								<img src="<?=$elements['separator']['img1']?>" width="576px">
							</td>
							<td width="12px"></td>
						</tr>
						
						<?=generateDealsHTML($deals,$utm_code,$elements['banner'])?>
						
						<tr align="center">
							<td colspan="3" valign="top">
								<a target="_blank" href="<?=$elements['banner']['link2']?>" style="color:inherit; text-decoration:none">
									<img usemap="#destination-expert" src="<?=$elements['banner']['img2']?>" alt="Looking to explore Vietnam, Thailand or Taiwan? Focal Travel's got you covered!" width="600" height="228" style="display: block;">
								</a>
								<map name="destination-expert">
									<area shape="rect" coords="120,95,205,205" href="<?=$elements['banner']['link21']?>" alt="Taiwan Expert" title="Taiwan Expert">
									<area shape="rect" coords="260,95,345,205" href="<?=$elements['banner']['link22']?>" alt="Thailand Expert" title="Thailand Expert">
									<area shape="rect" coords="395,95,480,205" href="<?=$elements['banner']['link23']?>" alt="Vietnam Expert" title="Vietnam Expert">
								</map>
							</td>
						</tr>
						
						<tr height="16px" align="center"><!--WHITE SPACE-->
							<td colspan="3" valign="top" style="padding: 8px; font-size:0;">&nbsp;</td>
						</tr>
						
						<tr align="center"><!--SEPARATOR 2-->
							<td width="12px"></td>
							<td valign="top">
								<img src="<?=$elements['separator']['img2']?>" width="576px">
							</td>
							<td width="12px"></td>
						</tr>
						
						<tr height="16px" align="center"><!--WHITE SPACE-->
							<td colspan="3" valign="top" style="padding: 8px; font-size:0;">&nbsp;</td>
						</tr>
						
						<?=generateArticlesHTML($articles,$utm_code)?>
						
						<tr align="center"><!--SEPARATOR 3-->
							<td width="12px"></td>
							<td valign="top">
								<img src="<?=$elements['separator']['img3']?>" width="576px">
							</td>
							<td width="12px"></td>
						</tr>
						<!--FOOTER ICONS-->
						<tr align="center">
							<td width="12px"></td>
							<td valign="top">
								<table border="0" cellspacing="0" cellpadding="0" width="576px" style="font-size: 0;">
									<tr>
										<td width="208px" height="32px">&nbsp;</td>
										<td width="32px" height="32px">
											<a target="_blank" href="<?=$elements['footer']['link1']?>" style="color:inherit; text-decoration:none;">
												<img src="<?=$elements['footer']['icon1']?>" width="32px" height="32px">
											</a>
										</td>
										<td width="32px" height="32px">&nbsp;</td>
										<td width="32px" height="32px">
											<a target="_blank" href="<?=$elements['footer']['link2']?>" style="color:inherit; text-decoration:none;">
												<img src="<?=$elements['footer']['icon2']?>" width="32px" height="32px">
											</a>
										</td>
										<td width="32px" height="32px">&nbsp;</td>
										<td width="32px" height="32px">
											<a target="_blank" href="<?=$elements['footer']['link3']?>" style="color:inherit; text-decoration:none;">
												<img src="<?=$elements['footer']['icon3']?>" width="32px" height="32px">
											</a>
										</td>
										<td width="208px" height="32px">&nbsp;</td>
									</tr>
								</table>
							</td>
							<td width="12px"></td>
						</tr>
						<!--FOOTER ICONS-->
						<tr height="16px" align="center"><!--WHITE SPACE-->
							<td colspan="3" valign="top" style="padding: 8px; font-size:0;">&nbsp;</td>
						</tr>
						<tr height="32px">
							<td colspan="3" valign="top" style="padding: 16px; font-size:0; background: #ffffff;">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" style="font-family: 'Roboto', sans-serif; font-size: 10px !important; color: #666666; line-height: 1.42857143 !important; padding-bottom: 10px">
						<tr>
							<td>
								<div style="direction: ltr; text-align: center">
									To unsubscribe, please click <a style="color:#999" href="http://mailer.travelogy.com/tz_unsubscribe.php?email=<?=$email?>&amp;cp=biweeklyedm&amp;c=sg&amp;h=<?=$hash?>">here</a>.
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>