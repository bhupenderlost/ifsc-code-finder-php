<?php


/*
	* This files contains a class which handles all the functions.
	* This is the main class and should be edited with caution
	* Author: Bhupender Singh
	* Author URL: www.facebook.com/bhu08
*/

//START OF THE CLASS NAME IFSCcodes (START)
class IFSCcodes
{

	//All the public variables
	public $bankname;
	public $state;
	public $district;
	public $branch;
	public $ifsc;
	public $address;
	public $mcir;
	public $zip;
	public $phone;
	public $showbank;
    public $bcode;
    public $email;
	public $noofbank;

	//Protected function to connect to the database securly
	protected function dbconnect(){

		//Database credentials
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "bank";

		//Connect to the MySQL using mysqli function
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

		//Returns the database connection once it is connected
		return $conn;
	}

    public function showbank(){
        
		//Connects To The Database
		$conn = $this->dbconnect();

		//SQL Query
		$sql = "SELECT DISTINCT bname FROM banks";
		$result = mysqli_query($conn, $sql);
		$noofbank = mysqli_num_rows($result);
		echo "<p>We can search 1,50,000+ IFSC Codes of ".$noofbank." Banks in PAN India!</p>
		<button class='faq'><h2>List of All ".$noofbank." Banks in India</h2></button>
		<div class='panel'><div class='banks ifsc-code-list'><ul>";
			while ($row = $result->fetch_assoc()) {
			echo "<li><a href='".str_replace(' ', '-', strtolower($row['bname']))."/'>".$row['bname']."</a></li>";
		}
        echo "</ul></div></div><br>";
    }
     public function showNo(){
        
		//Connects To The Database
		$conn = $this->dbconnect();

		//SQL Query
		$sql = "SELECT DISTINCT bname FROM banks";
		$result = mysqli_query($conn, $sql);
		$num_rows = mysqli_num_rows($result);
	    echo "$num_rows Rows\n";
        
    }
    public function showstatess($bank){
        
		//Connects To The Database
		$conn = $this->dbconnect();

		//SQL Query
		$sql = "SELECT DISTINCT state FROM banks WHERE bname = '$bank'";
		$result = mysqli_query($conn, $sql);
		$noofstate = mysqli_num_rows($result);
		echo "
		<h1 class='entry-title'>".ucwords(strtolower($bank))." has branches in ".$noofstate." States</h1>
		<p>State wise list of ".$bank." IFSC code, MICR code and addresses of all branches in India.</p>
		<div class='ifsc-code-list'><ul>";
			while ($row = $result->fetch_assoc()) {
		
			echo "<li><a href='".str_replace(' ', '-', strtolower($row['state']))."/'>".$row['state']."</a></li>";
		}
		echo "</ul></div><br>";
        
    }
     public function showdis($bank, $state){
        
		//Connects To The Database
		$conn = $this->dbconnect();

		//SQL Query
		$sql = "SELECT DISTINCT state, bname, district FROM banks WHERE bname = '$bank' AND state = '$state'";
		$result = mysqli_query($conn, $sql);
		$noofdistrict = mysqli_num_rows($result);
		echo "
		<h1 class='entry-title'>".ucwords(strtolower($bank))." has branches in ".$noofdistrict." District Of ".ucwords(strtolower($state))." State</h1>
        <p>District or City wise branch list of ".$bank." IFSC code and MICR code in ".$state." state along with addresses.</p><div class='ifsc-code-list'><ul>";
			while ($row = $result->fetch_assoc()) {
		
			echo "<li><a href='".str_replace(' ', '-', strtolower($row['district']))."/'>".$row['district']."</a></li>";
		}
		echo "</ul></div><br>";
        
    }
     public function showbra($bank, $state, $dis){
        
		//Connects To The Database
		$conn = $this->dbconnect();

		//SQL Query
		$sql = "SELECT DISTINCT * FROM banks WHERE bname = '$bank' AND state = '$state' AND district = '$dis'";
		$result = mysqli_query($conn, $sql);
		$noofbranches = mysqli_num_rows($result);
		echo "
		<h1 class='entry-title'>".ucwords(strtolower($bank))." has ".$noofbranches." branches in ".ucwords(strtolower($dis))." District of ".ucwords(strtolower($state))." State</h1>
		<p>List of all branches located in ".ucwords(strtolower($dis))." district of ".ucwords(strtolower($state))." State of ".ucwords(strtolower($bank)).".</p><div class='ifsc-code-list'><ul>";
			while ($row = $result->fetch_assoc()) {
		
			echo "<li><a href='".str_replace(' ', '-', strtolower($row['branch']))."/'>".$row['branch']."</a></li>";
		}
		echo "</ul></div><br>";
        
    }
	//showBanks() function shows all the banks available to the front-end
	public function showBanks(){

		//Connects To The Database
		$conn = $this->dbconnect();

		//SQL Query
		$sql = "SELECT DISTINCT bname FROM banks";
		$result = $conn->query($sql);
		echo "<div class='ifsc'><label for='bank'>Bank Name</label>";
		//Opening Tag Of Select <select>
		echo "<div><a href='' aria-label='Reset' class='refrence-icon-null'></a></div><select class='form-control' name = 'bank_name' id='bank' onchange = 'window.location.href=this.options[this.selectedIndex].value'>";

		//By default option (Select Your Bank Here)
		echo "<option value = '0'>Select Your Bank</option>";

		//while loop to fetch the bank names and print them out
		while ($row = $result->fetch_assoc()) {
			echo "<option value='".str_replace(' ', '-',strtolower($row['bname']))."/'>".$row['bname']."</option>";
		}
        
		//Closing Tag Of Select </select>
		echo "</select></div>";
		echo "<div class='ifsc'><label for='state'>State Name</label>";

		echo "<div><a href='' aria-label='Reset' class='refrence-icon-null'></i></a></div><select class='form-control' id='state'><option>Select State</option></select></div>";
		echo "<div class='ifsc'><label for='district'>District Name</label>";

		echo "<div><a href='' aria-label='Reset' class='refrence-icon-null'></i></a></div><select class='form-control'  id='district'><option>Select District</option></select></div>";	
		echo "<div class='ifsc'><label for='branch'>Branch Name</label>";

		echo "<div><a href='' aria-label='Reset' class='refrence-icon-null'></a></div><select class='form-control'  id='branch'><option>Select Branch</option></select></div>";

	}

	//showStates() function shows all the states in which this bank is available
	public function showStates($bank_name){

		//Connects To The Database
		$conn = $this->dbconnect();


		//SQL Query
		$sql = "SELECT DISTINCT state FROM banks WHERE bname = '$bank_name' ";
		$result = $conn->query($sql);
		echo "<div class='ifsc'><label for='state'>State Name</label>";

		//Opening Tag Of Select <select>
		echo "<div><a href='' class='refrence-icon-null'></a></div><select class='form-control' name = 'state' id='state' onchange = 'window.location.href=this.options[this.selectedIndex].value'>";

		//By default option (Select Your Bank Here)
		echo "<option value = '0'>Select Your State</option>";

		//while loop to fetch the bank names and print them out
		while ($row = $result->fetch_assoc()) {
			echo "<option value='".str_replace(' ', '-',strtolower($row['state']))."/'>".$row['state']."</option>";
		}

		//Closing Tag Of Select </select>
		echo "</select></div>";
		echo "<div class='ifsc'><label for='district'>District Name</label>";

		echo "<div><a href='' class='refrence-icon-null'></a></div><select class='form-control' ><option>Select District</option></select></div>";	
		echo "<div class='ifsc'><label for='branch'>Branch Name</label>";

		echo "<div><a href='' class='refrence-icon-null'></a></div><select class='form-control' ><option>Select Branch</option></select></div>";
	}

	//showDistricts() function shows all the states in which this bank is available
	public function showDistricts($bank_name, $state){

		//Connects To The Database
		$conn = $this->dbconnect();
		$this->state = $state;
	
		//SQL Query
		$sql = "SELECT DISTINCT district FROM banks WHERE bname = '$bank_name' AND state = '$state' ";
		$result = $conn->query($sql);
		echo "<div class='ifsc'><label for='district'>District Name</label>";

		//Opening Tag Of Select <select>
		echo "<div><a href='' class='refrence-icon-null'></a></div><select class='form-control' name = 'district' id='district' onchange = 'window.location.href=this.options[this.selectedIndex].value'>";

		//By default option (Select Your Bank Here)
		echo "<option value = '0'>Select Your District</option>";
		//while loop to fetch the bank names and print them out
		while ($row = $result->fetch_assoc()) {
			echo "<option value='".str_replace(' ', '-',strtolower($row['district']))."/'>".$row['district']."</option>";
		}

		//Closing Tag Of Select </select>
		echo "</select></div>";
	
		echo "<div class='ifsc'><label for='branch'>Branch Name</label>";

		echo "<div><a href='' class='refrence-icon-null'></a></div><select class='form-control' ><option>Select Branch</option></select></div><br>";

	}

		public function showBranch($bank_name, $state, $district){

		//Connects To The Database
		$conn = $this->dbconnect();

		//Saves The Bank Name In The Public variable bankname ($bankname)
		//SQL Query
		$sql = "SELECT DISTINCT  * FROM banks WHERE bname = '$bank_name'AND state = '$state' AND district = '$district' ";
		$result = $conn->query($sql);
		echo "<div class='ifsc'><label for='branch'>Branch Name</label>";

		//Opening Tag Of Select <select>
		echo "<div><a href='' class='refrence-icon-null'></a></div><select class='form-control' name = 'branch' id='branch' onchange = 'window.location.href=this.options[this.selectedIndex].value'>";

		//By default option (Select Your Bank Here)
		echo "<option value = '0'>Select Your Branch</option>";

		//while loop to fetch the bank names and print them out
		while ($row = $result->fetch_assoc()) {
			echo "<option value='".str_replace(' ', '-',strtolower($row['branch']))."/'>".$row['branch']."</option>";
			$this->ifsc = $row['branch'];
		}

		//Closing Tag Of Select </select>
		echo "</select></div>";

		//Saves The Whole Bank Info
	}

	public function getInfo($bank_name, $state, $district, $branch){

		$conn = $this->dbconnect();

		$sql = "SELECT * FROM banks WHERE bname = '$bank_name'AND state = '$state' AND district = '$district' AND branch = '$branch' ";
		$result = $conn->query($sql);

		while ($row = $result->fetch_assoc()) {
			$this->bankname = $row['bname'];
			$this->state = $row['state'];
			$this->district = $row['district'];
			$this->branch = $row['branch'];
			$this->ifsc = $row['ifsc'];
			$this->address = $row['address'];
			$this->mcir = $row['mcir'];
			$this->zip = $row['zip'];
			$this->phone = $row['phone'];
            $this->bcode = $row['bcode'];
            $this->email = $row['email'];
			

		}
		
	}
		public function showOther($state, $district){

		//Connects To The Database
		$conn = $this->dbconnect();
		$this->state = $state;
	
		//SQL Query
		$sql = "SELECT DISTINCT bname, state, district FROM banks WHERE state = '$state' AND district = '$district' ";
		$result = $conn->query($sql);
		echo "<ul>";



		//By default option (Select Your Bank Here)
		//while loop to fetch the bank names and print them out
		while ($row = $result->fetch_assoc()) {
			echo "<li><a href='/".str_replace(' ', '-', strtolower($row['bname']))."/".str_replace(' ', '-', strtolower($row['state']))."/".str_replace(' ', '-', strtolower($row['district']))."/'>".$row['bname']."</a></li>";
		}

        echo "</ul>";

	}

    
	
	
//END OF THE CLASS IFSCcodes (END)
}

?>