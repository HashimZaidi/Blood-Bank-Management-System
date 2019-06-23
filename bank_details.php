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
 <title>Bank Details</title>
    </head>
    <body>
        <div class="screen" align="center">
            <div class="header">  
                <h2 align="center">Bank Details</h2>
            </div>
            <br>
            <br>
                <div>
                <form align="left" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
             	<label for="did">Bank Id:</label><br>
                    <input type="text" id="bid" name="b_id" placeholder="Enter Bank Id "><br>
                    <br>
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
  
  $b_id = intval(parse_data($_POST["b_id"]));

  if(isset($_POST['but_view'])){

    $sql4 = "SELECT blood_bank.B_ID,blood_bank.B_Name, blood_bank.B_Address,blood_bank.B_Phone_No";
    
    $result4 = mysqli_query($conn, $sql4);


       while ($row = $result4->fetch_assoc()){
          echo $row['B_ID']," ",$row['B_Name']," ", $row['B_Address']," ", $row['B_Phone_No']."<br>";
        }

  } elseif (isset($_POST['but_del'])) {
    $sql = "delete from blood_bank where B_ID = $b_id";
    if (mysqli_query($conn, $sql)) {
          echo "Your entry is deleted";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
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
            <br>
            <button class="button view" >VIEW</button>
            <button class="button upt" formaction="bank_update.php">UPDATE</button>                    
            <button class="button del" >DELETE</button>
            <button class="button back" formaction="home.html" >BACK</button>
            </form>
        </div>
        </div>
        <br>
    </body>
</html>
