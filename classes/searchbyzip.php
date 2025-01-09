<?php


class searchzip
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

		$sql = "SELECT * FROM banks WHERE zip = '$query'";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {
				
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
           
           echo "<li><a href='https://ifsc.sarkaribank.com/".str_replace(' ', '-', strtolower($row['bname']))."/".str_replace(' ', '-', strtolower($row['state']))."/".str_replace(' ', '-', strtolower($row['district']))."/".str_replace(' ', '-', strtolower($row['branch']))."'>".$row['bname']." ".$row['branch']." branch</a></li>";
			

			}
		}else{

			$this->bankname = "<center><h1>What The Hell!! <br> We Could Not Find It!!</h1></center>";

		}

	}

}



?>