<?php 
/*
	* This files contains the select tag <select>.
	* This is the main file and should be edited with caution
	* Author: Bhupender Singh
	* Author URL: www.facebook.com/bhu08
*/
$sbhome = "https://localhost";
$url = "https://localhost";
$uri = $_SERVER['REQUEST_URI'];
include('sharebuttons.php');
?>
	<!--SELECT BANK NAME ELEMENT(START)-->
<?php

if (isset($_GET['state'])) {
	$state = str_replace('-', ' ', $_GET['state']);
	$state = strtoupper($state);
}else{
	$state = null;
}

	echo "<div class='main-search-details'>
<h1>IFSC Code Finder</h1><div class='ibox'><div class='search-box'>
<form action='#' method='POST'><div class='ibox'>";
	if(isset($_GET['bank_name'])){
		$bank_name = str_replace('-', ' ',$_GET['bank_name']);
		$bank_name = strtoupper($bank_name);
	echo "<div class='ifsc'><label for='bank'>Bank Name</label><div><a class='refrence-icon-null active-icon' aria-label='Reset' href='".$url."'></a></div><select class='form-control' name = 'bank_name' id='bank'><option>".strtoupper($bank_name)."</option></select></div>";
	}else{
		$bank_name = null;
		$new->showBanks(); 
	}
	
	if (isset($_GET['bank_name'])) {
		if ($state == '') {

			$new->showStates($bank_name);
			}else{


	echo "<div class='ifsc'><label for='state'>State Name</label><div><a class='refrence-icon-null active-icon' aria-label='Reset' href='".$url."/".$_GET['bank_name']."/'></a></div><select class='form-control' name ='state' id='state'><option>".strtoupper($state)."</option></select></div>";

	}
}

	if (isset($_GET['district'])) {
		$district =  str_replace('-', ' ',$_GET['district']);
				$district = strtoupper($district);


	}else{
		$district = null;
	}
	if (isset($_GET['bank_name']) AND isset($_GET['state'])  ) {
		
		if (isset($_GET['district'])) {
	echo "<div class='ifsc'><label for='district'>District Name</label><div><a class='refrence-icon-null active-icon' aria-label='Reset' href='".$url."/".$_GET['bank_name']."/".$_GET['state']."/'></a></div><select class='form-control' name = 'district' id='district'><option>".$district."</option></select></div>";
		}else{
			$new->showDistricts($bank_name, $state);
		}
	}

	if (isset($_GET['branch']) ) {
		$branch = str_replace('-', ' ',$_GET['branch']);
		$branch = strtoupper($branch);

	}else{
		$branch = null;
	}
	if (isset($_GET['bank_name']) AND isset($_GET['state']) AND isset($_GET['district'])) {
		
		if (isset($_GET['branch'])) {
		echo "<div class='ifsc'><label for='branch'>Branch Name</label><div><a class='refrence-icon-null active-icon' aria-label='Reset' href='".$url."/".$_GET['bank_name']."/".$_GET['state']."/".$_GET['district']."/'></a></div><select class='form-control' name = 'branch' id='branch'><option>".$branch."</option></select></div>";

		}else{
			$new->showBranch($bank_name, $state, $district);
		}
	}
	echo "</div></form></div></div></div>"
	
?>
<br>
<br>
<div class="site-inner">
<div class="content">
  
<?php
if(isset($_GET['bank_name']) AND isset($_GET['state']) AND isset($_GET['district']) AND isset($_GET['branch'])){
		$new->getInfo($bank_name, $state, $district, $branch);
$image = imagecreatefromjpeg('images/ifsc-image.jpg');  

//We are making three colors, white, black and gray 
$black = ImageColorAllocate($image, 46, 29, 29); 
$blue = ImageColorAllocate($image, 9, 91, 175);
$font = 'fonts/ARLRDBD.TTF';

$imgslogen='#sbifsccode';
imagettftext($image, 14, 0, 680, 22, $black, $font, $imgslogen);

$imgslogen2='@sarkaribank';
imagettftext($image, 14, 0, 10, 22, $black, $font, $imgslogen2);

$imgslogen3='localhost';
imagettftext($image, 14, 0, 10, 405, $black, $font, $imgslogen3);

$imgbank=$new->bankname;
$imgbranch=$new->branch;
$imgbankname=$imgbank.' , '.$imgbranch;
$arrText=explode('\n',wordwrap($imgbankname,35,'\n'));
foreach($arrText as $arr){
    imagettftext($image, 20, 0, 120, 80+$y, $blue, $font, trim($arr));
    $y=$y+40;
}

$imgifsctext='IFSC :';
imagettftext($image, 18, 0, 60, 270, $blue, $font, $imgifsctext);

$imgifsc=$new->ifsc;
imagettftext($image, 18, 0, 145, 270, $black, $font, $imgifsc);

$imgmicrtext='MICR :';
imagettftext($image, 18, 0, 60, 318, $blue, $font, $imgmicrtext);

$imgmicr=$new->mcir;
imagettftext($image, 18, 0, 152, 318, $black, $font, $imgmicr);

$imgaddresstext='Address :';
imagettftext($image, 18, 0, 505, 270, $blue, $font, $imgaddresstext);

$imgaddress= $new->address;
$imgcontact1=$new->phone;
$imgcontact2=$new->email;
$imgcontact=$imgaddress.' PHONE : '.$imgcontact1.' EMAIL : '.$imgcontact2;
$arrText=explode('\n',wordwrap($imgcontact,35,'\n'));
foreach($arrText as $arr){
    imagettftext($image, 13, 0, 420, 295+$s, $black, $font, trim($arr));
    $s=$s+23;
}

$output = "./images/ifsc/$imgifsc.jpg";

ob_start();
  imagejpeg( $image, $output);
  imagedestroy( $image );
  $i = ob_get_clean();

echo "<div class='breadcrumb'><ol>
  <li><a href='$url'><span>Find IFSC Code</span></a> » </li><li><a title='".$new->bankname."' href='$url/".str_replace(' ', '-',strtolower($new->bankname))."/'><span>".ucwords(strtolower($new->bankname))."</span></a> » </li><li><a href='$url/".str_replace(' ', '-',strtolower($new->bankname))."/".str_replace(' ', '-',strtolower($new->state))."/'><span>".ucwords(strtolower($new->state))."</span></a> » </li><li><a href='$url/".str_replace(' ', '-',strtolower($new->bankname))."/".str_replace(' ', '-',strtolower($new->state))."/".str_replace(' ', '-',strtolower($new->district))."/'><span>".ucwords(strtolower($new->district))."</span></a> » </li><li><span>".ucwords(strtolower($new->branch))."</span></li></ol></div>
		<h1 class='entry-title'>".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." IFSC Code, MICR code & Branch  Details</h1>
		<p>The <b>IFSC Code of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))."</b> Branch is <b>".$new->ifsc."</b> and MICR Code is <b>".$new->mcir."</b> (used for RTGS,IMPS and NEFT transactions). The address of <b>".$new->branch."</b> branch of ".$new->bankname." is ".$new->address.".  This branch is located on the Pincode <b>".$new->zip."</b> in <b>".$new->district."</b> district of <b>".$new->state."</b> state.</p>
<div itemscope itemtype='http://schema.org/LocalBusiness'>
		<h2 class='st'><span itemprop='name' class='st-title'>".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." IFSC : ".$new->ifsc."</span></h2><img itemprop='image' class='ifsc-image' src='/images/ifsc/$imgifsc.jpg'alt='".$new->bankname." ".$new->branch." ifsc code' title='".$new->branch." ".$new->bankname." ifsc code'>
		";share2();echo"
		<div class='ifsc-full-details' itemprop='address' itemscope itemtype='http://schema.org/PostalAddress'>
<table>
<tbody>
<tr>
<td>Bank</td>
<td><a id='ifscBank' title='".$new->bankname." IFSC Code' href='$url/".str_replace(' ', '-',strtolower($new->bankname))."/'>".ucwords(strtolower($new->bankname))."</a></td>
</tr>
<tr>
<td>Branch Name</td>
<td id='branchName'>".ucwords(strtolower($new->branch))."</td>
</tr>
<tr>
<td>Branch Code</td>
<td>".$new->bcode."</td>
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
<td colspan='2'></td>
</tr>
<tr>
<td>Swift Code</td>
<td>NOT AVAILABLE</td>
</tr>
<tr>
<td>Address</td>
<td id='branchAddress'><span itemprop='streetAddress'>".ucwords(strtolower($new->address))."</span></td>
</tr>
<tr>
<td>District</td>
<td id='bankDistrict'><span itemprop='addressLocality'><a href='$url/".str_replace(' ', '-',strtolower($new->bankname))."/".str_replace(' ', '-',strtolower($new->state))."/".str_replace(' ', '-',strtolower($new->district))."/'>".ucwords(strtolower($new->district))."</a></span> &nbsp;(Click here for all the branches of ".ucwords(strtolower($new->bankname))." in ".ucwords(strtolower($new->district))." District)</td></tr>
<tr>
<td>State</td>
<td id='bankState'><span itemprop='addressRegion'><a href='$url/".str_replace(' ', '-',strtolower($new->bankname))."/".str_replace(' ', '-',strtolower($new->state))."/'>".ucwords(strtolower($new->state))."</a></span>
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
</div></div>
<p>IFSC code: ".$new->ifsc." and MICR code: ".$new->mcir."; ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." address : ".$new->address.", ".$new->district." - ".$new->state."; Branch code is NA, Contact Number: ".$new->phone.", ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." Timings: Monday to Friday: 10 AM to 4 PM, Saturday - 10 AM to 4 PM(Except 2nd and 4th Saturday).</p>
<h4>People Also search for this Branch Page:</h4>
<div class='ifsc-code-list'><ul><li>
<a href='$uri'title='".$new->bankname." ".$new->branch." ".$new->district." IFSC Code'>".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." ".ucwords(strtolower($new->district))." IFSC Code</a></li><li>
<a href='$uri'title='".$new->bankname." ".$new->district." ".$new->branch." IFSC Code'>".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->district))." ".ucwords(strtolower($new->branch))." IFSC Code</a></li><li>
<a href='$uri' title='IFSC Code ".$new->bankname." ".$new->branch." ".$new->district."'>IFSC Code ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." ".ucwords(strtolower($new->district))."</a></li><li>
<a href='$uri' title='IFSC Code ".$new->bankname." ".$new->district." ".$new->branch."'>IFSC Code ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->district))." ".ucwords(strtolower($new->branch))."</a></li><li>
<a href='$uri' title='".$new->bankname." IFSC Code ".$new->district." ".$new->branch."'>".ucwords(strtolower($new->bankname))." IFSC Code ".ucwords(strtolower($new->district))." ".ucwords(strtolower($new->branch))."</a></li><li>
<a href='$uri' title='".$new->bankname." IFSC Code ".$new->branch." ".$new->district."'>".ucwords(strtolower($new->bankname))." IFSC Code ".ucwords(strtolower($new->branch))." ".ucwords(strtolower($new->district))."</a></li></ul></div>
<h3>Q: What is the IFSC Code of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch?</h3>
<p>Answer: The IFSC code (Indian Financial System Code) of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch is <strong>".$new->ifsc."</strong>.</p>
<h3>Q: How and where can we use ".$new->ifsc." IFSC Code?</h3>
<p>Answer: We can transfer money or receive money in his account on <strong>".ucwords(strtolower($new->branch))."</strong> branch of ".ucwords(strtolower($new->bankname))." using this <strong>".$new->ifsc." </strong>IFSC Code.</p>
<h3>Q: What is the contact number of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch?</h3>
<p>Answer: The contact number for ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch is <strong>".$new->phone."</strong></p>
<h3>Q: What is the branch name for ".$new->ifsc." IFSC code?</h3>
<p>Answer: The branch name for ".$new->ifsc." IFSC code is <strong>".ucwords(strtolower($new->branch))."</strong>.</p>
<h3>Q: What is the branch code of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch?</h3>
<p>Answer: The branch code of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch is <strong>".$new->bcode."</strong></p>
<h3>Q: What is the MICR code of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch?</h3>
<p>Answer: The MICR code of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch is <strong>".$new->mcir."</strong>. It is used to make the process easy of cheques clearance, documents, and other processes within the bank itself.</p>
<h3>Q: What is the full address of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch?</h3>
<p>Answer: The full address of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch is <strong>".ucwords(strtolower($new->address))."</strong></p>
<h3>Q: What is the PIN code of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch?</h3>
<p>Answer: The PIN code of ".ucwords(strtolower($new->bankname))." ".ucwords(strtolower($new->branch))." branch is <strong>".$new->zip."</strong>.</p>
";
    echo "<h2 class='st'><span class='st-title'>All Banks In ".ucwords(strtolower($new->district))."</span></h2>
    <button class='faq'><h2>Click here to get banks list</h2></button>
    <div class='panel'><div class='banks ifsc-code-list'>";
            $new->showOther($state, $district);
            echo "</div></div>";
    echo "
<h4>".ucwords(strtolower($new->bankname))." IFSC (INDIAN FINANCIAL SYSTEM CODE) Code, MICR Code &amp; SWIFT Code</h4>
<p>IFSC (Indian Financial System Code) codes, MICR codes and SWIFT codes are playing vital roles in to transfers money between banks or account-holders in India. Since short description, these codes have simplified the transfer and payment process for billions of consumers and businessmen domestic or international.</p>
<p>".ucwords(strtolower($new->bankname))." uses IFSC (Indian Financial System Code), MICR and SWIFT codes to offer its consumers and businessmen with varied money transfer options which are fast, secure and economic. These unique codes (IFSC. MICR and SWIFT Codes) are used to identify unique information, like name of the bank and location of the respective branch.</p>
<p>Customers and businessmen of BANK Name are required to provide their name, account number, account type and the IFSC (Indian Financial System Code) code, MICR code and/or SWIFT code of their branch and that of the recipient in order to execute bank transfers and digital transactions.</p>
<h4>How to Find IFSC Codes, MICR Codes and SWIFT Codes for ".ucwords(strtolower($new->bankname))."</h4>
<p >It&rsquo;s easy and quick to locate the IFSC code, MICR code and SWIFT code of ".ucwords(strtolower($new->bankname))." via consulting the cheque book provided by the bank or going online.</p>
<p>By looking at your cheque book you can see that every page contains the relevant IFSC code of the respective branch of the bank. You can also visit <a href='https://localhost' traget='_blank'>localhost</a> and use the convenient search facility, in order to find the IFSC code, MICR code or SWIFT code of any bank branch in India.</p>
<p>At the top of our website you will find a search button labelled &lsquo;Search&rsquo;, which will take you separate page where you can find the information you required instantly. You can simply enter the details of the branch you wish to locate along with its IFSC code, MICR code and SWIFT code.</p>
<p>The website is free to use and covers all pan India banks (888 CBS banks), incorporating thousands of branches across the country.</p>
<h4>How do we transfer money using BANK NAME NEFT, RTGS &amp; IMPS Services?</h4>
<p>The ".ucwords(strtolower($new->bankname))." provides convenience of its customers by allowing money transfer vis NEFT and RTGS. Both the electronic currency transfer processes are hassle-free and use IFSC codes to quickly and securely transfer money from one account to another.</p>
<h4>National Electronic Fund Transfer (NEFT):</h4>
<p>The National Electronic Fund Transfer standard - most commonly referred to as NEFT - was created and rolled out by the RBI to both facilitate and simplify retail transactions for customers. National Electronic Funds Transfer (NEFT) is one of the most comprehensive online money transfer methods from one bank to another. NEFT is based on a deferred system, which means that money is transferred to different sets (batches).</p>
<p>There are more than 1,50,000+ branches of 800 banks which take part in the NEFT network all throughout INDIA.</p>
<p>Operation at ".ucwords(strtolower($new->bankname))." involve several batches NEFT transaction which are carried out throughout the day. As bank name has joined the NEFT network it has made convenient and safe for its customers to make monetary transfers and payments to other accounts in banks.</p>
<p>Bank Customers looking to initiate a NEFT transaction are required to first complete a Fund Transfer Instruction Form, which can be picked up from any branch of the bank. Information required includes the name of the beneficiary, the bank and specific branch of the beneficiary, the account type held as saving or current account number of the beneficiary and the IFSC code of the beneficiary's branch and bank.</p>
<p>In terms of the sender, the bank and respective branch's IFSC code must be provided, along with the account number, type of account and so on. In the absence of any of these details, it is not possible to make a NEFT transfer with ".ucwords(strtolower($new->bankname))." or any bank taking part in this scheme.</p>
<h4>Timings and Fees:</h4>
<p>settlements of fund transfer requests in NEFT system is done on half-hourly basis. There are twenty-three half-hourly settlement batches run from 8 am to 7 pm on all working days of week Certain charges are payable in accordance with the amount of the transaction, which at the time of writing are as follows:</p>
<p>The structure of charges that can be levied on the customer for NEFT is given below:</p>
<ol>
<li>a) Inward transactions at destination bank branches (for credit to beneficiary accounts)</li>
</ol>
<p>&ndash; Free, no charges to be levied on beneficiaries</p>
<ol>
<li>b) Outward transactions at originating bank branches &ndash; charges applicable for the remitter</li>
</ol>
<p>- For transactions up to ₹ 10,000: not exceeding ₹ 2.50 (+ Applicable GST)</p>
<p>- For transactions above ₹ 10,000 up to ₹ 1 lakh: not exceeding ₹ 5 (+ Applicable GST)</p>
<p>- For transactions above ₹ 1 lakh and up to ₹ 2 lakhs: not exceeding ₹ 15 (+ Applicable GST)</p>
<p>- For transactions above ₹ 2 lakhs: not exceeding ₹ 25 (+ Applicable GST)</p>
<ol>
<li>c) Charges applicable for transferring funds from India to Nepal using the NEFT system (under the Indo-Nepal Remittance Facility Scheme) is available on the website of RBI at http://rbi.org.in/scripts/FAQView.aspx?Id=67</li>
</ol>
<p>With effect from 1st July 2011, originating banks are required to pay a nominal charge of 25 paisa each per transaction to the clearing house as well as destination bank as service charge. However, these charges cannot be passed on to the customers by the banks.</p>
<p>These fees and timings are of course subject to change, so please consult your local branch directly for more information.</p>
<h4>Real Time Gross Settlement (RTGS):</h4>
<p>Real Time Gross Settlement - more commonly referred to as RTGS - is another example of a standardised system for making and receiving electronic payments in India. Devised and introduced by the Reserve Bank of India, RTGS operates as a convenient and secure alternative to personal cheques, enabling banks taking part in the scheme to make transfers using online messages directed through the official RTGS Payment Gateway.</p>
<p>With a view to rationalize the service charges levied by banks for offering funds transfer through RTGS system, a broad framework of charges has been mandated as under:</p>
<ol>
<li>a) Inward transactions &ndash; Free, no charge to be levied.</li>
<li>b) Outward transactions &ndash; ₹2,00,000/- to 5,00,000/-: not exceeding ₹30/-;</li>
</ol>
<p>Above ₹5,00,000/-: not exceeding ₹55/-.</p>
<p>Within the maximum charge there is a component which depends on the time of day when the transaction is initiated. Banks may decide to charge a lower rate but cannot charge more than the rates prescribed by RBI.</p>
<p>Perhaps the biggest advantage of RTGS is how it eliminates manual cheque-clearing processes and waiting times from the equation. Transactions using RTGS are more or less instantaneous, making it much quicker and easier for payments to be settled and funds credited to their intended accounts - typically within 2 hours.</p>
<p>Another great thing about RTGS is that it is uniquely economical in nature while carrying out comparatively large amount transfers. the minimum transactions sum to qualify for an RTGS transfer is set at Rs 2 lakh. There are more than 1,50,000+ branches of 700+ banks which take part in the RTGS network all throughout INDIA.</p>
<p>In terms of required information, the sender of the funds must complete all fields including the name of the beneficiary, the name of their bank and the respective branch, account number, the type of account they hold and the IFSC code of the recipient's bank.</p>
<p>Timings:</p>
<p>RTGS is not a 24x7 system. The RTGS service window for customer transactions is available to banks from 8 am to 6 pm (The timings are extended from 4:30 pm to 6:00 pm from June 01, 2019) on a working day, for settlement at the RBI end. However, the timings that the banks follow may vary from bank to bank.</p>
<h4>Immediate Payment Service (IMPS):</h4>
<p>IMPS is an immediate funding service and works of 24 * 7. It can be used 365 days in a year to transfer money from one bank to another bank account. This service was introduced by the National Payment Corporation in 2010.</p>
<p>We do not need to register separately for IMPS service &ndash; Once we are logged into our Net Banking account, we will get the option to transfer our money through NEFT (National Electronic Fund Transfer), RTGS (Real Time Gross Settlement) or IMPS (Immediate Payment Service). we can choose the IMPS option for the transfer.</p>
<p>Once again, we need the full name of the beneficiary, its bank account number, and IFSC code to complete the transfer fund.</p>
<p>Transactions using the IMPS protocol can be requested and actioned on a 24/7 basis, 365 days a year. This means that payments can be sent and received at any time, irrespective of standard bank opening times and/or operational hours.</p>
<p>In this instance, customers using IMPS are required to provide either a combination of their MMID (Mobile Money Identifier) and their mobile number, or the IFSC code of their respective bank branch and their account number.</p>
<p>MMID (Mobile Money Identifier) is the seven-characters number provided by the bank for the IMPS service if the person is using mobile banking as a beneficiary.</p>
    ";
echo "";shareone();echo"";}
?>

 <?php 
        if(!isset($_GET['bank_name'])){
            echo "<div class='breadcrumb'><span><a href='/'>HOME</a> । </span><span>IFSC Code</span></div>
<h1 class='entry-title'>Do you know, what is an IFSC Code?</h1>
<p><strong>We can search 1,50,000+ IFSC Codes of 888+ Banks in PAN India!</strong>&nbsp;We are working hard to keep the information updated by adding the IFSC code of the banks available on the Reserve Bank of India website.</p>
<h4>Report IFSC Codes!</h4>
<p>We&rsquo;re always taking care in the collecting IFSC Codes (Indian Financial System Code) and presenting them with a user-friendly search format. In case you find any errors then kindly report them immediately to <a href='mailto:contact@localhost'>contact@localhost</a> If you have a bank and you want to list the IFSC code of your bank on our website <a href='https://localhost/' rel='noreferrer'>https://localhost/</a>, please send a mail on <a href='mailto:contact@localhost'>contact@localhost</a></p>
<h2>How can we find the IFSC Code for a Bank?</h2>
<p>The hassle-free way to find the IFSC code for banks in India is to begin by the select your bank. We can filter the list of IFSC codes by the select state, district, and branch name. Or We can directly enter PINCODE to find the details of the branch. We can also find the branch details by entering the IFSC Code. <a href='https://localhost/how-to-find-ifsc-code/' target='_blank' rel='noreferrer'><u>Read more about Find IFSC Code</u></a></p>
<h2>What is an IFS code?</h2>
<p>The full form is the Indian Financial System Code. It is a unique 11-digit alpha-numeric code. It is used for online fund transfer through NEFT, IMPS and RTGS transactions. Generally, the IFSC code can be found on the cheque-book issued by the bank. <a href='https://localhost/'><u>Read more about IFSC</u></a></p>
<h2>What is an IFSC NEFT transfer?</h2>
<p>National Electronic Funds Transfer (NEFT) is one of the most comprehensive online money transfer processes from one bank to another. NEFT (National Electronic Funds Transfer) is based on a deferred system, which means that money is transferred to different sets (batches). <a href='https://localhost/difference-between-rtgs-and-neft/' target='_blank' rel='noreferrer'><u>Read more about NEFT</u></a> &nbsp;&nbsp;<a href='https://localhost/difference-between-rtgs-and-neft/' target='_blank' rel='noreferrer'><u>Difference between NEFT & RTGS</u></a></p>
<h2>What is an IFSC RTGS transfer?</h2>
<p>RTGS (Real Time Gross Settlement) money transfer mode is basically for high-value fund transactions. The minimum amount that can be transferred through RTGS (Real Time Gross Settlement) is Rs.2 lakhs. There is no cap on the maximum transfer. Since the transfer is based on real-time, the person will receive the amount of transferred money in approximately 30 minutes. <a href='https://localhost/difference-between-rtgs-and-neft/' target='_blank' rel='noreferrer'><u>Read more about RTGS</u></a></p>
<h2>What is an IFSC IMPS transfer?</h2>
<p>IMPS is an immediate funding service and works of 24 * 7. It can be used 365 days in a year to transfer money from one bank to another bank account. This service was introduced by the National Payment Corporation in 2010.</p>
<p>The National Payments Corporation of India (NPCI) is an organization, which controls retail payments in India, The IMPS and UPI transfer process has been provided by the NPCI. <a href='https://localhost/'><u>Read more about IMPS</u></a></p>
<h2>What is UPI?</h2>
<p>The Unified Payment Interface (UPI) can be considered as an email id for our money. It is a unique identifier that our bank uses to transfer fund and make payments using immediate payment service (IMPS). IMPS is faster than NEFT (National Electronic Funds Transfer) and RTGS (Real Time Gross Settlement), and unlike NEFT (National Electronic Funds Transfer), we can immediately transfer money 24 &times; 7. It means that online payment will be very easy without requiring a digital wallet or debit or credit card. <a href='https://localhost/unified-payment-interface/' target='_blank' rel='noreferrer'><u>Read more about UPI</u></a></p>

<h2 class='st'><span class='st-title'>Some Indian Banks List</span></h2>
<div class='ifsc-code-list'><ul>
    <li><a href='/state-bank-of-india/'>STATE BANK OF INDIA ( SBI )</a></li>
    <li><a href='/hdfc-bank/'>HDFC BANK</a></li>
    <li><a href='/icici-bank-limited/'>ICICI BANK LIMITED</a></li>
    <li><a href='/bank-of-baroda/'>BANK OF BARODA</a></li>
    <li><a href='/punjab-national-bank/'>PUNJAB NATIONAL BANK</a></li>
    <li><a href='/bank-of-india/'>BANK OF INDIA</a></li>
    <li><a href='/axis-bank/'>AXIS BANK</a></li>
    <li><a href='/allahabad-bank/'>ALLAHABAD BANK</a></li>
    <li><a href='/uco-bank/'>UCO BANK</a></li>
    <li><a href='/united-bank-of-india/'>UNITED BANK OF INDIA</a></li>
    <li><a href='/citi-bank/'>CITI BANK</a></li>
    <li><a href='/central-bank-of-india/'>CENTRAL BANK OF INDIA</a></li>
    <li><a href='/indian-bank/'>INDIAN BANK</a></li>
    <li><a href='/canara-bank/'>CANARA BANK</a></li>
    <li><a href='/andhra-bank/'>ANDHRA BANK</a></li>
    <li><a href='/kotak-mahindra-bank-limited/'>KOTAK MAHINDRA BANK LIMITED</a></li></ul></div>
   <div class='postbutton in-w10'><a href='#'>Click here for list of all banks in India</a></div>
<button class='faq'><h2>IFSC Codes FAQ's</h2></button>
<div class='panel'>
<h4>Q: Is IMPS faster than NEFT?</h4>
<p>Answer: In IMPS (Immediate Payment Service) the money gets transferred immediately, whereas in NEFT (National Electronic Funds Transfer) the amount is settled in time-regulated batches.</p>
<h4>Q: Is IMPS faster than RTGS?</h4>
<p>Answer: In IMPS (Immediate Payment Service) and RTGS the money gets transferred immediately (real time). The only difference is that in RTGS (Real Time Gross Settlement) the minimum transfer amount limit is 2 Lakh, whereas in IMPS there is no such limitation.</p>
<h4>Q: Is Cheque required for NEFT?</h4>
<p>Answer: No, A cheque is not required to transfer the money through NEFT (National Electronic Funds Transfer) transaction.</p>
<h4>Q: Is Cheque required for RTGS?</h4>
<p>Answer: No, A cheque is not required to transfer the money through RTGS transaction.</p>
<h4>Q: Is Cheque required for IMPS?</h4>
<p>Answer: No, A cheque is not required to transfer the money through IMPS ((Immediate Payment Service) transaction.</p>
<h4>Q: What are the timings for transferring money through NEFT in a day?</h4>
<p>Answer: The timings are restricted to transfer money from 8 AM to 6:30 PM from Monday to Friday and 8 AM to 1 PM on Saturdays. In such a situation, we can use IMPS for an easy, hassle-free and convenient transfer the fund.</p>
<h4>Q: What are the timings for transferring money through RTGS in a day?</h4>
<p>Answer: The timings are restricted to transfer money from 8 AM to 4:30 PM from Monday to Friday and 9 AM to 2 PM on Saturdays. In such a situation, we can use IMPS for an easy, hassle-free and convenient transfer the fund.</p>
<h4>Q: What are the timings for transferring money through IMPS in a day?</h4>
<p>Answer: There is no any specific time to transfer money through IMPS. We can transfer the amount anytime in a day (24*7 hrs).</p>
<h4>Q: Can we transfer money through NEFT on Public/National Holidays?</h4>
<p>Answer: No, we can&rsquo;t transfer money through NEFT in a bank holiday/national holiday like Saturday, Sunday and any festival holiday (Diwali, Holi) etc.</p>
<h4>Q: Can we transfer money through RTGS on Public/National Holidays?</h4>
<p>Answer: No, we can&rsquo;t transfer money through NEFT in a bank holiday/national holiday like Saturday, Sunday and any festival holiday (Diwali, Holi) etc.</p>
<h4>Q: Can we transfer money through IMPS on Public/National Holidays?</h4>
<p>Answer: Yes, we can transfer money through IMPS in a bank holiday/national holiday like Saturday, Sunday and any festival holiday (Diwali, Holi) etc.</p>
<h4>Q: What is the limit for single transaction NEFT?</h4>
<p>Answer: In NEFT, the minimum transfer value is Rs.1 rupee but there is limitation of maximum transfer amount.</p>
<h4>Q: What is the limit for single transaction RTGS?</h4>
<p>Answer: In RTGS, the minimum and maximum transfer amounts are Rs.2 lakh and Rs.10 lakh respectively.</p>
<h4>Q: What is the limit for single transaction IMPS?</h4>
<p>Answer: In IMPS, the minimum transfer value is Rs.1 rupee but there is limitation of maximum transfer amount.</p>
<h4>Q: What are the charges for transferring money through NEFT?</h4>
<p>Answer: It depends on bank to bank.</p>
<h4>Q: What are the charges for transferring money through RTGS?</h4>
<p>Answer: It depends on bank to bank.</p>
<h4>Q: What are the charges for transferring money through IMPS?</h4>
<p>Answer: It depends on bank to bank.</p>
<h4>Q: How much time will it take while using NEFT to credit the amount in beneficiary account?</h4>
<p>Answer: It will take 0-2 hours because it is settled in batches.</p>
<h4>Q: How much time will it take while using RTGS to credit the amount in beneficiary account?</h4>
<p>Answer: Nearly Instant</p>
<h4>Q: How much time will it take while using IMPS to credit the amount in beneficiary account?</h4>
<p>Answer: Immediately</p>
</div>
<button class='faq'><h2>The Importance of IFSC code</h2></button>
<div class='panel'>
<p>Its full form is the Indian Financial System Code. It is a unique 11-digit alpha-numeric code. It is used for online fund transfer through NEFT, IMPS and RTGS transactions. Generally, the IFSC code can be found on the cheque-book issued by the bank. It can also be found on the front(1st) page of the accountholder’s passbook. IFSC code of each bank branch has been assigned by the RBI (Reserve Bank of India). Account holders can easily find the IFSC code of their banks/branches on the RBI’s (Reserve Bank India) website. Internet Banking Transaction cannot be initiated without a valid Indian Financial System Code (IFSC) for Money Transfer using NEFT, IMPS, and RTGS.</p>
<p>Usually, there is no change or update in the eleven-digit IFSC code. Recently, the State Bank of India changed the Indian financial system code (IFSC) of its branches across the country after the merger of its five associate banks and Bhartiya Mahila Bank.</p>
<p>There are following points highlight the importance of the Indian Financial System Code (IFSC).</p>
<p>Unique Identity – It helps to identify a specific bank/branch.</p>
<p>Elimination Error – It helps in eliminating any deviation in the fund transfer process.</p>
<p>Make electronic payments easy – it is used in electronic payment instruments like RTGS, NEFT, and IMPS.</p>
<h4>Format for Bank IFSC Code</h4>
<p>The first Four characters of IFSC code are alphabets which represent the bank. The 5th character is 0 (Zero) which represents the Natural number/ Control key/ Reserve number. Generally, the last Six characters are numbers but they can be alphabets as well which represent the branch code.</p>
<div id='ez-toc-container' class='counter-flat counter-decimal ez-toc-grey'>
<div class='ez-toc-title-container'>
<p class='ez-toc-title'>Table of Contents</p>
<span class='ez-toc-title-toggle'></span></div>
<nav><ul class='ez-toc-list'><li><a href='#How_does_IFSC_CODE_work'>How does IFSC CODE work?</a></li><li><a href='#What_is_the_use_of_IFSC'>What is the use of IFSC?</a></li><li><a href='#IFSC_Code_Pattern'>IFSC Code Pattern</a></li><li><a href='#How_do_you_know_the_IFSC_Code_of_your_bank'>How do you know the IFSC Code of your bank?</a></li><li><a href='#How_to_search_for_the_unique_IFSC_Code_of_any_Banks_Branch'>How to search for the unique IFSC Code of any Bank’s Branch</a></li><li><a href='#How_can_we_Transfer_Money_with_the_IFSC_Code_of_the_Bank'>How can we Transfer Money with the IFSC Code of the Bank?</a></li><li><a href='#Do_you_know_what_is_e-transfer_and_how_to_use_e-transfer_funds'>Do you know what is e-transfer and how to use e-transfer funds?</a></li><li><a href='#How_to_Process_to_Register_a_Third-Party_Beneficiary'>How to Process to Register a Third-Party Beneficiary:</a></li><li><a href='#Lets_look_at_the_process_of_registering_the_third-party_beneficiary'>Let’s look at the process of registering the third-party beneficiary</a></li><li><a href='#Numerous_methods_of_fund_transfer_with_the_help_of_IFSC_or_IFS_code'>Numerous methods of fund transfer with the help of IFSC or IFS code</a></li><li><a href='#Lets_look_at_these_methods'>Let’s look at these methods.</a></li><li><a href='#What_is_MICR_Code'>What is MICR Code?</a></li></ul></nav></div>
<h2><span class='ez-toc-section' id='How_does_IFSC_CODE_work'>How does IFSC CODE work?</span></h2>
<p>Electronic funds transfer in India is facilitated by an alpha-numeric code which is known as the Indian Financial System Code (IFS Code or IFSC).  This code specifically recognizes each bank branch, which participates in India’s two main settlement and payment systems, i.e. NEFT (National Electronic Fund Transfer) and RTGS (Real Time Gross Settlement).</p>
<p>The Indian Financial System Code (IFS Code or IFSC) is an 11-character alpha-numeric code allocated by the RBI (Reserve Bank of India). The first part of the code is made up of 4-characters representing the bank code. The next character is zero which is reserved for future use. The last six (6) characters which identify the branch.</p>
<h4>Let’s see an e.g.:</h4>
<p>IFSC Code of Industrial Credit and Investment Corporation of India (ICICI) starts with letters ‘ICIC’. Since there are so many banks with many branches, The IFSC code is used to identify the branch involved in the transaction.</p>
<p>IFSC codes are important during payment transactions through RTGS, NEFT transfers. Like, for ICICI, the IFSC Code will be ICIC0000610 for the branch located in Dlf Cyber Green, Dlf Phase Iii, Gurugram-122002.</p>
<p>Modes of Online Money Transfer Using IFSC Code (Detailed Info About NEFT, RTGS, IMPS)</p>
<p>This fact is cannot be denied that almost everyone in our circle is dependent on online money transfer and, of course, you are no exception. This online trend is supported by a large number of options – Thanks to the digitization of monetary transactions.</p>
<p>The convenience of online money transfer has definitely made our lives easier. Almost, all bank offers many online money transfer options like IMPS (Immediate Payment Service), NEFT (National Electronic Fund Transfer), RTGS (Real Time Gross Settlement), etc.</p>
<p>Based on various parameters such as transfer speed parameters, transaction costs, service availability, etc. each of the above online money transfer modes will provide a wide range of features and flexibility. Although these Online money transfer modes have their own set of advantages, they come with their diverse flexibility and convenience for the customers.</p>
<p>How can help IFSC code transfer our money through National Electronic Fund Transfer (NEFT)?</p>
<p>National Electronic Funds Transfer (NEFT) is one of the most comprehensive online money transfer methods from one bank to another.  NEFT is based on a deferred system, which means that money is transferred to different sets (batches).</p>
<p>Currently, there are 12 batches settlements sets arranged between the time between of 8:00 a.m. – 6:30 p.m. for weekdays (Monday to Friday), 6 batches settlements slab 8:00 a.m. 1:00 p.m. for Saturdays and no money transfer through NEFT on Sunday.</p>
<p>Although there is no cap on the transferred amount through NEFT, however, some banks have set the limit amount. For example, the State Bank of India (SBI) has put a cap of Rs 10 lakh for NEFT transfer amount under its retail banking option.</p>
<h4>A step-by-step process for transferring money through NEFT:</h4>
<p>To get started, our bank branch should be NEFT-enabled. We can check and confirm by visiting the RBI (Reserve Bank of India) website.</p>
<p>Complete the registration process of our Net Banking account by creating a username and password. However, our mobile number must be registered with our bank and it should be with us at the time to complete Net Banking registration.</p>
<p>After this, we need to add the beneficiary to our account to whom we want to make money transfer. To do this, we will need the name of the beneficiary, bank account number and IFSC (Indian Financial System Code) for that branch. IFSC can be found on either bank statement or check leaf.</p>
<p>Once we successfully add the beneficiary, we may have the wait time before the money transfer (can be assigned by the bank) to the added beneficiary. For example, ICICI has a waiting time of 30 minutes.</p>
<p>Once we log into our Net Banking account then go to the “Transfer Fund” option.</p>
<p>Choose the name of the particular beneficiary we want to transfer money to and complete the transfer with the help of OTP (One Time Password) which is sending to our registered mobile number.</p>
<p>The amount will be transferred to the beneficiary according to the next settlement’s schedule.</p>
<p>Based on the transferred amount, NEFT cost is between Rs 2.50 and 25 (+ service tax).</p>
<p>NEFT transactions also have some limitations So we cannot transfer money at any time. This service is available only on working days and working hours of banks. We cannot use to take advantage of this service on weekends and bank holidays.</p>
<p>How can help us IFSC code transfer our money through RTGS (Real Time Gross Settlement)?</p>
<p>RTGS (Real Time Gross Settlement) money transfer mode is basically for high-value fund transactions. The minimum amount that can be transferred through RTGS is Rs.2 lakhs. There is no cap on the maximum transfer. Since the transfer is based on real-time, the person will receive the amount of transferred money in approximately 30 minutes.</p>
<p>RTGS service works from 8.00 am to 6:30 pm on weekdays I-e, Monday to Friday and from 9.00 am to 2.00 pm on Saturdays.</p>
<p>The Process to use RTGS service is similar to NEFT. All we have to make sure that we, as well as the beneficiary bank account,  is RTGS-active and we have the IFSC code of the bank branch.</p>
<p>RTGS is a bit expensive compared to NTFT, where we can charge 30 rupees for a transfer of Rs 2 to 5 lakhs, whereas for a transaction exceeding Rs 5 lakh then we will be charged a fee of 55 rupees.</p>
<p>How can you help us IFSC code transfer our money through IMPS (Immediate Payment Service)?</p>
<p>IMPS is an immediate funding service and works of 24 * 7. It can be used 365 days in a year to transfer money from one bank to another bank account. This service was introduced by the National Payment Corporation in 2010.</p>
<p>We do not need to register separately for IMPS service – Once we are logged into our Net Banking account, we will get the option to transfer our money through NEFT (National Electronic Fund Transfer), RTGS (Real Time Gross Settlement) or IMPS (Immediate Payment Service). we can choose the IMPS option for the transfer.</p>
<p>Once again, we need the full name of the beneficiary, its bank account number, and IFSC code to complete the transfer fund.</p>
<p>If we transfer money through our bank’s mobile app, then we also need an MMID (Mobile Money Identifier) code for IMPS.</p>
<p>MMID (Mobile Money Identifier) is the seven-characters number provided by the bank for the IMPS service if the person is using mobile banking as a beneficiary.</p>
<p>Also, while conducting IMPS by the mobile application then we do not need to register the beneficiary.</p>
<p>The fee for using IMPS is fixed by each bank. However, the fee for fund transfers up to Rs 1 lakh is Rs 5. and Rs 1 to 2 lakh is Rs 15 for transfer.</p>
<h2><span class='ez-toc-section' id='What_is_the_use_of_IFSC'>What is the use of IFSC?</span></h2>
<p>IFSC can be used by the Indian financial system to facilitate the online and electronic transfer. It is a bank’s IFSC code which actives it helps to bank customers with NEFT (National Electronic Fund Transfer) and RTGS (Real Time Gross Settlement).</p>
<h2><span class='ez-toc-section' id='IFSC_Code_Pattern'>IFSC Code Pattern</span></h2>
<p>In an IFSC – Indian Financial System Code, the first Four characters of IFSC code are alphabets which represent the bank. Therefore, the IFSC (Indian Financial System Code) of each and every branch of the same bank is starting with the same 4-alphabets. The fifth character is zero (0) which is known as Reserve Number.</p>
<p>The remaining six characters are numbers or digit that represent the branch code. It is the part that makes an IFSC code unique.</p>
<h2><span class='ez-toc-section' id='How_do_you_know_the_IFSC_Code_of_your_bank'>How do you know the IFSC Code of your bank?</span></h2>
<p>This is very easy. If we have a bank account with any branch of any bank, we can get it on the front page of our bank passbook.</p>
<p>However, if we want to know the IFS code without creating an account, we can do it through the internet. There is available an official website of IFS code where we can get all about this code.</p>
<h2><span class='ez-toc-section' id='How_to_search_for_the_unique_IFSC_Code_of_any_Banks_Branch'>How to search for the unique IFSC Code of any Bank’s Branch</span></h2>
<p>In short, as an Indian Financial System Code, IFSC is an 11-digit alphanumeric code That is used to find the bank branches participating in numerous electronic monetary transactions like NEFT or RTGS.</p>
<p>Anyone can get the IFSC code in their bank passbook or cheque-book. The image below can help us to understand in a better way.</p>
<p>IFSC code can be searched by anyone when he visits either a particular bank branch or the official website of a particular bank or</p>
<p>calling to their contact center through the helpline number.  For example, if you want to know the ICICI Bank Cyber Park, Gurugram:</p>
<ol>
<li>We can call the branch over the phone and ask for the IFS code.</li>
<li>As mentioned earlier, we can get it on a checkbook or passbook issued by the bank.</li>
<li>We can also get IFSC code from the official RBI website. It has been mentioned along with the list of banks participating in the RTGS / NEFT network.</li>
<li>In addition to the above, third-party websites like localhost also help you to find the IFSC code information as you need. To find the IFSC Code of the ICICI Bank, we can visit the ICICI Bank IFSC Code page on localhost Now Click on ‘Find ICICI Bank Code’ by Branch. Click on the drop-down menu to make relevant selections and to enter necessary details like State, District, Branch. Once we have entered this information, the full details of that particular bank branch will be shown to you.</li>
</ol>
<h2><span class='ez-toc-section' id='How_can_we_Transfer_Money_with_the_IFSC_Code_of_the_Bank'>How can we Transfer Money with the IFSC Code of the Bank?</span></h2>
<p>Online money transfer is easy and hassle-free with IFSC code. These IFSC codes have been provided by the RBI to their bank branches to transfer money through NEFT, RTGS, and IMPS. To know how the IFSC code works when money transfers, let’s take an example here. The IFSC code of ICICI, Cyber Park Gurugram branch is ICIC0000610.</p>
<ol>
<li>Here, the first 4-characters “ICIC” to find the bank, which is ICICI Bank.</li>
<li>The 5th digit is always ‘Zero’ which is known as a control key.</li>
<li>The remaining six characters 000610, helps RBI (Reserve Banks of India) to find the branch of the bank.</li>
</ol>
<p>Let’s know how to work the IFSC code during the online fund transfer transaction. When the money transfer is initiated then we have to enter the bank account number and the recipient’s IFSC code. Once the sender provides all the required information, the money is easily transferred to the beneficiary’s account with the help of IFS code or IFSC. The money transfer with IFSC code takes only a few times from the time of introduction.</p>
<p>IFSC codes can also be used to buy mutual funds or insurance through Internet Banking. As the National Clearing Cell of the RBI (Reserve Bank of India) monitors all transactions, the IFSC Code helps RBI track various transactions and execute fund/money transfer without any hassle.</p>
<h2><span class='ez-toc-section' id='Do_you_know_what_is_e-transfer_and_how_to_use_e-transfer_funds'>Do you know what is e-transfer and how to use e-transfer funds?</span></h2>
<p>Nowadays, most people choose some or other online procedures to transfer funds from one bank account to another bank account. The process of the e-transfer fund is not only easy but it is also hassle-free. Despite this, it saves us from the hassle of going to the bank and standing in queue for transfer money. We must follow a few simple steps to successfully transfer our fund from one bank account to another bank account.</p>
<h4>Let’s take a look at these steps:</h4>
<ol>
<li>First of all, to take advantage of the online services provided by your bank, it is important that we have to register for net banking services in our bank.</li>
<li>We will need to register the recipient account as a beneficiary for third-party transactions. (Note that the beneficiary refers to the third party with a separate bank compared to our bank)</li>
<li>We will need to add beneficiary accounts and IFSC codes of the recipient bank branch.</li>
</ol>
<h2><span class='ez-toc-section' id='How_to_Process_to_Register_a_Third-Party_Beneficiary'>How to Process to Register a Third-Party Beneficiary:</span></h2>
<p>Primarily, there is a policy regarding the fund transfer to the third party of every bank in India. However, the method of transferring funds to the third party’s is the same as every bank, except that they are presented in a slightly different way.</p>
<h3><span class='ez-toc-section' id='Lets_look_at_the_process_of_registering_the_third-party_beneficiary'>Let’s look at the process of registering the third-party beneficiary</span></h3>
<ol>
<li>Enter customer ID and PIN (Personal identification number) and login to the bank’s online banking service.</li>
<li>Click on the ‘Fund Transfer’ tab. we will be directed to a new page.</li>
<li>Go to the Request option, we will see the option to add a beneficiary. Click on that and</li>
<li>Enter the recipient’s account details: Beneficiary’s Name, Account number, IFSC Code and Branch name of the bank.</li>
<li>After filling these required details, click on the ‘Submit’ button.</li>
<li>Once the registration is complete, it takes some time to activate the service. Once complete, we can transfer money.</li>
<li>After the beneficiary has been added to our account, we will have to enter the details and amount that we want to transfer to the beneficiary’s account.</li>
<li>Once we work with it, choose the option of mobile or email for communication.</li>
<li>Based on either of the options we have chosen, we will receive OTP on our registered mobile number or email ID.</li>
<li>After completion of verification of OTP, our money will be transferred to the beneficiary account.</li>
</ol>
<h2><span class='ez-toc-section' id='Numerous_methods_of_fund_transfer_with_the_help_of_IFSC_or_IFS_code'>Numerous methods of fund transfer with the help of IFSC or IFS code</span></h2>
<p>The online transfer of fund is seeming difficult but it is very easy with the help of IFSC code. To the contrary, it is easy and hassle-free. While processing fund transfer from one bank account to another bank account, The IFSC code provides important information to facilitate the transfer. However, there are various ways to transfer money with the help of IFSC code.</p>
<h3><span class='ez-toc-section' id='Lets_look_at_these_methods'>Let’s look at these methods.</span></h3>
<h4>Through App:</h4>
<p>These days, almost every smartphone has an app. we can download an app of our bank available in Google Play / Appstore.</p>
<p>In addition, we can also do the fund transfer through an app. Here are some basic steps that we need to follow in order to transfer money through a particular bank app.</p>
<ol>
<li>First of all, we need an active net banking system for our account.</li>
<li>Download our bank’s Net Banking app which has been provided by the bank. This link may be available on a particular bank’s website.</li>
<li>Open the app; enter a login ID or passwords like customer ID and password to open our account.</li>
<li>Choose Fund Transfer Options; we will see different options for third party fund transfer such as: Between My Accounts, Within Bank, Instant Transfer to Other Bank-IMPS, To Other Bank- NEFT, Via Visa Card, Via Special Payment</li>
<li>Select the NEFT option for money transfer.</li>
<li>If we have added the beneficiary’s /account holder name, bank account number, mobile number and the IFSC code of the concerned bank branch.</li>
<li>After the registration process is completed, the Beneficiary account will take about 10 minutes -12 hours to activate it for fund transfer. Time duration is often dependent on bank policy to add accounts.</li>
<li>we can initiate fund transfer immediately in the beneficiary’s account after the beneficiary account is linked to our account.</li>
</ol>
<h4>Through SMS:</h4>
<p>We can also transfer funds through the mobile message (SMS) process with the help of an IFSC code. Let’s look at how we can transfer money through SMS.</p>
<ol>
<li>first of all, we need to link our mobile number to our account by registering our phone number for mobile banking to transfer fund through the process of SMS (Short Message Service),</li>
<li>we need to fill out a form to register, after which the starter kit be sent to us, which is included a unique seven-digit number i-e MMID and MPIN.</li>
<li>we need to create an SMS and type IMPS with the beneficiary’s details after we register ourselves, we have to enter the beneficiary’s / account holder name, bank account number, IFSC code of beneficiary’s bank and the amount we want to transfer.</li>
<li>We will receive a confirmation SMS in which we must enter your MPIN after we confirm the transaction.</li>
<li>The money of the beneficiary will be transferred to the account after entering the MPIN,</li>
</ol>
<p>Therefore, with these methods, we can easily transfer money to beneficiary accounts with the help of IFSC code.</p>
<h2><span class='ez-toc-section' id='What_is_MICR_Code'>What is MICR Code?</span></h2>
<p>Its full form is magnetic ink character recognition. The paper-based documents in the banking database, it is an innovative technique to prove validity and reliability. In spite of the security of money, the transfer is concerned. we can find it on the checkbook. MICR is similar to the IFSC code.</p>
<p>MICR is a code of highly advanced CRT (character recognition technology) to confirm cheques for withdrawals by banks. MICR technology is also used as other bank documents. The MICR code is placed below the cheque.</p>
<p>This includes details such as bank branch code, bank account details, fill-up amount and cheque number with control indicator. The biggest advantage of MICR technology is that it is one of the same concepts as barcode because MICR can easily be read and honored by humans.</p>
<p>Find IFSC Code and MICR Code on Bank Cheque</p>
<p>What is IFSC code and how to locate it on a cheque?</p>
<p>&nbsp;</p></div>";
            $new->showbank();
            echo "";shareone();echo"";
        }elseif(isset($_GET['bank_name']) AND !isset($_GET['state'])){
            $bank = str_replace('-',' ', strtoupper($_GET['bank_name']));
            echo "<div class='breadcrumb'><span><a href='$sbhome'>HOME</a> । </span><span><a href='$url'>IFSC Code</a> । </span><span>$bank</span></div>";
            $new->showstatess($bank);
                echo "
<h4>".ucwords(strtolower($bank))." IFSC (INDIAN FINANCIAL SYSTEM CODE) Code, MICR Code &amp; SWIFT Code</h4>
<p>IFSC (Indian Financial System Code) codes, MICR codes and SWIFT codes are playing vital roles in to transfers money between banks or account-holders in India. Since short description, these codes have simplified the transfer and payment process for billions of consumers and businessmen domestic or international.</p>
<p>".ucwords(strtolower($bank))." uses IFSC (Indian Financial System Code), MICR and SWIFT codes to offer its consumers and businessmen with varied money transfer options which are fast, secure and economic. These unique codes (IFSC. MICR and SWIFT Codes) are used to identify unique information, like name of the bank and location of the respective branch.</p>
<p>Customers and businessmen of BANK Name are required to provide their name, account number, account type and the IFSC (Indian Financial System Code) code, MICR code and/or SWIFT code of their branch and that of the recipient in order to execute bank transfers and digital transactions.</p>
<h4>How to Find IFSC Codes, MICR Codes and SWIFT Codes for ".ucwords(strtolower($bank))."</h4>
<p >It&rsquo;s easy and quick to locate the IFSC code, MICR code and SWIFT code of ".ucwords(strtolower($bank))." via consulting the cheque book provided by the bank or going online.</p>
<p>By looking at your cheque book you can see that every page contains the relevant IFSC code of the respective branch of the bank. You can also visit <a href='https://localhost' traget='_blank'>localhost</a> and use the convenient search facility, in order to find the IFSC code, MICR code or SWIFT code of any bank branch in India.</p>
<p>At the top of our website you will find a search button labelled &lsquo;Search&rsquo;, which will take you separate page where you can find the information you required instantly. You can simply enter the details of the branch you wish to locate along with its IFSC code, MICR code and SWIFT code.</p>
<p>The website is free to use and covers all pan India banks (888 CBS banks), incorporating thousands of branches across the country.</p>
<h4>How do we transfer money using BANK NAME NEFT, RTGS &amp; IMPS Services?</h4>
<p>The ".ucwords(strtolower($bank))." provides convenience of its customers by allowing money transfer vis NEFT and RTGS. Both the electronic currency transfer processes are hassle-free and use IFSC codes to quickly and securely transfer money from one account to another.</p>
<h4>National Electronic Fund Transfer (NEFT):</h4>
<p>The National Electronic Fund Transfer standard - most commonly referred to as NEFT - was created and rolled out by the RBI to both facilitate and simplify retail transactions for customers. National Electronic Funds Transfer (NEFT) is one of the most comprehensive online money transfer methods from one bank to another. NEFT is based on a deferred system, which means that money is transferred to different sets (batches).</p>
<p>There are more than 1,50,000+ branches of 800 banks which take part in the NEFT network all throughout INDIA.</p>
<p>Operation at ".ucwords(strtolower($bank))." involve several batches NEFT transaction which are carried out throughout the day. As bank name has joined the NEFT network it has made convenient and safe for its customers to make monetary transfers and payments to other accounts in banks.</p>
<p>Bank Customers looking to initiate a NEFT transaction are required to first complete a Fund Transfer Instruction Form, which can be picked up from any branch of the bank. Information required includes the name of the beneficiary, the bank and specific branch of the beneficiary, the account type held as saving or current account number of the beneficiary and the IFSC code of the beneficiary's branch and bank.</p>
<p>In terms of the sender, the bank and respective branch's IFSC code must be provided, along with the account number, type of account and so on. In the absence of any of these details, it is not possible to make a NEFT transfer with ".ucwords(strtolower($bank))." or any bank taking part in this scheme.</p>
<h4>Timings and Fees:</h4>
<p>settlements of fund transfer requests in NEFT system is done on half-hourly basis. There are twenty-three half-hourly settlement batches run from 8 am to 7 pm on all working days of week Certain charges are payable in accordance with the amount of the transaction, which at the time of writing are as follows:</p>
<p>The structure of charges that can be levied on the customer for NEFT is given below:</p>
<ol>
<li>a) Inward transactions at destination bank branches (for credit to beneficiary accounts)</li>
</ol>
<p>&ndash; Free, no charges to be levied on beneficiaries</p>
<ol>
<li>b) Outward transactions at originating bank branches &ndash; charges applicable for the remitter</li>
</ol>
<p>- For transactions up to ₹ 10,000: not exceeding ₹ 2.50 (+ Applicable GST)</p>
<p>- For transactions above ₹ 10,000 up to ₹ 1 lakh: not exceeding ₹ 5 (+ Applicable GST)</p>
<p>- For transactions above ₹ 1 lakh and up to ₹ 2 lakhs: not exceeding ₹ 15 (+ Applicable GST)</p>
<p>- For transactions above ₹ 2 lakhs: not exceeding ₹ 25 (+ Applicable GST)</p>
<ol>
<li>c) Charges applicable for transferring funds from India to Nepal using the NEFT system (under the Indo-Nepal Remittance Facility Scheme) is available on the website of RBI at http://rbi.org.in/scripts/FAQView.aspx?Id=67</li>
</ol>
<p>With effect from 1st July 2011, originating banks are required to pay a nominal charge of 25 paisa each per transaction to the clearing house as well as destination bank as service charge. However, these charges cannot be passed on to the customers by the banks.</p>
<p>These fees and timings are of course subject to change, so please consult your local branch directly for more information.</p>
<h4>Real Time Gross Settlement (RTGS):</h4>
<p>Real Time Gross Settlement - more commonly referred to as RTGS - is another example of a standardised system for making and receiving electronic payments in India. Devised and introduced by the Reserve Bank of India, RTGS operates as a convenient and secure alternative to personal cheques, enabling banks taking part in the scheme to make transfers using online messages directed through the official RTGS Payment Gateway.</p>
<p>With a view to rationalize the service charges levied by banks for offering funds transfer through RTGS system, a broad framework of charges has been mandated as under:</p>
<ol>
<li>a) Inward transactions &ndash; Free, no charge to be levied.</li>
<li>b) Outward transactions &ndash; ₹2,00,000/- to 5,00,000/-: not exceeding ₹30/-;</li>
</ol>
<p>Above ₹5,00,000/-: not exceeding ₹55/-.</p>
<p>Within the maximum charge there is a component which depends on the time of day when the transaction is initiated. Banks may decide to charge a lower rate but cannot charge more than the rates prescribed by RBI.</p>
<p>Perhaps the biggest advantage of RTGS is how it eliminates manual cheque-clearing processes and waiting times from the equation. Transactions using RTGS are more or less instantaneous, making it much quicker and easier for payments to be settled and funds credited to their intended accounts - typically within 2 hours.</p>
<p>Another great thing about RTGS is that it is uniquely economical in nature while carrying out comparatively large amount transfers. the minimum transactions sum to qualify for an RTGS transfer is set at Rs 2 lakh. There are more than 1,50,000+ branches of 700+ banks which take part in the RTGS network all throughout INDIA.</p>
<p>In terms of required information, the sender of the funds must complete all fields including the name of the beneficiary, the name of their bank and the respective branch, account number, the type of account they hold and the IFSC code of the recipient's bank.</p>
<p>Timings:</p>
<p>RTGS is not a 24x7 system. The RTGS service window for customer transactions is available to banks from 8 am to 6 pm (The timings are extended from 4:30 pm to 6:00 pm from June 01, 2019) on a working day, for settlement at the RBI end. However, the timings that the banks follow may vary from bank to bank.</p>
<h4>Immediate Payment Service (IMPS):</h4>
<p>IMPS is an immediate funding service and works of 24 * 7. It can be used 365 days in a year to transfer money from one bank to another bank account. This service was introduced by the National Payment Corporation in 2010.</p>
<p>We do not need to register separately for IMPS service &ndash; Once we are logged into our Net Banking account, we will get the option to transfer our money through NEFT (National Electronic Fund Transfer), RTGS (Real Time Gross Settlement) or IMPS (Immediate Payment Service). we can choose the IMPS option for the transfer.</p>
<p>Once again, we need the full name of the beneficiary, its bank account number, and IFSC code to complete the transfer fund.</p>
<p>Transactions using the IMPS protocol can be requested and actioned on a 24/7 basis, 365 days a year. This means that payments can be sent and received at any time, irrespective of standard bank opening times and/or operational hours.</p>
<p>In this instance, customers using IMPS are required to provide either a combination of their MMID (Mobile Money Identifier) and their mobile number, or the IFSC code of their respective bank branch and their account number.</p>
<p>MMID (Mobile Money Identifier) is the seven-characters number provided by the bank for the IMPS service if the person is using mobile banking as a beneficiary.</p>
    ";
    echo "";shareone();echo"";
        }elseif(isset($_GET['bank_name']) AND isset($_GET['state']) AND !isset($_GET['district'])){
             $bank = str_replace('-',' ', strtoupper($_GET['bank_name']));
             $state = str_replace('-',' ', strtoupper($_GET['state']));

             
            echo "<div class='breadcrumb'><span><a href='$sbhome'>HOME</a> । </span><span><a href='$url'>IFSC Code</a> । </span><span><a title='$bank IFSC Code' href='$url/".str_replace(' ', '-', strtolower($bank))."/'>$bank</a> । </span><span>$state</span></div>";
            $new->showdis($bank, $state);
                echo "
<h4>".ucwords(strtolower($bank))." IFSC (INDIAN FINANCIAL SYSTEM CODE) Code, MICR Code &amp; SWIFT Code</h4>
<p>IFSC (Indian Financial System Code) codes, MICR codes and SWIFT codes are playing vital roles in to transfers money between banks or account-holders in India. Since short description, these codes have simplified the transfer and payment process for billions of consumers and businessmen domestic or international.</p>
<p>".ucwords(strtolower($bank))." uses IFSC (Indian Financial System Code), MICR and SWIFT codes to offer its consumers and businessmen with varied money transfer options which are fast, secure and economic. These unique codes (IFSC. MICR and SWIFT Codes) are used to identify unique information, like name of the bank and location of the respective branch.</p>
<p>Customers and businessmen of BANK Name are required to provide their name, account number, account type and the IFSC (Indian Financial System Code) code, MICR code and/or SWIFT code of their branch and that of the recipient in order to execute bank transfers and digital transactions.</p>
<h4>How to Find IFSC Codes, MICR Codes and SWIFT Codes for ".ucwords(strtolower($bank))."</h4>
<p >It&rsquo;s easy and quick to locate the IFSC code, MICR code and SWIFT code of ".ucwords(strtolower($bank))." via consulting the cheque book provided by the bank or going online.</p>
<p>By looking at your cheque book you can see that every page contains the relevant IFSC code of the respective branch of the bank. You can also visit <a href='https://localhost' traget='_blank'>localhost</a> and use the convenient search facility, in order to find the IFSC code, MICR code or SWIFT code of any bank branch in India.</p>
<p>At the top of our website you will find a search button labelled &lsquo;Search&rsquo;, which will take you separate page where you can find the information you required instantly. You can simply enter the details of the branch you wish to locate along with its IFSC code, MICR code and SWIFT code.</p>
<p>The website is free to use and covers all pan India banks (888 CBS banks), incorporating thousands of branches across the country.</p>
<h4>How do we transfer money using BANK NAME NEFT, RTGS &amp; IMPS Services?</h4>
<p>The ".ucwords(strtolower($bank))." provides convenience of its customers by allowing money transfer vis NEFT and RTGS. Both the electronic currency transfer processes are hassle-free and use IFSC codes to quickly and securely transfer money from one account to another.</p>
<h4>National Electronic Fund Transfer (NEFT):</h4>
<p>The National Electronic Fund Transfer standard - most commonly referred to as NEFT - was created and rolled out by the RBI to both facilitate and simplify retail transactions for customers. National Electronic Funds Transfer (NEFT) is one of the most comprehensive online money transfer methods from one bank to another. NEFT is based on a deferred system, which means that money is transferred to different sets (batches).</p>
<p>There are more than 1,50,000+ branches of 800 banks which take part in the NEFT network all throughout INDIA.</p>
<p>Operation at ".ucwords(strtolower($bank))." involve several batches NEFT transaction which are carried out throughout the day. As bank name has joined the NEFT network it has made convenient and safe for its customers to make monetary transfers and payments to other accounts in banks.</p>
<p>Bank Customers looking to initiate a NEFT transaction are required to first complete a Fund Transfer Instruction Form, which can be picked up from any branch of the bank. Information required includes the name of the beneficiary, the bank and specific branch of the beneficiary, the account type held as saving or current account number of the beneficiary and the IFSC code of the beneficiary's branch and bank.</p>
<p>In terms of the sender, the bank and respective branch's IFSC code must be provided, along with the account number, type of account and so on. In the absence of any of these details, it is not possible to make a NEFT transfer with ".ucwords(strtolower($bank))." or any bank taking part in this scheme.</p>
<h4>Timings and Fees:</h4>
<p>settlements of fund transfer requests in NEFT system is done on half-hourly basis. There are twenty-three half-hourly settlement batches run from 8 am to 7 pm on all working days of week Certain charges are payable in accordance with the amount of the transaction, which at the time of writing are as follows:</p>
<p>The structure of charges that can be levied on the customer for NEFT is given below:</p>
<ol>
<li>a) Inward transactions at destination bank branches (for credit to beneficiary accounts)</li>
</ol>
<p>&ndash; Free, no charges to be levied on beneficiaries</p>
<ol>
<li>b) Outward transactions at originating bank branches &ndash; charges applicable for the remitter</li>
</ol>
<p>- For transactions up to ₹ 10,000: not exceeding ₹ 2.50 (+ Applicable GST)</p>
<p>- For transactions above ₹ 10,000 up to ₹ 1 lakh: not exceeding ₹ 5 (+ Applicable GST)</p>
<p>- For transactions above ₹ 1 lakh and up to ₹ 2 lakhs: not exceeding ₹ 15 (+ Applicable GST)</p>
<p>- For transactions above ₹ 2 lakhs: not exceeding ₹ 25 (+ Applicable GST)</p>
<ol>
<li>c) Charges applicable for transferring funds from India to Nepal using the NEFT system (under the Indo-Nepal Remittance Facility Scheme) is available on the website of RBI at http://rbi.org.in/scripts/FAQView.aspx?Id=67</li>
</ol>
<p>With effect from 1st July 2011, originating banks are required to pay a nominal charge of 25 paisa each per transaction to the clearing house as well as destination bank as service charge. However, these charges cannot be passed on to the customers by the banks.</p>
<p>These fees and timings are of course subject to change, so please consult your local branch directly for more information.</p>
<h4>Real Time Gross Settlement (RTGS):</h4>
<p>Real Time Gross Settlement - more commonly referred to as RTGS - is another example of a standardised system for making and receiving electronic payments in India. Devised and introduced by the Reserve Bank of India, RTGS operates as a convenient and secure alternative to personal cheques, enabling banks taking part in the scheme to make transfers using online messages directed through the official RTGS Payment Gateway.</p>
<p>With a view to rationalize the service charges levied by banks for offering funds transfer through RTGS system, a broad framework of charges has been mandated as under:</p>
<ol>
<li>a) Inward transactions &ndash; Free, no charge to be levied.</li>
<li>b) Outward transactions &ndash; ₹2,00,000/- to 5,00,000/-: not exceeding ₹30/-;</li>
</ol>
<p>Above ₹5,00,000/-: not exceeding ₹55/-.</p>
<p>Within the maximum charge there is a component which depends on the time of day when the transaction is initiated. Banks may decide to charge a lower rate but cannot charge more than the rates prescribed by RBI.</p>
<p>Perhaps the biggest advantage of RTGS is how it eliminates manual cheque-clearing processes and waiting times from the equation. Transactions using RTGS are more or less instantaneous, making it much quicker and easier for payments to be settled and funds credited to their intended accounts - typically within 2 hours.</p>
<p>Another great thing about RTGS is that it is uniquely economical in nature while carrying out comparatively large amount transfers. the minimum transactions sum to qualify for an RTGS transfer is set at Rs 2 lakh. There are more than 1,50,000+ branches of 700+ banks which take part in the RTGS network all throughout INDIA.</p>
<p>In terms of required information, the sender of the funds must complete all fields including the name of the beneficiary, the name of their bank and the respective branch, account number, the type of account they hold and the IFSC code of the recipient's bank.</p>
<p>Timings:</p>
<p>RTGS is not a 24x7 system. The RTGS service window for customer transactions is available to banks from 8 am to 6 pm (The timings are extended from 4:30 pm to 6:00 pm from June 01, 2019) on a working day, for settlement at the RBI end. However, the timings that the banks follow may vary from bank to bank.</p>
<h4>Immediate Payment Service (IMPS):</h4>
<p>IMPS is an immediate funding service and works of 24 * 7. It can be used 365 days in a year to transfer money from one bank to another bank account. This service was introduced by the National Payment Corporation in 2010.</p>
<p>We do not need to register separately for IMPS service &ndash; Once we are logged into our Net Banking account, we will get the option to transfer our money through NEFT (National Electronic Fund Transfer), RTGS (Real Time Gross Settlement) or IMPS (Immediate Payment Service). we can choose the IMPS option for the transfer.</p>
<p>Once again, we need the full name of the beneficiary, its bank account number, and IFSC code to complete the transfer fund.</p>
<p>Transactions using the IMPS protocol can be requested and actioned on a 24/7 basis, 365 days a year. This means that payments can be sent and received at any time, irrespective of standard bank opening times and/or operational hours.</p>
<p>In this instance, customers using IMPS are required to provide either a combination of their MMID (Mobile Money Identifier) and their mobile number, or the IFSC code of their respective bank branch and their account number.</p>
<p>MMID (Mobile Money Identifier) is the seven-characters number provided by the bank for the IMPS service if the person is using mobile banking as a beneficiary.</p>
    ";
    echo "";shareone();echo"";
        }
        elseif(isset($_GET['bank_name']) AND isset($_GET['state']) AND isset($_GET['district']) AND !isset($_GET['branch'])){
            
            $bank = str_replace('-',' ', strtoupper($_GET['bank_name']));
             $state = str_replace('-',' ', strtoupper($_GET['state']));
                $dis = str_replace('-',' ', strtoupper($_GET['district']));
  echo "<div class='breadcrumb'><span><a href='$sbhome'>HOME</a> । </span><span><a href='$url'>IFSC Code</a> । </span><span><a title='$bank IFSC Code' href='$url/".str_replace(' ', '-', strtolower($bank))."/'>$bank</a> । </span><span><a title='$bank $state IFSC Code' href='$url/".str_replace(' ', '-', strtolower($bank))."/".str_replace(' ', '-', strtolower($state))."/'>$state</a> । </span><span>$dis</span></div>";
            
           $new->showbra($bank, $state, $dis);
               echo "
<h4>".ucwords(strtolower($bank))." IFSC (INDIAN FINANCIAL SYSTEM CODE) Code, MICR Code &amp; SWIFT Code</h4>
<p>IFSC (Indian Financial System Code) codes, MICR codes and SWIFT codes are playing vital roles in to transfers money between banks or account-holders in India. Since short description, these codes have simplified the transfer and payment process for billions of consumers and businessmen domestic or international.</p>
<p>".ucwords(strtolower($bank))." uses IFSC (Indian Financial System Code), MICR and SWIFT codes to offer its consumers and businessmen with varied money transfer options which are fast, secure and economic. These unique codes (IFSC. MICR and SWIFT Codes) are used to identify unique information, like name of the bank and location of the respective branch.</p>
<p>Customers and businessmen of BANK Name are required to provide their name, account number, account type and the IFSC (Indian Financial System Code) code, MICR code and/or SWIFT code of their branch and that of the recipient in order to execute bank transfers and digital transactions.</p>
<h4>How to Find IFSC Codes, MICR Codes and SWIFT Codes for ".ucwords(strtolower($bank))."</h4>
<p >It&rsquo;s easy and quick to locate the IFSC code, MICR code and SWIFT code of ".ucwords(strtolower($bank))." via consulting the cheque book provided by the bank or going online.</p>
<p>By looking at your cheque book you can see that every page contains the relevant IFSC code of the respective branch of the bank. You can also visit <a href='https://localhost' traget='_blank'>localhost</a> and use the convenient search facility, in order to find the IFSC code, MICR code or SWIFT code of any bank branch in India.</p>
<p>At the top of our website you will find a search button labelled &lsquo;Search&rsquo;, which will take you separate page where you can find the information you required instantly. You can simply enter the details of the branch you wish to locate along with its IFSC code, MICR code and SWIFT code.</p>
<p>The website is free to use and covers all pan India banks (888 CBS banks), incorporating thousands of branches across the country.</p>
<h4>How do we transfer money using BANK NAME NEFT, RTGS &amp; IMPS Services?</h4>
<p>The ".ucwords(strtolower($bank))." provides convenience of its customers by allowing money transfer vis NEFT and RTGS. Both the electronic currency transfer processes are hassle-free and use IFSC codes to quickly and securely transfer money from one account to another.</p>
<h4>National Electronic Fund Transfer (NEFT):</h4>
<p>The National Electronic Fund Transfer standard - most commonly referred to as NEFT - was created and rolled out by the RBI to both facilitate and simplify retail transactions for customers. National Electronic Funds Transfer (NEFT) is one of the most comprehensive online money transfer methods from one bank to another. NEFT is based on a deferred system, which means that money is transferred to different sets (batches).</p>
<p>There are more than 1,50,000+ branches of 800 banks which take part in the NEFT network all throughout INDIA.</p>
<p>Operation at ".ucwords(strtolower($bank))." involve several batches NEFT transaction which are carried out throughout the day. As bank name has joined the NEFT network it has made convenient and safe for its customers to make monetary transfers and payments to other accounts in banks.</p>
<p>Bank Customers looking to initiate a NEFT transaction are required to first complete a Fund Transfer Instruction Form, which can be picked up from any branch of the bank. Information required includes the name of the beneficiary, the bank and specific branch of the beneficiary, the account type held as saving or current account number of the beneficiary and the IFSC code of the beneficiary's branch and bank.</p>
<p>In terms of the sender, the bank and respective branch's IFSC code must be provided, along with the account number, type of account and so on. In the absence of any of these details, it is not possible to make a NEFT transfer with ".ucwords(strtolower($bank))." or any bank taking part in this scheme.</p>
<h4>Timings and Fees:</h4>
<p>settlements of fund transfer requests in NEFT system is done on half-hourly basis. There are twenty-three half-hourly settlement batches run from 8 am to 7 pm on all working days of week Certain charges are payable in accordance with the amount of the transaction, which at the time of writing are as follows:</p>
<p>The structure of charges that can be levied on the customer for NEFT is given below:</p>
<ol>
<li>a) Inward transactions at destination bank branches (for credit to beneficiary accounts)</li>
</ol>
<p>&ndash; Free, no charges to be levied on beneficiaries</p>
<ol>
<li>b) Outward transactions at originating bank branches &ndash; charges applicable for the remitter</li>
</ol>
<p>- For transactions up to ₹ 10,000: not exceeding ₹ 2.50 (+ Applicable GST)</p>
<p>- For transactions above ₹ 10,000 up to ₹ 1 lakh: not exceeding ₹ 5 (+ Applicable GST)</p>
<p>- For transactions above ₹ 1 lakh and up to ₹ 2 lakhs: not exceeding ₹ 15 (+ Applicable GST)</p>
<p>- For transactions above ₹ 2 lakhs: not exceeding ₹ 25 (+ Applicable GST)</p>
<ol>
<li>c) Charges applicable for transferring funds from India to Nepal using the NEFT system (under the Indo-Nepal Remittance Facility Scheme) is available on the website of RBI at http://rbi.org.in/scripts/FAQView.aspx?Id=67</li>
</ol>
<p>With effect from 1st July 2011, originating banks are required to pay a nominal charge of 25 paisa each per transaction to the clearing house as well as destination bank as service charge. However, these charges cannot be passed on to the customers by the banks.</p>
<p>These fees and timings are of course subject to change, so please consult your local branch directly for more information.</p>
<h4>Real Time Gross Settlement (RTGS):</h4>
<p>Real Time Gross Settlement - more commonly referred to as RTGS - is another example of a standardised system for making and receiving electronic payments in India. Devised and introduced by the Reserve Bank of India, RTGS operates as a convenient and secure alternative to personal cheques, enabling banks taking part in the scheme to make transfers using online messages directed through the official RTGS Payment Gateway.</p>
<p>With a view to rationalize the service charges levied by banks for offering funds transfer through RTGS system, a broad framework of charges has been mandated as under:</p>
<ol>
<li>a) Inward transactions &ndash; Free, no charge to be levied.</li>
<li>b) Outward transactions &ndash; ₹2,00,000/- to 5,00,000/-: not exceeding ₹30/-;</li>
</ol>
<p>Above ₹5,00,000/-: not exceeding ₹55/-.</p>
<p>Within the maximum charge there is a component which depends on the time of day when the transaction is initiated. Banks may decide to charge a lower rate but cannot charge more than the rates prescribed by RBI.</p>
<p>Perhaps the biggest advantage of RTGS is how it eliminates manual cheque-clearing processes and waiting times from the equation. Transactions using RTGS are more or less instantaneous, making it much quicker and easier for payments to be settled and funds credited to their intended accounts - typically within 2 hours.</p>
<p>Another great thing about RTGS is that it is uniquely economical in nature while carrying out comparatively large amount transfers. the minimum transactions sum to qualify for an RTGS transfer is set at Rs 2 lakh. There are more than 1,50,000+ branches of 700+ banks which take part in the RTGS network all throughout INDIA.</p>
<p>In terms of required information, the sender of the funds must complete all fields including the name of the beneficiary, the name of their bank and the respective branch, account number, the type of account they hold and the IFSC code of the recipient's bank.</p>
<p>Timings:</p>
<p>RTGS is not a 24x7 system. The RTGS service window for customer transactions is available to banks from 8 am to 6 pm (The timings are extended from 4:30 pm to 6:00 pm from June 01, 2019) on a working day, for settlement at the RBI end. However, the timings that the banks follow may vary from bank to bank.</p>
<h4>Immediate Payment Service (IMPS):</h4>
<p>IMPS is an immediate funding service and works of 24 * 7. It can be used 365 days in a year to transfer money from one bank to another bank account. This service was introduced by the National Payment Corporation in 2010.</p>
<p>We do not need to register separately for IMPS service &ndash; Once we are logged into our Net Banking account, we will get the option to transfer our money through NEFT (National Electronic Fund Transfer), RTGS (Real Time Gross Settlement) or IMPS (Immediate Payment Service). we can choose the IMPS option for the transfer.</p>
<p>Once again, we need the full name of the beneficiary, its bank account number, and IFSC code to complete the transfer fund.</p>
<p>Transactions using the IMPS protocol can be requested and actioned on a 24/7 basis, 365 days a year. This means that payments can be sent and received at any time, irrespective of standard bank opening times and/or operational hours.</p>
<p>In this instance, customers using IMPS are required to provide either a combination of their MMID (Mobile Money Identifier) and their mobile number, or the IFSC code of their respective bank branch and their account number.</p>
<p>MMID (Mobile Money Identifier) is the seven-characters number provided by the bank for the IMPS service if the person is using mobile banking as a beneficiary.</p>
    ";
    echo "";shareone();echo"";
        }
        
?>