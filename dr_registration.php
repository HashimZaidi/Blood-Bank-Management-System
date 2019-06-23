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
  
  // $d_id = intval(parse_data($_POST["d_id"]));
    $u_type = parse_data($_POST["u_type"]);
    $name = parse_data($_POST["name"]);
    $age = intval(parse_data($_POST["age"]));
    $gender = parse_data($_POST["gender"]);
    $b_group = parse_data($_POST["b_group"]);
    $ph_no = parse_data($_POST["ph_no"]);
    
    $diseases = array();
    $d_1 = parse_data($_POST["d1"]);
    if($d_1 != ''){
        array_push($diseases, $d_1);    
    }
    $d_2 = parse_data($_POST["d2"]);
    if($d_2 != ''){
        array_push($diseases, $d_2);    
    }
    $d_3 = parse_data($_POST["d3"]);
    if($d_3 != ''){
        array_push($diseases, $d_3);    
    }
    $d_4 = parse_data($_POST["d4"]);
    if($d_4 != ''){
        array_push($diseases, $d_4);    
    }
    $d_5 = parse_data($_POST["d5"]);
    if($d_5 != ''){
        array_push($diseases, $d_5);    
    }
    
    $b_ids = array();
    $b_1 = parse_data($_POST["b1"]);
    if($b_1 != ''){
        array_push($b_ids, $b_1);    
    }
    $b_2 = parse_data($_POST["b2"]);
    if($b_2 != ''){
        array_push($b_ids, $b_2);    
    }
    $b_3 = parse_data($_POST["b3"]);
    if($b_3 != ''){
        array_push($b_ids, $b_3);    
    }
    $b_4 = parse_data($_POST["b4"]);
    if($b_4 != ''){
        array_push($b_ids, $b_4);    
    }
    $b_5 = parse_data($_POST["b5"]);
    if($b_5 != ''){
        array_push($b_ids, $b_5);    
    }
    $valid = TRUE;
    foreach ($b_ids as $b_id) {
    
        $sql = "SELECT * FROM blood_bank where B_ID= $b_id";

        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows>0) {
            echo "Bank ",$b_id," exists",'<br>';
        } else {
            $valid = FALSE;
            echo '<script type="text/javascript">alert("Invalid Bank ID type. Retry");</script>';
        }        
    }

    if($num_rows>0 && $u_type=='D' && $valid)
    {
        $sqld = "insert into Blood_Donor (D_Name, D_Gender, D_Age,D_Phone_No, D_Blood_Group)values ('$name','$gender',$age,'$ph_no','$b_group')";

        if (mysqli_query($conn, $sqld)) {
            $d_id = $conn->insert_id;
            echo "New record created successfully. Last inserted ID is: " . $d_id;
        } else {
            echo "Error: " . $sqld . "<br>" . mysqli_error($conn);
        }

        foreach ($diseases as $disease) {
            
            $sql2d = "insert into D_Disease (D_ID,D_disease) values ($d_id,'$disease')";

            if (mysqli_query($conn, $sql2d)) {
                echo "New Disease record created successfully"."<br>";
            } else {
                echo "Error: " . $sql2d. "<br>" . mysqli_error($conn);
            }
        }
    
        foreach ($b_ids as $b_id) {
            
            $sql3d= "insert into D_Associated_With (D_ID,B_ID) values ($d_id,'$b_id')";

            if (mysqli_query($conn, $sql3d)) {
                echo "New Associated with record created successfully"."<br>";
            } else {
                echo "Error: " . $sql3d . "<br>" . mysqli_error($conn);
            }            
        }
    }else if($num_rows>0 && $u_type=='R' && $valid)
    {
        $sql = "insert into Blood_Recipient (R_name, R_gender, R_age,R_phone_No, R_blood_group)values ('$name','$gender',$age,$ph_no,'$b_group')";

        if (mysqli_query($conn, $sql)) {
            $r_id = $conn->insert_id;
            echo "New record created successfully. Last inserted ID is: " . $r_id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        foreach ($diseases as $disease) {
            
            $sql2r = "insert into R_Disease (R_id,R_disease) values ($r_id,'$disease')";

            if (mysqli_query($conn, $sql2r)) {
                echo "New Disease record created successfully"."<br>";
            } else {
                echo "Error: " . $sql2r. "<br>" . mysqli_error($conn);
            }
        }
    
        foreach ($b_ids as $b_id) {
            
            $sql3r= "insert into R_Associated_With (R_id,B_id) values ($r_id,'$b_id')";

            if (mysqli_query($conn, $sql3r)) {
                echo "New Associated with record created successfully"."<br>";
            } else {
                echo "Error: " . $sql3r . "<br>" . mysqli_error($conn);
            }            
        }
    } elseif ($num_rows==0) {
            echo '<script type="text/javascript">alert("Please Enter atleast 1 BloodBank ID");</script>';
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
  margin: 0px auto 0px;
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
 <title>User Registration</title>
    </head>
    <body>
        <div class="screen" align="center">
            <div class="header">  
                <h2 align="center">Registration Form</h2>
            </div>
            <br>
            <br>
                <div>
                <form align="left" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <label for="did">User Type:</label><br>
					<select id="ut" name="u_type">
						<option value="">Select</option>
						<option value="D">Donor</option>
						<option value="R">Recipient</option>
					</select><br>
             	<label for="did">Name:</label><br>
                    <input type="text" id="name" name="name" placeholder="Enter your Name "><br>
				<label for="did">Gender:</label><br>
					<select id="gender" name="gender">
						<option value="">Select</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select><br>
                <label for="did">Age:</label><br>
                    <input type="number" id="age" name="age" placeholder="Enter your Age"><br>
                <label for="did">Blood Group:</label><br>
                    <select id="bg" name="b_group">
						<option value="">Select</option>
						<option value="Ap">A+</option>
						<option value="An">A-</option>
						<option value="Bp">B+</option>
						<option value="Bn">B-</option>
						<option value="ABp">AB+</option>
						<option value="ABn">AB-</option>
						<option value="Op">O+</option>
						<option value="Onn">O-</option>
					</select><br>
                <label for="did">Phone number:</label><br>
                    <input type="number" id="phno" name="ph_no" placeholder="Enter your phone number"><br>
                    <br>
                    <div class="header">  
                        <h2 align="center">Disease Information</h2>
                    </div>
                    <br>
                    <br>
                        Enter Diseases if any: <br>
                        <input type="text" name="d1" placeholder="Disease 1">
                        <input type="text" name="d2" placeholder="Disease 2">
                        <input type="text" name="d3" placeholder="Disease 3">
                        <input type="text" name="d4" placeholder="Disease 4">
                        <input type="text" name="d5" placeholder="Disease 5">
                    <br>
                    <br>
                    <div class="header">  
                        <h2 align="center">Bank Information</h2>
                    </div>
                    <br>
                    <br>
                        Enter IDs of Associated BloodBank(atleast 1) : <br>
                        <input type="number" name="b1" placeholder="BloodBank ID"> <br>
                        <input type="number" name="b2" placeholder="BloodBank ID"> <br>
                        <input type="number" name="b3" placeholder="BloodBank ID"> <br>
                        <input type="number" name="b4" placeholder="BloodBank ID"> <br>
                        <input type="number" name="b5" placeholder="BloodBank ID"> <br>
                    <br>
        
            <button class="button nxt" >SUBMIT</button>
            <button class="button back" formaction="home.html" >BACK</button>
            </form>
        </div>
        </div>
        <br>
    </body>
</html>
