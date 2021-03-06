<?php
//=======================================
// Test Emails
//=======================================
	$test_emails=array(
		//'paulo@travelogy.com' => 'Paulo', 
		'ye.minhtut@travelogy.com' => 'Ye Min', 
		// 'alvin@travelogy.com' => 'Alvin', 
		// 'miranda@travelogy.com' => 'Miranda', 
		// 'zhengning@travelogy.com' => 'Zhengning', 
		// 'nurmani@travelogy.com' => 'Nurmani', 
		// 'suerou@travelogy.com' => 'Sue Rou Lim',
		// 'seewah@tripzilla.com' => 'See Wah Ho'
	);
	
//=======================================
// Config & Prework
//=======================================
	$elements=array();
	$template_type="template02";
	
	/*
	List of templates:
		- template01
		- template02
	*/
	
//=======================================
// Campaign Setup
//=======================================
	$utm_code='utm_source='.$listname.'&amp;utm_medium=email&amp;utm_campaign=edm_sg_160526'; //Tracking for travel deals and tour packages only
	$tag='sg_'.$listname.'_160526'; //For Opens and Clicks Tracking by Mailgun
	
//=======================================
// EDM Subject & Pre-Text
//=======================================
	$subject="✈ Have Yourself a Short Weekend Getaway!";
	$pre_header="Stay at Some of the Best Hotels in Singapore and KL for as Low as 50%! ";
	
//=======================================
// EDM Elements
//=======================================
	//HEADER - LOGO
	$elements['header']['logo_img']="http://static.tripzilla.com/thumb/d/4/38100_203x45.jpg";
	$elements['header']['logo_url']="http://tripzilla.sg/?".$utm_code;
	$elements['header']['quote_img']="http://static.tripzilla.com/thumb/d/6/38102_176x16.jpg";
	
	//HEADER - NAVIGATIONS
	$elements['header']['navigation1_text']="TOUR PACKAGES";
	$elements['header']['navigation1_url']="http://tripzilla.sg/travel?".$utm_code;
	$elements['header']['navigation2_text']="FLIGHTS";
	$elements['header']['navigation2_url']="https://flyzilla.com/?".$utm_code;
	$elements['header']['navigation3_text']="TRIPZILLA MAGAZINE";
	$elements['header']['navigation3_url']="http://magazine.tripzilla.com/?".$utm_code;
	$elements['header']['navigation4_text']="SALE";
	$elements['header']['navigation4_url']="http://tripzilla.sg/travel/deals?".$utm_code;
	
	//BANNER
	//flyzilla
	// $elements['banner']['img1']="http://static.tripzilla.com/thumb/6/4/31076_576x123.jpg";
	// $elements['banner']['link1']="http://flyzilla.com/?".$utm_code;
	//contest banner
	$elements['banner']['img1']="http://static.tripzilla.com/thumb/c/2/46274_576x123.jpg";
	$elements['banner']['link1']="http://tripzilla.sg/external-links/view/1254?".$utm_code;
	
	//Focal Travel - Destination Experts
	$elements['banner']['img2']="http://static.tripzilla.com/thumb/e/a/42218_600x228.jpg";
	$elements['banner']['link2']="http://tripzilla.sg/focaltravel/packages?".$utm_code;
	$elements['banner']['link21']="http://tripzilla.sg/focaltravel/packages/taiwan?".$utm_code;
	$elements['banner']['link22']="http://tripzilla.sg/focaltravel/packages/thailand?".$utm_code;
	$elements['banner']['link23']="http://tripzilla.sg/focaltravel/packages/vietnam?".$utm_code;
	
	//SEPARATOR
	$elements['separator']['img1']="http://static.tripzilla.com/thumb/5/f/41823_576x53.jpg";
	$elements['separator']['img2']="http://static.tripzilla.com/thumb/6/0/41824_576x53.jpg";
	$elements['separator']['img3']="http://static.tripzilla.com/thumb/4/3/43587_574x60.jpg";
	
	//FOOTER
	$elements['footer']['icon1']="http://tripzilla.sg/img/edm/icon-fb-32.png?8";
	$elements['footer']['link1']="http://tripzilla.sg/external-links/view/368";
	
//=======================================
// FOR DB Records
//=======================================
	$elements['header_footer']['banner']=str_replace($utm_code, '', $elements['banner']['link1']);
	$elements['header_footer']['TZ SG Logo']=str_replace($utm_code, '', $elements['header']['logo_url']);
	$elements['header_footer']['Tour Packages']=str_replace($utm_code, '', $elements['header']['navigation1_url']);
	$elements['header_footer']['Flights']=str_replace($utm_code, '', $elements['header']['navigation2_url']);
	$elements['header_footer']['TripZilla Magazine']=str_replace($utm_code, '', $elements['header']['navigation3_url']);
	$elements['header_footer']['SALE']=str_replace($utm_code, '', $elements['header']['navigation4_url']);
	$elements['header_footer']['Like TripZilla Travel Facebook Page']=$elements['footer']['link1'];
	
//=======================================
// EDM BODY - ARTICLES
//=======================================	
	
	$articles[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/0/2/47106_244x222.jpg',
		'title' => 'Summer in Korea: Fantastic Things to Do During this Special Season',
		'description' => 'While many tourists flock to Korea during winter, relatively few people go there during summer. But wait – why not?!',
		'url' => 'http://www.tripzilla.com/summer-korea-fantastic-things-special-season/36845',
	);

	$articles[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/0/8/47112_244x222.jpg',
		'title' => '[HOT FLIGHT DEALS] Singapore to Thailand and Cambodia from Just S$299 All-In',
		'description' => 'Don\'t you know? Good things must share!',
		'url' => 'http://www.tripzilla.com/silkair-hot-flight-deals-singapore-thailand-cambodia/37254',
	);
	
//=======================================
// EDM BODY - PACKAGES & DEALS
//=======================================
	//FLIGHT DEALS
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/3/7/47159_574x260.jpg',
		'title' => 'Cheap Flights to Melbourne! ',
		'description' => 'Melbourne has been voted the most liveable city – consecutively for the 5th time! It is also Australia’s capital for food, arts, sports, events and fashion. Plan your own Melbourne adventure today!<br/>Valid till: 29 May 2016',
		'price' => 'From SGD 179',
		'url' => 'http://tripzilla.sg/external-links/view/1311',
		'comp_name' => 'Scoot',
		'comp_url' => 'http://tripzilla.sg/external-links/view/1312',
	);
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/3/8/47160_574x260.jpg',
		'title' => 'Up to 50% Off Award-winning Hotels in Singapore and KL',
		'description' => 'Far East Hospitality, the leading hospitality operator in Singapore, just launched their new website. To celebrate, enjoy up to 50% off 11 hotels! Choose from top boutique hotels- AMOY and The Quincy Hotel- to the newest and most iconic business hotel in the CBD, Oasia Hotel Downtown.',
		'price' => 'From SGD 120',
		'url' => 'http://tripzilla.sg/external-links/view/1313',
		'comp_name' => 'Far East Hospitality',
		'comp_url' => 'http://tripzilla.sg/far-east-hospitality/travel-deals',
	);
	
	//NON-FLIGHT DEALS
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/0/5/47109_574x260.jpg',
		'title' => 'Shop and Stay Package',
		'description' => 'Book 7 days in advance and receive S$300 Shopping Vouchers, one TWG Tea High-tea set (worth S$39++) and a goodie bag (worth S$200) per night of your stay in Marina Bay Sands.',
		'price' => 'From SGD 639',
		'url' => 'https://tripzilla.sg/travel/deal/48453',
		'comp_name' => 'Marina Bay Sands',
		'comp_url' => 'https://tripzilla.sg/directory/review/1920/marina-bay-sands',
	);
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/0/4/47108_574x260.jpg',
		'title' => '3D2N Budget Bali',
		'description' => 'Enjoy a day away from the hustle and bustle of the city! Inclusive of 3N accommodation, Airport Transfer, Meals and Multi-day Trip.',
		'price' => 'From SGD 250',
		'url' => 'https://tripzilla.sg/tour/package/64084',
		'comp_name' => 'Baba Travel',
		'comp_url' => 'http://tripzilla.sg/baba-travel',
	);
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/3/a/47162_574x260.jpg',
		'title' => 'All-in Return Fares to Phuket with SilkAir',
		'description' => 'Now that\'s a joy to fly. Take advantage of this special promo fare, book your seat now!',
		'price' => 'From SGD 299',
		'url' => 'http://tripzilla.sg/external-links/view/1314',
		'comp_name' => 'SilkAir',
		'comp_url' => 'http://tripzilla.sg/silkair/travel-deals',
	);
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/3/9/47161_574x260.jpg',
		'title' => '11D8N Adventure To The Balkans',
		'description' => 'Visit Croatia, Slovenia & Bosnia! Highlights include scenic lunch on clifftop castle overlooking Lake Bled, Plitvice Lake National Park, Ljubjana castle, Rastoke water mills and Venice Macarthurglen designer outlets.',
		'price' => 'From SGD 1888',
		'url' => 'https://tripzilla.sg/tour/package/65832',
		'comp_name' => 'EU Holidays',
		'comp_url' => 'http://tripzilla.sg/eu-holidays',
	);

	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/b/c/46268_574x260.jpg',
		'title' => 'DataRoam Daily 100MB',
		'description' => 'Whether checking urgent messages, locating the nearest restaurant, or updating friends of your latest conquest, the DataRoam Daily 100MB Plan has you covered. DataRoam Daily 100MB is now available in more than 100 countries! With just the right amount of data for your needs, you can stay in control of your roaming spend.',
		'price' => 'From SGD 10/day',
		'url' => 'http://tripzilla.sg/external-links/view/1315',
		'comp_name' => 'Singtel',
		'comp_url' => 'http://tripzilla.sg/external-links/view/1316',
	);
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/0/6/47110_574x260.jpg',
		'title' => '2D1N Malacca Free & Easy',
		'description' => 'Inclusive of two-way SVIP coach operated by Konsortium / 707 / Transtar, and 1N accomodation at choice of hotel with breakfast.<br/>Valid till: 31 Dec 2016',
		'price' => 'From SGD 88',
		'url' => 'https://tripzilla.sg/tour/package/66009',
		'comp_name' => 'Transtar Travel',
		'comp_url' => 'http://tripzilla.sg/transtar-travel',
	);

	