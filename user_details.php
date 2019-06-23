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
 <title>User Details</title>
    </head>
    <body>
        <div class="screen" align="center">
            <div class="header">  
                <h2 align="center">User Details</h2>
            </div>
            <br>
            <br>
                <div>
                <form align="left" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <label for="ut">User Type:</label><br>
					<select id="ut" name="u_type">
						<option value="">Select</option>
						<option value="Donor">Donor</option>
						<option value="Recipient">Recipient</option>
					</select><br>
             	<label for="uid">User Id:</label><br>
                    <input type="text" id="uid" name="u_id" placeholder="Enter your Id "><br>
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
  
  $u_id = intval(parse_data($_POST["u_id"]));
  $u_type = parse_data($_POST["u_type"]);

  if(isset($_POST['but_view'])){
    if($_POST['u_type']=='Donor'){
      $sql = "SELECT D_ID,D_Name, D_Gender, D_Age, D_Phone_No,D_Blood_Group 
              FROM Blood_Donor 
              WHERE D_ID=$u_id";
      
      $result = mysqli_query($conn, $sql);
      echo "PERSONAL INFORMATION"."<br>";
       while ($row = $result->fetch_assoc()){
          echo $row['D_ID']," ",$row['D_Name']," ", $row['D_Gender']," ",$row['D_Age']," ",$row['D_Phone_No']," ", $row['D_Blood_Group']."<br>";
      }

      $sql1 ="SELECT D_disease 
              FROM D_Disease
              WHERE D_ID=$u_id";

      $result1 = mysqli_query($conn, $sql1);
      echo "DISEASES(IF ANY)"."<br>";
      while ($row = $result1->fetch_assoc()){
        echo $row['D_disease']."<br>";
      }

      $sql2 ="SELECT B_ID 
              FROM D_Associated_With
              WHERE D_ID=$u_id";

      $result2 = mysqli_query($conn, $sql2);
      echo "ASSOCIATED BLOOD BANK ID(S)"."<br>";
      while ($row = $result2->fetch_assoc()){
        echo $row['B_ID']."<br>";
      }

    }elseif($_POST['u_type']=='Recipient'){
      $sql ="SELECT R_id,R_name, R_gender,R_age, R_phone_No,R_blood_group 
              FROM Blood_Recipient
              WHERE R_id=$u_id";
      
      $result = mysqli_query($conn, $sql);
      echo "PERSONAL INFORMATION"."<br>";
       while ($row = $result->fetch_assoc()){
          echo $row['R_id']," ",$row['R_name']," ", $row['R_gender']," ",$row['R_age']," ",$row['R_phone_No']," ", $row['R_blood_group']."<br>";
      }

      $sql1 ="SELECT R_disease 
              FROM R_Disease
              WHERE R_id=$u_id";

      $result1 = mysqli_query($conn, $sql1);
      echo "DISEASES(IF ANY)"."<br>";
      while ($row = $result1->fetch_assoc()){
        echo $row['R_disease']."<br>";
      }

      $sql2 ="SELECT B_id 
              FROM R_Associated_With
              WHERE R_id=$u_id";

      $result2 = mysqli_query($conn, $sql2);
      echo "ASSOCIATED BLOOD BANK ID(S)"."<br>";
      while ($row = $result2->fetch_assoc()){
        echo $row['B_id']."<br>";
      }
    }
  } elseif (isset($_POST['but_del'])) {
    if($_POST['u_type'] == 'Donor'){
      $sql = "delete from Blood_Donor where D_ID = $u_id";
      if (mysqli_query($conn, $sql)) {
            echo "Your entry is deleted";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif($_POST['u_type'] == 'Recipient'){
      $sql = "delete from Blood_Recipient where R_id = $u_id";
      if (mysqli_query($conn, $sql)) {
            echo "Your entry is deleted";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
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
            <button name="but_view" class="button view" value="view" >VIEW</button>
            <button name="but_don_upt" class="button upt" formaction="dr_update.php">UPDATE</button> 
            <button name="but_del" class="button del" >DELETE</button>
            <button class="button back" formaction="home.html" >BACK</button>
            </form>
        </div>
        </div>
        <br>
    </body>
</html>
