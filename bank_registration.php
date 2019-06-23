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

 if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  
    $b_name = parse_data($_POST["b_name"]);
    $address = parse_data($_POST["address"]);
    $ph_no = parse_data($_POST["ph_no"]);

    $sql = "insert into blood_bank (B_Name, B_Address, B_Phone_No)values ('$b_name','$address', '$ph_no')";

    if (mysqli_query($conn, $sql)) {
      $last_id = $conn->insert_id;
      echo "New record created successfully. Last inserted ID is: " . $last_id;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql1 = "insert into Blood_Units_Available (B_ID) values ($last_id)";
     if (mysqli_query($conn, $sql1)) {
        echo "New bank record created in blood_units_available successfully";
    } else {
        echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
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
 <title>Bank Registration</title>
    </head>
    <body>
        <div class="screen" align="center">
            <div class="header">  
                <h2 align="center">Bank Registration Form</h2>
            </div>
            <br>
            <br>
                <div>
                <form align="left" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
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
