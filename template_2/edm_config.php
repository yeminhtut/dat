<?php
//=======================================
// Config & Prework
//=======================================
	$elements=array();
	
//=======================================
// Campaign Setup
//=======================================
	$utm_code='utm_source='.$listname.'&amp;utm_medium=email&amp;utm_campaign=edm_sg_160421'; //Tracking for travel deals and tour packages only
	$tag='sg_'.$listname.'_160421'; //For Opens and Clicks Tracking by Mailgun
	
//=======================================
// EDM Subject & Pre-Text
//=======================================
	$subject="✈ DEAL ALERT! Fly with SilkAir to Phuket fr SGD239 ONLY!";
	$pre_header="Valid till 24 April 2016. You don't want to miss this limited offer from SilkAir!";
	
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
	//regent star contest banner
	$elements['banner']['img1']="http://static.tripzilla.com/thumb/f/0/44016_576x96.jpg";
	$elements['banner']['link1']="http://www.tripzilla.com/TripZillaGiveaway?".$utm_code;
	$elements['banner']['img2']="http://static.tripzilla.com/thumb/e/a/42218_600x228.jpg";
	$elements['banner']['link2']="http://tripzilla.sg/focaltravel/packages?".$utm_code;
	$elements['banner']['link21']="http://tripzilla.sg/focaltravel/packages/taiwan?".$utm_code;
	$elements['banner']['link22']="http://tripzilla.sg/focaltravel/packages/thailand?".$utm_code;
	$elements['banner']['link23']="http://tripzilla.sg/focaltravel/packages/vietnam?".$utm_code;
	
	//SEPARATOR
	$elements['separator']['img1']="http://static.tripzilla.com/thumb/5/f/41823_576x53.jpg";
	$elements['separator']['img2']="http://static.tripzilla.com/thumb/6/0/41824_576x53.jpg";
	//$elements['separator']['img3']="http://static.tripzilla.com/thumb/7/8/41848_574x60.jpg";
	$elements['separator']['img3']="http://static.tripzilla.com/thumb/4/3/43587_574x60.jpg";
	
	//FOOTER
	//$elements['footer']['icon1']="http://static.tripzilla.com/thumb/7/5/41845_32x32.jpg";
	$elements['footer']['icon1']="http://tripzilla.sg/img/edm/icon-fb-32.png?8";
	$elements['footer']['link1']="http://tripzilla.sg/external-links/view/368";
	//$elements['footer']['icon2']="http://static.tripzilla.com/thumb/7/4/41844_32x32.jpg";
	//$elements['footer']['link2']="http://tripzilla.sg/travel/deals?".$utm_code;
	//$elements['footer']['icon3']="http://static.tripzilla.com/thumb/7/6/41846_32x32.jpg";
	//$elements['footer']['link3']="http://tripzilla.sg/travel?".$utm_code;
	
//=======================================
// EDM BODY - ARTICLES
//=======================================
	$articles[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/9/b/44187_244x222.jpg',
		'title' => 'Fly SIA or Silkair to Penang, Bangkok, Hong Kong from only S$148',
		'description' => 'Here\'s the chance to keep up with your 2016 travel resolution, be it a solo trip or a vacation with your loved ones, do it in the most budget-friendly way!',
		'url' => 'http://www.tripzilla.com/uob-sia-silkair-travel-packages/35340',
	);

	$articles[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/9/c/44188_244x222.jpg',
		'title' => 'Top 12 Things to Do in Kathmandu on Your Very First Visit',
		'description' => 'Can’t decide where to go and what to do in Kathmandu? Read this article to help you plan your next adventure!',
		'url' => 'http://www.tripzilla.com/nepal-kathmandu-things-to-do/35786',
	);
	
//=======================================
// EDM BODY - PACKAGES & DEALS
//=======================================
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/9/3/44179_574x260.jpg',
		'title' => 'All-in Return Fares to Phuket with SilkAir',
		'description' => 'The best way to relive fond memories is to make new ones. Now that\'s a joy to fly.<br/>Travel period: 03 May 2016 - 30 Jun 2016<br/>Book by: 24 Apr 2016',
		'price' => 'From SGD 239',
		'url' => 'http://tripzilla.sg/external-links/view/1170',
		'comp_name' => 'SilkAir ',
		'comp_url' => 'http://tripzilla.sg/silkair/travel-deals',
	);
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/9/4/44180_574x260.jpg',
		'title' => 'Two-to Travel Early Grab fares to North America',
		'description' => 'Plan your vacation ahead and save more with Cathay Pacific\'s special ALL-IN Early Grab fares to Los Angeles, San Francisco, New York, Boston, Chicago, Vancouver or Toronto now!<br/>Valid till: 26 Apr 2016',
		'price' => 'From SGD 1248',
		'url' => 'http://tripzilla.sg/travel/deal/47855',
		'comp_name' => 'Cathay Pacific',
		'comp_url' => 'http://tripzilla.sg/cathay-pacific/travel-deals',
	);
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/f/5/44021_574x260.jpg',
		'title' => 'Fly with Qatar Airways on your CostSaver holidays to France and Germany!!',
		'description' => 'Book any of these selected trips to enjoy this fantastic (all-inclusive) fare deal! PLUS, guests aged 50 & above gets additional S$50 air fare senior rebate!<br/>12D Highlights of Germany (17 Jun, 16 Sep)<br/>13D Highlights of France (23 Sep)<br/>Valid till: 30 Apr 2016',
		'price' => 'From SGD 638',
		'url' => 'http://tripzilla.sg/external-links/view/1171',
		'comp_name' => 'Trafalgar',
		'comp_url' => 'http://tripzilla.sg/trafalgar',
	);	
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/9/f/44191_574x260.jpg',
		'title' => '5D4N Saigon – Dalat Romantic Tour',
		'description' => 'Visit the Notre Dame cathedral, Post Office and Ben Thanh Market in Saigon. In Dalat, visit tea and coffee farms, flowers farm, Prenn Waterfall and Datanla Waterfall. Explore around Tuyen Lan lake and Bao Dai summer place, then continue your journey to Valley of love!',
		'price' => 'From SGD 528',
		'url' => 'http://tripzilla.sg/tour/package/66435',
		'comp_name' => 'Neway Travel Service Pte Ltd',
		'comp_url' => 'http://tripzilla.sg/neway-travel-service-pte-ltd',
	);

	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/9/7/44183_574x260.jpg',
		'title' => '4D3N Bangkok + 2 Way SQ Flight & more',
		'description' => 'Inclusive of 2 way economy class on Singapore Airlines, 3N hotel accommodation at Grand Alpine Hotel, Daily buffet breakfast and Half day city tour!',
		'price' => 'From SGD 390',
		'url' => 'http://tripzilla.sg/tour/package/35048',
		'comp_name' => 'Baba Travel',
		'comp_url' => 'http://tripzilla.sg/baba-travel',
	);
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/9/8/44184_574x260.jpg',
		'title' => '12-DAY Grand Mediterranean',
		'description' => 'Kids, friends and family as third and fourth guests in a stateroom sail for FREE. Ports of Call: Venice, Dubrovnik, Kotor, Athens, Mykonos, Naples, Rome, Florence/Pisa, Provence and Barcelona.',
		'price' => 'From USD 799',
		'url' => 'http://tripzilla.sg/travel/deal/47810',
		'comp_name' => 'Port & Porters',
		'comp_url' => 'http://tripzilla.sg/port-porters',
	);
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/9/9/44185_574x260.jpg',
		'title' => '3D2N Lexis Hibiscus Port Dickson',
		'description' => 'Inclusive of Two way coach transfer by SVIP 28-40 seaters coach, Two night accommodation Premium Pool Villa at Lexis Hibiscus Port Dickson and Hotel Buffet breakfast.',
		'price' => 'From SGD 289',
		'url' => 'http://tripzilla.sg/tour/package/66554',
		'comp_name' => 'WTS Travel & Tours',
		'comp_url' => 'http://tripzilla.sg/wts-travel-tours',
	);
	
	$deals[]=array(
		'thumb' => 'http://static.tripzilla.com/thumb/9/a/44186_574x260.jpg',
		'title' => '8D6N Southern Lakes & the Million Stars',
		'description' => 'Inclusive of 6N accommodation, detailed itinerary and comprehensive tour wallet, Milford Sound day trip, Jet Boat & Underwater Observatory and Stargazing night tours.',
		'price' => 'From SGD 2169',
		'url' => 'http://tripzilla.sg/tour/package/65098',
		'comp_name' => 'New Zealand Specialist',
		'comp_url' => 'http://tripzilla.sg/new-zealand-specialist',
	);
	
	