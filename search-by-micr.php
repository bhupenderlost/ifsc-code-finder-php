<?php 
/*
	* This files contains the select tag <select>.
	* This is the main file and should be edited with caution
	* Author: Bhupender Singh
	* Author URL: www.facebook.com/bhu08
*/
?>
	
	<!--SELECT BANK NAME ELEMENT(START)-->
	<?php
	include 'classes/searchmcir.php';
$keywords = "IFSC code finder, ifsc code, ifsc finder, find ifsc code";

	if(!isset($_GET['q'])){
	    $title = "Search Bank By MICR Code - Sarkari Bank";
	    $des = "Locate Your Bank By Just Putting The MICR Code Of Your Bank..";
		$keywords = "IFSC code finder, ifsc code, ifsc finder, find ifsc code";
	}else{
	        $title = "Result For - ".$_GET['q']." - Sarkari Bank";
	    $search = "Search Result For: ".$_GET['q'];
	    
	}
    $new = new ifscmicr;



?>
<!--HTML PAGE STARTS FROM HERE-->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<meta name="keywords" content="HTML,CSS,XML,JavaScript">
<meta name="description" content="<?php echo $des; ?>">
<link rel="canonical" href="https://ifsc.localhost/">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:description" content="<?php echo $des; ?>">
<meta property="og:url" content="https://localhost/">
<meta property="og:site_name" content="SarkariBank">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:description" content="<?php echo $des; ?>">
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:site" content="@sarkaribank">
<meta name="twitter:creator" content="@sarkaribank">
<link rel="icon" href="/images/favicon.ico">
<link rel="apple-touch-icon" href="/images/favicon.ico">


<!-- Bootstrap CSS File -->
<link href="style.css" rel="stylesheet">
<script src="js/menu.js" type="text/javascript"></script>
<!-- Call from main domain CSS File -->
</head>
<header>
<!------ Include the above in your HEAD tag ---------->
<div class="topnav" id="myTopnav">
<div class="header-logo"><a href="https://ifsc.localhost/"><img width="200" height="30" src="images/sarkari-bank-logo.png" alt="SarkariBank IFSC Code"></a></div>
<div class="nav-mmemu">
  <a target="blank" href="https://localhost/">Home</a>
  <a target="blank" href="https://ifsc.localhost/search-by-ifsc">IFSC Code</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
  <a href="#" class="sbicon"><i class="fa fa-search"></i></a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
  
  
</div></div></header>



	    <div class='main-search-details'><h1>Find Branch Details/Address/MICR Code By Pin Code.</h1><div class='search-box'><form method='GET'>
        <input type="text" placeholder="MICR CODE HERE" name="q" >
        <button>Search</button>
    </form>
    </div>
    </div>

	<br>

<div class="site-inner">
<div class="content">
<?php	
	 if(isset($_GET['q'])){
	     $query = $_GET['q'];
	    $new->find($query); 

	    if($new->bankname != 'a'){
	 echo "<div class='breadcrumb'><span><a href='$url'>HOME</a> » </span><span><a title='".$new->bankname."' href='".str_replace(' ', '-',strtolower($new->bankname))."/'>".$new->bankname."</a> » </span><span><a href='$url/".str_replace(' ', '-',strtolower($new->bankname))."/".str_replace(' ', '-',strtolower($new->state))."/'>".$new->state."</a> » </span><span><a href='$url/".str_replace(' ', '-',strtolower($new->bankname))."/".str_replace(' ', '-',strtolower($new->state))."/".str_replace(' ', '-',strtolower($new->district))."/'>".$new->district."</a> » </span><span>".$new->branch."</span></div>
		<h1 class='entry-title'>".$new->bankname." ".$new->branch." IFSC Code, MICR code & Branch  Details</h1>
		<p>The <b>IFSC Code of ".$new->bankname." ".$new->branch."</b> Branch is <b>".$new->ifsc."</b> and MICR Code is <b>".$new->mcir."</b> (used for RTGS,IMPS and NEFT transactions). The address of <b>".$new->branch."</b> branch of ".$new->bankname." is ".$new->address.".  This branch is located on the Pincode <b>".$new->zip."</b> in <b>".$new->district."</b> district of <b>".$new->state."</b> state.</p><div class='ifsc-full-details'>
<table>
<tbody>
<tr>
<td>Bank</td>
<td><a id='ifscBank' title='".$new->bankname." IFSC Code' href='".str_replace(' ', '-',strtolower($new->bankname))."/'>".$new->bankname."</a></td>
</tr>
<tr>
<td>Branch Name</td>
<td id='branchName'>".$new->branch."</td>
</tr>
<tr>
<td>Branch Code</td>
<td iitemprop='branchCode'>".$new->bcode."</td>
</tr>
<tr>
<td>IFSC Code</td>
<td>
<a id='ifsc' href='$uri'>".$new->ifsc."</a> (used for RTGS,IMPS and NEFT transactions)<br></td>
</tr>
<tr>
<td>MICR Code</td>
<td><a id='micr' href='$uri'>".$new->mcir."</a></td>
</tr>
<tr>
<td colspan='2'>Adsense Code</td>
</tr>
<tr>
<td>Swift Code</td>
<td>NOT AVAILABLE</td>
</tr>
<tr>
<td>Address</td>
<td id='branchAddress'><span itemprop='streetAddress'>".$new->address."</span></td>
</tr>
<tr>
<td>District</td>
<td id='bankDistrict'><span itemprop='addressLocality'><a href='$url/".str_replace(' ', '-',strtolower($new->bankname))."/".str_replace(' ', '-',strtolower($new->state))."/".str_replace(' ', '-',strtolower($new->district))."/'>".$new->district."</a></span> &nbsp;(Click <a  href='$rrl/".str_replace(' ', '-',strtolower($new->bankname))."/".str_replace(' ', '-',strtolower($new->state))."/".str_replace(' ', '-',strtolower($new->district))."/'>here</a> for all the branches of ".$new->bankname." in ".$new->district." District)</td></tr>
<tr>
<td>State</td>
<td id='bankState'><span itemprop='addressRegion'><a href='$url/".str_replace(' ', '-',strtolower($new->bankname))."/".str_replace(' ', '-',strtolower($new->state))."/'>".$new->state."</a></span>
</td>
</tr>
<tr>
<td>PIN Code</td>
<td id='branchpostalCode'><span itemprop='postalCode'>".$new->zip."</span></td>
</tr>
<tr>
<td>Contact Number</td>
<td id='branchtelephone'><span itemprop='telephone'>".$new->phone."</span></td>
</tr>
<tr>
<td>Email</td>
<td id='branchEmail'><span itemprop='email'>".$new->email."</span></td>
</tr>
</tbody>
</table>
</div>
<p>IFSC code: ".$new->ifsc." and MICR code: ".$new->mcir."; ".$new->bankname." ".$new->branch." address : ".$new->address.", ".$new->district." - ".$new->state."; Branch code is NA, Contact Number: ".$new->phone.", ".$new->bankname." ".$new->branch." Timings: Monday to Friday: 10 AM to 4 PM, Saturday - 10 AM to 4 PM(Except 2nd and 4th Saturday).</p>
<h4>People Also search for this Branch Page:</h4>
<ul>
<li><a href='$uri'title='".$new->bankname." ".$new->branch." ".$new->district." IFSC Code'>".$new->bankname." ".$new->branch." ".$new->district." IFSC Code</a></li>
<li><a href='$uri'title='".$new->bankname." ".$new->district." ".$new->branch." IFSC Code'>".$new->bankname." ".$new->district." ".$new->branch." IFSC Code</a></li>
<li><a href='$uri' title='IFSC Code ".$new->bankname." ".$new->branch." ".$new->district."'>IFSC Code ".$new->bankname." ".$new->branch." ".$new->district."</a></li>
<li><a href='$uri' title='IFSC Code ".$new->bankname." ".$new->district." ".$new->branch."'>IFSC Code ".$new->bankname." ".$new->district." ".$new->branch."</a></li>
<li><a href='$uri' title='".$new->bankname." IFSC Code ".$new->district." ".$new->branch."'>".$new->bankname." IFSC Code ".$new->district." ".$new->branch."</a></li>
<li><a href='$uri' title='".$new->bankname." IFSC Code ".$new->branch." ".$new->district."'>".$new->bankname." IFSC Code ".$new->branch." ".$new->district."</a></li>
<br>";
}else{
     echo "<center><h1>Oopps!! We Can't Find It!</h1></center><br>
	     <br>";
}
	 }
?>
<h1>What Is an IFSC Code?</h1>
<p>Find the details of any bank branch from India's 741 computerised banks, using our quick and convenient search facility! Simply enter the bank's IFSC code in the search box and FindBankDetails.com takes care of the rest! Bank address, bank telephone number, bank email address, SWIFT Code, MICR code, PIN code - all at the touch of a button! </p>
                    
                    <h4>What Is a Bank IFSC Code?</h4>
                    <p>IFSC is an acronym that stands for the Indian Financial System Code of any given bank in India. The code itself is an alphanumeric combination of letters and numbers, used to identify the specific branch taking part in the four primary Electronic Funds Settlement Systems in India, which are:</p>
                    
                    <ul>
                        <li>1. Real Time Gross Settlement (RTGS)</li>
                        <li>2. National Electronic Funds Transfer (NEFT)</li>
                        <li>3. Immediate Payment Service Systems (IMPS)</li>
                        <li>4. Centralised Funds Management System (CFMS)</li>
                    </ul>
                    
                    <p>Always consisting of 11 alphanumeric characters, the first four letters in a bank's IFSC code indicate the name of the bank taking part in the transaction.  At present, the fifth digit is set at zero and has been reserved for future use.  The identity and remaining information of the specific branch of the bank in question is communicated in the last six digits of the code.</p>
                    <p>Every bank in India has a unique IFSC code, which is primarily used to facilitate and simplify the settlement systems mentioned above. The IFSC code was devised to make it both simple and secure for messages to be sent between banks, for the purposes of completing electronic transfers.</p>
                    <p>All electronic transfers completed using IFSC codes are recorded for legislative and general customer security purposes.</p>
                    
                    <h4>Why Do We Need IFSC Codes?</h4>
                    <p>IFSC codes are important for a variety of reasons - one of which being the completion of online transactions.  Digital transactions that make use of IFSC code including everything from utility bill payments to booking flights online to a general online shopping and so on. </p>
                    <p>Loan payments, equity payments and EMIs also use IFSC codes.  In fact, in just about any instance where funds are transferred between two accounts, the transaction relies on IFSC codes. </p>
                    
                    <h4>How To Find an IFSC Code?</h4>
                    <p>Here at FindBankDetails.com, we make it quick and easy to find the IFSC codes for every computerised bank currently operating in India. Our database contains the full information of all 741 banks, along with their respective contact details, branch addresses, PIN codes, SWIFT codes and so on. Use our convenient search facility to find information you need in seconds!</p>
</div>
<div class="sidebar"><?php require('sidebar.php'); ?></div>
</div>
	
<?php require('footer.php'); ?>