<?php require('header.php'); ?>
<?php 
/*
	* This files contains the select tag <select>.
	* This is the main file and should be edited with caution
	* Author: Bhupender Singh
	* Author URL: www.facebook.com/bhu08
*/
$url = "https://ifsc.localhost";
$uri = $_SERVER['REQUEST_URI'];
?>
<?php
	include 'classes/searchbyzip.php';
$keywords = "IFSC code finder, ifsc code, ifsc finder, find ifsc code";

	if(!isset($_GET['q'])){
	    $title = "Search Bank By PinCode - Sarkari Bank";
	    $des = "Locate Your Bank By Just Putting The Pin Code Of Your Area.";
		$keywords = "IFSC code finder, ifsc code, ifsc finder, find ifsc code";
	}else{
	        $title = "Result For - ".$_GET['q']." - Sarkari Bank";
	    $search = "Search Result For: ".$_GET['q'];
	    
	}
    $new = new searchzip;
?>
<div class='main-search-details'><h1>Find Branch Details/Address/MICR Code By Pin Code.</h1><div class='search-box'><form method='GET'>
        <input type="text" placeholder="ex: 248003" name="q" >
        <button>Search</button>
    </form>
    </div>
    </div>

	<br>

<div class="site-inner">
<div class="content">
    <?php
     echo "<div class='breadcrumb'><span><a href=https://localhost/>Home</a> » </span><span><a href=https://ifsc.localhost/>IFSC Code</a> » </span><span><a href=https://ifsc.localhost/search-by-pincode>Pincode</a> » </span><span><a href='https://ifsc.localhost/search-by-pincode?q=".$_GET['q']."'>".$_GET['q']."</a></span></div>";
	
	if(isset($_GET['q'])){
    $query = $_GET['q'];
	echo "<div class='banks ifsc-code-list'><ul>";
    $new->find($query);
	echo "</ul></div>";
	  
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