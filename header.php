<?php
//INCLUDES THE IFSCCODE CLASS FILE
include 'classes/ifsccode.php';
//CREATES THE OBJECT
$actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$new = new IFSCcodes;

if(isset($_GET['bank_name']) AND isset($_GET['state']) AND isset($_GET['district']) AND isset($_GET['branch'])){
    $bank_name =  str_replace('-',' ', $_GET['bank_name']);
    $bank_name = strtoupper($bank_name);
    $state =    str_replace('-',' ',$_GET['state']);
    $state = strtoupper($state);
    $district =  str_replace('-',' ', $_GET['district']);
    $district = strtoupper($district);
    $branch = str_replace('-', ' ',$_GET['branch']);
    $branch = strtoupper($branch);
		$new->getInfo($bank_name, $state, $district, $branch);


		$title = "".ucwords(str_replace('-',' ',$_GET['bank_name']))." ".ucwords(str_replace('-',' ',$_GET['branch']))." IFSC Code, MICR Code & Branches details of ".ucwords(str_replace('-',' ',$_GET['branch']))." ".ucwords(str_replace('-',' ',$_GET['district']))." ".ucwords(str_replace('-',' ',$_GET['state']))." - Sarkari Bank";
		$des = "Get Details of ".ucwords(str_replace('-',' ',$_GET['bank_name']))." ".ucwords(str_replace('-',' ',$_GET['branch']))." ".ucwords(str_replace('-',' ',$_GET['district']))." IFSC code, MICR code and ".ucwords(str_replace('-',' ',$_GET['bank_name']))." ".ucwords(str_replace('-',' ',$_GET['branch']))." branch.";
		$keywords = "".str_replace('-',' ',$_GET['bank_name'])." ".str_replace('-',' ',$_GET['branch'])." ".str_replace('-',' ',$_GET['district'])." ifsc code, ".str_replace('-',' ',$_GET['bank_name'])." ".str_replace('-',' ',$_GET['branch'])." ".str_replace('-',' ',$_GET['district'])." micr code";
		$ogimage = "https://localhost/images/ifsc/".$new->ifsc.".jpg";
		
		
		
		
	}elseif(isset($_GET['bank_name']) AND !isset($_GET['state']) AND !isset($_GET['district']) AND !isset($_GET['branch'])){
	    
	    
		$title = "".ucwords(str_replace('-',' ',$_GET['bank_name']))." IFSC Code, MICR Code & Addresses in India - Sarkari Bank";
		$des = "Get here ".ucwords(str_replace('-',' ',$_GET['bank_name']))." IFSC code, MICR code and all ".ucwords(str_replace('-',' ',$_GET['bank_name']))." branch address by State Wise list only at localhost";
		$keywords = "".str_replace('-',' ',$_GET['bank_name'])." ifsc code, ".str_replace('-',' ',$_GET['bank_name'])." micr code";
		$ogimage = "https://localhost/images/ifsc-code.jpg";
		
	}elseif(isset($_GET['bank_name']) AND isset($_GET['state']) AND !isset($_GET['district']) AND !isset($_GET['branch'])){
	    
	    
		$title ="".ucwords(str_replace('-',' ',$_GET['bank_name']))." ".ucwords(str_replace('-',' ',$_GET['state']))." IFSC Code, MICR Code & Branches in ".ucwords(str_replace('-',' ',$_GET['state']))." India - Sarkari Bank";
		$des = "Find here ".ucwords(str_replace('-',' ',$_GET['bank_name']))." ".ucwords(str_replace('-',' ',$_GET['state']))." IFSC code, MICR code and all ".ucwords(str_replace('-',' ',$_GET['bank_name']))." ".ucwords(str_replace('-',' ',$_GET['state']))." branch address by District Wise list only at localhost";
		$keywords = "".str_replace('-',' ',$_GET['bank_name'])." ".str_replace('-',' ',$_GET['state'])." ifsc code, ".str_replace('-',' ',$_GET['bank_name'])." ".str_replace('-',' ',$_GET['state'])." micr code";
		$ogimage = "https://localhost/images/ifsc-code.jpg";
		
	}elseif(isset($_GET['bank_name']) AND isset($_GET['state']) AND isset($_GET['district']) AND !isset($_GET['branch'])){
	    
	    
		$title = "".ucwords(str_replace('-',' ',$_GET['bank_name']))." ".ucwords(str_replace('-',' ',$_GET['district']))." IFSC Code, MICR Code & Branches in ".ucwords(str_replace('-',' ',$_GET['district']))." ".ucwords(str_replace('-',' ',$_GET['state']))." - Sarkari Bank";
		$des = "Find here ".ucwords(str_replace('-',' ',$_GET['bank_name']))." ".ucwords(str_replace('-',' ',$_GET['state']))." ".ucwords(str_replace('-',' ',$_GET['district']))." IFSC code, MICR code and all ".ucwords(str_replace('-',' ',$_GET['bank_name']))." ".ucwords(str_replace('-',' ',$_GET['district']))." ".ucwords(str_replace('-',' ',$_GET['state']))." branch address by Branch Wise list only at localhost";
		$keywords = "".str_replace('-',' ',$_GET['bank_name'])." ".str_replace('-',' ',$_GET['district'])." ".str_replace('-',' ',$_GET['state'])." ifsc code, ".str_replace('-',' ',$_GET['bank_name'])." ".str_replace('-',' ',$_GET['district'])." ".str_replace('-',' ',$_GET['state'])." micr code";
		$ogimage = "https://localhost/images/ifsc-code.jpg";
		
	}

	else{
		$title = "IFSC Code Finder - Search for IFSC & MICR Codes of All Bank Branches in India | Sarkari Bank";
		$des = "Find List of All Banks IFSC & MICR Codes with Branch Details. Indian Financial System Code (IFSC) is a 11-Digit Alphanumeric Code Used to Identify Bank Branches. IFSC Code is Used to Transfer Money via &#10004; NEFT &#10004; RTGS & &#10004; IMPS";
		$keywords = "bank ifsc codes, ifsc code, micr code, indian financial system code";
		$ogimage = "https://localhost/images/ifsc-code.jpg";
	}
	
?>
<!--HTML PAGE STARTS FROM HERE-->
<!DOCTYPE html>
<html lang="en-IN">
<head>
<meta http-equiv="Cache-Control" content="no-store"/>
<!-- HTTP 1.0 -->
<meta http-equiv="Pragma" content="no-cache"/>
<!-- Prevents caching at the Proxy Server -->
<meta http-equiv="Expires" content="0"/>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width">
<meta name="format-detection" content="telephone=no"/>
<meta name="theme-color" content="#e5e5e5" />
<title><?php echo $title; ?></title>
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="description" content="<?php echo $des; ?>">
<link rel="canonical" href="<?php echo "".$actual_link.""; ?>">
<meta property="og:locale" content="en_IN">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:description" content="<?php echo $des; ?>">
<meta property="og:url" content="<?php echo "".$actual_link.""; ?>">
<meta property="og:site_name" content="SarkariBank">
<meta property="og:image" content="<?php  echo $ogimage; ?>" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:description" content="<?php echo $des; ?>">
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:site" content="@sarkaribank">
<meta name="twitter:creator" content="@sarkaribank">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="application-name" content="IFSC Code Finder">
<meta name="apple-mobile-web-app-title" content="IFSC Code Finder">
<meta name="msapplication-starturl" content="https://localhost">
<meta name="msvalidate.01" content="0D863F350C52AEFA32D6792AF7EF3FFF" />
<meta name="yandex-verification" content="3e6e5b8f89ac3894" />

<link rel="icon" href="/images/favicon.png">
<link rel="manifest" href="/manifest.json">
<!-- Bootstrap CSS File -->
<link href="/style-min.css" rel="stylesheet">
<!-- Call from main domain CSS File -->
<meta name="google-site-verification" content="Kyr3Gc_h6uMZOIYh_UVKwWqN-9GUvocPfp1krYFGirE" />
<link rel="apple-touch-icon" href="/images/192.png"/>

</head>

<body>


<header>
<!------ Include the above in your HEAD tag ---------->
<div class="topnav" id="myTopnav">
<div class="header-logo"><a href="https://localhost/"><ht class="cb">Sarkari</ht>Bank</a></div>
<div class="nav-mmemu">
  <a target="blank" href="https://localhost/">Home</a>
  <a target="blank" href="https://localhost/search-by-ifsc">IFSC Code</a>
  <a href="https://localhost/search-by-micr">Micr Code</a>
  <a href="https://localhost/search-by-pincode">Pin Code</a>
  <a aria-label='SarkariBank_search' href="" class="sbicon"><i class="icon-search cb"></i></a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
  
  
</div></div></header>