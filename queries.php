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
 <title>QUERIES</title>
    </head>
    <body>
        <div class="screen" align="center">
            <div class="header">  
                <h2 align="center">QUERIES</h2>
            </div>
            <br>
            <br>
            <div>
            <form align="left" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
 
              <label>Disease:</label><br>
              <input type="text" name="disease" placeholder="Enter Disease Name"><br>
              <button name="query1" class="button sub" >QUERY 1</button><br>
              <br>
              <br>
 
              <label for="gender">Gender:</label><br>
              <select id="gender" name="gender">
                <option value="">Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select><br>
              <label for="bg">Blood Group:</label><br>
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
              </select>
              <br>
              <button name="query4" class="button sub"" >QUERY 4</button><br>
              <br>
              <br>

              <label for="bid">BloodBank Id:</label><br>
              <input type="name" id="bid" name="b_id" placeholder="Enter BloodBank ID"><br>
              <br>
              <button name="query5" class="button sub" >QUERY 5</button><br>
              <br>
              <br>
              
              <button name="query6" class="button sub"" >QUERY 6</button><br>
              <br>
              <button name="query8" class="button sub" >QUERY 8</button><br>
              <br>
              <button name="query10" class="button sub" >QUERY 10</button><br>
            </form>
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

$disease = parse_data($_POST["disease"]);
$gender = parse_data($_POST["gender"]);
$b_group = parse_data($_POST["b_group"]);
$b_id = intval(parse_data($_POST["b_id"]));
$counts = array('Ap'=>0,'An'=>0,'Bp'=>0,'Bn'=>0,'Op'=>0,'Onn'=>0,'ABp'=>0,'ABn'=>0);
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if(isset($_POST['query1'])){
    $sql1= "SELECT D_ID from D_Disease where D_disease='$disease' ";
    $result = mysqli_query($conn, $sql1);
    $num_donors = mysqli_num_rows($result);
    $sql1= "SELECT R_id from R_Disease where R_disease='$disease' ";
    $result = mysqli_query($conn, $sql1);
    $num_acceptors = mysqli_num_rows($result);
    if($num_donors!=0 && $num_acceptors!=0){
     if($num_donors>$num_acceptors){
     echo "Donors are greater<br>";
     }else if($num_donors==$num_acceptors){
     echo "Acceptors and donors are equall\n";
     }else{
     echo "Acceptors are greater"."<br>";
     }
    }else{
     echo "No such disease exist in donor and acceptor<br>";
    }
  }else if(isset($_POST['query4'])){
    $sql= "SELECT D_Name FROM Blood_Donor WHERE
    D_Blood_Group = '$b_group' and D_Gender = '$gender'";
    $result = mysqli_query($conn, $sql);
    $nums = mysqli_num_rows($result);
    if($nums>0){
    while ($row = $result->fetch_assoc()){
     echo $row['D_Name']."<br>";
    }
    }else{
     echo "No donor with this blood_group exists<br>";
    }
  }else if(isset($_POST['query5'])){
    $sql2="SELECT D_Blood_Group
    FROM Blood_Donor INNER JOIN D_Associated_With ON Blood_Donor.D_ID = D_Associated_With.D_ID
    WHERE B_ID=$b_id";
    $result2 = mysqli_query($conn, $sql2);
    while ($row = $result2->fetch_assoc()){
      if($row['D_Blood_Group']=='Ap'){
        $counts['Ap']++;
      }else if($row['D_Blood_Group']=='An'){
        $counts['An']++;
      }else if($row['D_Blood_Group']=='Bp'){
        $counts['Bp']++;
      }else if($row['D_Blood_Group']=='Bn'){
        $counts['Bn']++;
      }else if($row['D_Blood_Group']=='Op'){
        $counts['Op']++;
      }else if($row['D_Blood_Group']=='Onn'){
        $counts['Onn']++;
      }else if($row['D_Blood_Group']=='ABp'){
        $counts['ABp']++;
      }else if($row['D_Blood_Group']=='ABn'){
        $counts['ABn']++;
      }
    }
    $maxs = array_keys($counts, max($counts));
    foreach ($maxs as $max) {
      echo "Maximum blood group is: ", $max.'<br>';
    }
    $mins = array_keys($counts, min($counts));
    foreach ($mins as $min) {
    echo "Minimum blood group is: ", $min.'<br>';
    }
  }else if(isset($_POST['query6'])){
    $sql6 ="SELECT * FROM (SELECT R_id,SUM(Units_Issued) AS S,B_id FROM Blood_Units_Issued GROUP BY B_id,R_id) AS T WHERE S>=2";
    $result = mysqli_query($conn, $sql6);
    while ($row = $result->fetch_assoc()){
      echo 'Recipient ID:',$row['R_id'],' Units Issued:',$row['S'],' BloodBank Id',$row['B_id']."<br>";
    }
  }else if(isset($_POST['query8'])){
    $sql8 = "SELECT Blood_Group,No_Diseases FROM (SELECT Blood_Group,COUNT(Disease) AS No_Diseases FROM ((SELECT D_Blood_Group AS Blood_Group,D_disease AS Disease FROM Blood_Donor INNER JOIN D_Disease ON Blood_Donor.D_ID=D_Disease.D_ID) UNION (SELECT R_blood_group,R_disease FROM Blood_Recipient INNER JOIN R_Disease ON Blood_Recipient.R_id=R_Disease.R_id)) AS T1 GROUP BY Blood_Group) AS T2 WHERE No_Diseases=(SELECT MAX(No_Diseases) FROM (SELECT Blood_Group,COUNT(Disease) AS No_Diseases FROM ((SELECT D_Blood_Group AS Blood_Group,D_disease AS Disease FROM Blood_Donor INNER JOIN D_Disease ON Blood_Donor.D_ID=D_Disease.D_ID) UNION (SELECT R_blood_group,R_disease FROM Blood_Recipient INNER JOIN R_Disease ON Blood_Recipient.R_id=R_Disease.R_id)) AS T1 GROUP BY Blood_Group) AS T2)";
    $result = mysqli_query($conn, $sql8);
      while ($row = $result->fetch_assoc()){
        echo 'Blood Group:',$row['Blood_Group'];
      }
  }else if(isset($_POST['query10'])){
    $sql2 = "SELECT DISTINCT
    Blood_Donor.D_Age,Blood_Donated.BD_id FROM Blood_Donor
    LEFT OUTER JOIN Blood_Donated ON Blood_Donor.D_ID =
    Blood_Donated. D_ID";
    $result2 = mysqli_query($conn, $sql2);
    while ($row = $result2->fetch_assoc()){
     if(is_null($row['BD_id'])){
     echo "Donated in drive<br>";
     $drive_donate += $row['D_Age'];
     $num_drive_d++;
     echo "drive is: ",$num_drive_d.'<br>';
     }else{
     $bank_donate += $row['D_Age'];
     $num_bank_d+=1;
     }
    }
    if($num_bank_d!=0){
     $avg1=$bank_donate / $num_bank_d;
     echo "bank donation average is: ",$avg1.'<br>' ;
    }
    if($num_drive_d!=0){
     $avg2 = $drive_donate / $num_drive_d;
     echo "Drive donation average is: ",$avg2.'<br>';
    }
    echo "difference is: ", $avg1 - $avg2,"<br>";
  }
}

function parse_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$conn->close();
?>
        </div>
        </div>
        <br>
    </body>
</html>
