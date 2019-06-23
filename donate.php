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
  
  $d_id = intval(parse_data($_POST["D_id"]));
  $b_id = intval(parse_data($_POST["B_id"]));
  $bd_id = intval(parse_data($_POST["BD_id"]));

  $sqla =  "SELECT B_ID FROM Blood_Drive where BD_ID=$bd_id";
  $resulta = mysqli_query($conn, $sqla);
  $bank_row = $resulta->fetch_assoc();
  echo $bank_row['B_ID']."<br>";
  $assoc_bank=$bank_row['B_ID'];  

  if($assoc_bank==$b_id OR !$bd_id)
  {
    if($bd_id){
        echo "Bank is doing this blood_drive";
        $sql = "insert into Blood_Donated (D_iD, B_ID, BD_id)values ($d_id, $b_id,$bd_id)";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

    }else{

            $sql = "insert into Blood_Donated (D_iD, B_ID)values ($d_id, $b_id)";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    }
    
    $sql1 = "SELECT D_Blood_Group FROM Blood_Donor where D_ID=$d_id";
    $result1 = mysqli_query($conn, $sql1);
    // $num_rows = mysqli_num_rows($result1);
    $row = $result1 ->fetch_assoc();
    echo $row['D_Blood_Group']."<br>";
    $blood_group=$row['D_Blood_Group'];

    $sql3 = "update Blood_Units_Available set $blood_group = $blood_group + 1 where B_ID=$b_id";
     if (mysqli_query($conn, $sql3)) {
        echo " record updated successfully"."<br>";
    } else {
        echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    }


    $sql5 = "SELECT $blood_group FROM Blood_Units_Available where B_ID = $b_id";
    $result5= mysqli_query($conn,$sql5);
    $bunits_row= $result5->fetch_assoc();
    echo $bunits_row[$blood_group]."<br>";
    $bunits=$bunits_row[$blood_group];

    //With same bank and same blood_group check entry in blood request if blood bank has blood 
    echo "started doing inner join: "."<br>";
    $sql4 = "SELECT Blood_Request.R_Id,Blood_Request.Units_Required, Blood_Recipient.R_blood_group FROM Blood_Request INNER JOIN Blood_Recipient ON Blood_Request.R_Id = Blood_Recipient.R_id ";
      $result4 = mysqli_query($conn, $sql4);

    while ($row = $result4->fetch_assoc())
    {
      echo $row['R_blood_group']."<br>";
      echo $row['Units_Required']."<br>";
      $units_req= $row['Units_Required'];
      $r_id= $row['R_Id'];
      $r_blood_group = $row['R_blood_group'];

      echo "check1";



      if($units_req <= $bunits && $blood_group==$r_blood_group){
      //Issue blood
      //Decrement in blood available
      //Delete entry
      $sql6 = "insert into Blood_Units_Issued (R_id, Units_Issued,B_id)values ($r_id,$units_req,$b_id)";

      if (mysqli_query($conn, $sql6)) {
          echo "New Enrty made in blood_issued successfully"."<br>";

      } else {
          echo "Error: " . $sql6 . "<br>" . mysqli_error($conn);
      }

       $sql7 = "update Blood_Units_Available set $blood_group = $blood_group- $units_req where B_ID= $b_id";
           if (mysqli_query($conn, $sql7)) {
              echo " Blood record decremented successfully";
          } else {
              echo "Error: " . $sql7 . "<br>" . mysqli_error($conn);
          }

       $sql8 = "delete from Blood_Request where R_ID = $r_id";
          if (mysqli_query($conn, $sql8)) {
              echo "A blood requeste have been issued blood. His entry is deleted";
          } else {
              echo "Error: " . $sql8 . "<br>" . mysqli_error($conn);
          }            
          $bunits=$bunits - $units_req;
       }
    }
  }else{
    echo '<script type="text/javascript">alert("No such blood drive is conducted by the bank. Retry");</script>';

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
  margin: 10px auto 0px;
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
 <title>Donate</title>
    </head>
    <body>
        <div class="screen" align="center">
            <div class="header">  
                <h2 align="center">Donation Form</h2>
            </div>
            <br>
            <br>
                <div>
                <br>
            	<br>
                <form align="left" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <label for="did">Donor ID:</label><br>
                    <input type="number" id="did" name="D_id" placeholder="Enter Your ID: "><br>
                <br>
                <br>
                <label for="did">BloodBank ID:</label><br>
                    <input type="number" id="b_id" name="B_id" placeholder="Enter BloodBank ID: "><br>
        				<br>
        				<br>
        				<label for="did">Blood Drive ID:</label><br>
                    <input type="number" id="bdid" name="BD_id" placeholder="Enter BloodDrive ID: "><br>
                <br>
                <br>
                    
            <button class="button sub" >SUBMIT</button>
      	    <button class="button back" formaction="home.html" >BACK</button>
            </form>
        </div>
        </div>
        <br>
    </body>
</html>
