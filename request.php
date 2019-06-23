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
  
  $r_id = intval(parse_data($_POST["r_id"]));
  $units_req = intval(parse_data($_POST["units"]));
  $date = parse_data($_POST["date"]);



    $sql = "insert into Blood_Request (R_Id,Units_Required, Till_Required_Date)values ($r_id, $units_req,'$date')";
   
    if (mysqli_query($conn, $sql)) {
        echo "New request queued successfully"."<br>";

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql1 = "SELECT R_blood_group FROM Blood_Recipient where R_id = $r_id";
    $result1 = mysqli_query($conn, $sql1);
    $bg_row = $result1->fetch_assoc();
    
    echo $bg_row['R_blood_group']."<br>";
    $r_bg=$bg_row['R_blood_group'];
    // $r_bg=mysqli_real_escape_string($conn,$r_bg);


    $sql2 = "SELECT B_id FROM R_Associated_With where R_id = $r_id";
    $result2 = mysqli_query($conn, $sql2);
    $bank_row = $result2->fetch_assoc();
    
    echo $bank_row['B_id']."<br>";
    $r_b=$bank_row['B_id'];    

    $sql3 = "SELECT $r_bg FROM Blood_Units_Available where B_ID = $r_b";
    $result3= mysqli_query($conn,$sql3);
    $bunits_row= $result3->fetch_assoc();
    echo $r_b,$r_bg;

    echo $bunits_row[$r_bg]."<br>";
    $bunits=$bunits_row[$r_bg]; 

    if($units_req <= $bunits){
        //Issue blood
        //Decrement in blood available
        //Delete entry
        $sql4 = "insert into Blood_Units_Issued (R_id, Units_Issued, DateAndTime,B_id)values ($r_id, $units_req,NOW(),$r_b)";
   
        if (mysqli_query($conn, $sql4)) {
            echo "New Enrty made in blood_issued successfully"."<br>";

        } else {
            echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
        }

         $sql5 = "update Blood_Units_Available set $r_bg = $r_bg- $units_req where B_ID= $r_b";
             if (mysqli_query($conn, $sql5)) {
                echo " record updated successfully";
            } else {
                echo "Error: " . $sql5 . "<br>" . mysqli_error($conn);
            }

         $sql6 = "delete from Blood_Request where R_ID = $r_id";
            if (mysqli_query($conn, $sql6)) {
                echo "You have been issued blood. Your entry is deleted";
            } else {
                echo "Error: " . $sql6 . "<br>" . mysqli_error($conn);
            }            



    }else{
        echo "Your reuest has been made. Currently no blood is available";
    }







    // while ($row = $result1->fetch_assoc()) {
    //             echo $row['R_blood_group']."<br>";
    //             $r_bg=$row['R_blood_group'];
                    
    //                 $sql2 = "insert into D_Disease (D_ID,D_disease) values ($d_id,'$disease')";

    //                 if (mysqli_query($conn, $sql2)) {
    //                     echo "New Disease record created successfully"."<br>";
    //                 } else {
    //                     echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    //                 }
                

    //                 $sql3= "insert into D_Associated_with (D_ID,B_ID) values ($d_id,'$b_id')";

    //                 if (mysqli_query($conn, $sql3)) {
    //                     echo "New Associated with record created successfully"."<br>";
    //                 } else {
    //                     echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    //                 }

    //             break;
            
    //         }

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
input[type=date], select {
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
 <title>Request</title>
    </head>
    <body>
        <div class="screen" align="center">
            <div class="header">  
                <h2 align="center">Request Form</h2>
            </div>
            <br>
            <br>
                <div>
                    <br><br>
                <form align="left" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <br><br>
                <label for="did">Recipient ID:</label><br>
                    <input type="number" id="rid" name="r_id" placeholder="Enter Your ID "><br>
                <br><br>
                <label for="did">Unit Required:</label><br>
                    <input type="number" id="units" name="units" placeholder="Enter Units Required "><br>
				<br><br>
                <label for="did">Till Required Date:</label><br>
                    <input type="date" id="date" name="date"><br>
                    <br>
        
                    
            <button class="button sub" >SUBMIT</button>
  	    <button class="button back" formaction="home.html" >BACK</button>
            </form>
        </div>
        </div>
        <br>
    </body>
</html>
