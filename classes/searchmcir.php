<?php


/*
	* This files contains a class which handles all the functions.
	* This is the main class and should be edited with caution
	* Author: Bhupender Singh
	* Author URL: www.facebook.com/bhu08
*/

//START OF THE CLASS NAME IFSCcodes (START)
class ifscmicr
{

	//All the public variables
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
	
	public function find($query){
	    
	    $conn = $this->dbconnect();
	    
	    $sql = "SELECT * FROM banks WHERE mcir = '$query'";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    while($row = $result->fetch_assoc()){

            $this->bankname =  $row['bname'];
            $this->district =  $row['district'];
            $this->state =  $row['state'];
            $this->branch =  $row['branch'];
            $this->ifsc =  $row['ifsc'];
            $this->address =  $row['address'];
            $this->mcir = $row['mcir'];
			$this->zip = $row['zip'];
			$this->phone = $row['phone'];
			$this->bcode = $row['bcode'];
            $this->email = $row['email'];
			


	        
	    }
	   }else{
	       $this->bankname = 'a';
	   }
	   
	}
}
?>