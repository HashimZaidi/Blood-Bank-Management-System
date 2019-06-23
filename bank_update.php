<?php
$servername = "127.0.0.1";
$username = "root";
$password = "Algc1996";
$dbname = "Blood_Bank";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $b_id = intval(parse_data($_POST["b_id"]));
  // $u_type = parse_data($_POST["u_type"]);
  $b_name = parse_data($_POST["b_name"]);
  $address = parse_data($_POST["address"]);
  $ph_no = parse_data($_POST["ph_no"]);

    // $sql = "SELECT * FROM blood_bank where B_ID= $b_id";

    //     // and D_Age= $age, and D_Phone_No= $ph_no, and D_Blood_Group = '$b_group' ";
    //     $result = mysqli_query($conn, $sql);
    //     $num_rows = mysqli_num_rows($result);
    //     if ($num_rows>0) {
    //         echo "Bank entry exists";
    //     } else if($num_rows==0){
    //         // echo "Bank ID doesn't exist! Plz wake up."
    //         // echo '<script type="text/javascript">alert("Invalid Bank ID type. Retry");</script>';
    //     }        

    // if($num_rows>0 )  //FOr donor
    // {

    $sql2 = "SELECT * FROM blood_bank
     where B_ID= $b_id";

    // and D_Age= $age, and D_Phone_No= $ph_no, and D_Blood_Group = '$b_group' ";
    $result2 = mysqli_query($conn, $sql2);
    $num_rows = mysqli_num_rows($result2);
    if ($num_rows>0) {
        echo "Bank entry exists";
        $sqld = "update blood_bank set B_Name='$b_name', B_Address='$address', B_Phone_No='$ph_no' where B_ID=$b_id";

        if (mysqli_query($conn, $sqld)) {
            echo "record updated";
        } else {
            echo "Error: " . $sqld . "<br>" . mysqli_error($conn);
        }
    } else if($num_rows==0){
        // echo "Bank ID doesn't exist! Plz wake up."
        // echo '<script type="text/javascript">alert("Invalid ID type. Retry");</script>';
    }

}

function parse_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

mysqli_close($conn);
?>

<html>
    <head>

<style>
   .screen {
    padding: 30px 30px 30px 30px;
        margin: 50px 50px 50px 50px;
     background-color: pink;
     color:black;
     }
div
    {
        font-family: verdana;
     }
        .header {
     width: 30%;
  margin: 50px auto 0px;
  color: white;
  background: maroon;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
.button{
    padding: 10px;
  font-size: 15px;
  color: white;
  background: #5F9EA0;
  border: none;
  border-radius: 5px;
}
        .sub
        {
            background-color: #5F9EA0;
        }
        .back
        {
            background-color: dimgray;
        }
.button:hover {
    background-color:green;
    color:white;
}
        body 
{
  background-image: url("b.jpg");
}
        input[type=text], select {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=number], select {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
} 
</style>
 <title>Bank Update</title>
    </head>
    <body>
        <div class="screen" align="center">
            <div class="header">  
                <h2 align="center">Update Details</h2>
            </div>
            <br>
            <br>
                <div>
                <form align="left" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <label for="did">Bank Id:</label><br>
                <input type="number" id="bid" name="b_id" placeholder="Enter Bank Id "><br>
                <label for="did">Bank Name:</label><br>
                <input type="text" id="bn" name="b_name" placeholder="Enter Bank Name "><br>
                <label for="did">Address:</label><br>
                    <input type="text" id="ad" name="address" placeholder="Enter Location "><br>
				<label for="did">Phone number:</label><br>
                    <input type="number" id="phno" name="ph_no" placeholder="Enter your phone number"><br>
                    <br>
        
                    
            <button class="button sub" >SUBMIT</button>
  	    <button class="button back" formaction="home.html" >BACK</button>
            </form>
        </div>
        </div>
        <br>
    </body>
</html>
