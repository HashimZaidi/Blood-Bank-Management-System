Algc1996<?php
$servername = "127.0.0.1";
$username = "root";
$password = "Algc1996";
$dbname = "Blood_Bank";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  
    $b_id = intval(parse_data($_POST["b_id"]));
    $bd_name = parse_data($_POST["bd_name"]);
    $date = parse_data($_POST["date"]);

    $sql = "insert into Blood_Drive (Blood_Drive_Name, B_ID, Date)values ('$bd_name', $b_id, '$date')";
    if(strlen($bd_name)==0){
        echo '<script type="text/javascript">alert("No Blood Drive Name. Retry");</script>';
    }
    else if (mysqli_query($conn, $sql)) {
        echo "New blood drive record created successfully";
    } else {
        echo '<script type="text/javascript">alert("Invalid Bank ID type. Retry");</script>';
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
input[type=date], select {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
 </style>
 <title>Blood Drive</title>
    </head>
    <body>
        <div class="screen" align="center">
            <div class="header">  
                <h2 align="center">Add Blood Drive</h2>
            </div>
            <br>
            <br>
                <div>
                <form align="left" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <label for="did">Bank Id:</label><br>
                    <input type="number" id="bid" name="b_id" placeholder="Enter Bank id "><br>
                <label for="did">Blood Drive Name:</label><br>
                    <input type="text" id="bdname" name="bd_name" placeholder="Enter BloodDrive Name "><br>
				        <label for="did">Date:</label><br>
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
