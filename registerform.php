<?php 
if(isset($_POST['submit']))
{
	$server="ronakpatel.ipagemysql.com";
	$user="ronakpatel";
	$pass="ronakalpha1910";
	$db="hackuwin";

$con = mysql_connect($server,$user,$pass);
if(!$con) die("Cannot Connect".mysql_error());
mysql_select_db($db,$con) or die("Cannot Select".mysql_error());;

$name = 	isset($_POST['name'])? $_POST['name']:"";
$name = 	mysql_real_escape_string($name);

$email = 	isset($_POST['email'])? $_POST['email']:"";
$email = 	mysql_real_escape_string($email);

$password = 	isset($_POST['password'])? $_POST['password']:"";
$password = 	mysql_real_escape_string($password);

$repassword = 	isset($_POST['repassword'])? $_POST['repassword']:"";
$repassword = 	mysql_real_escape_string($repassword);

$gender = 	isset($_POST['gender'])? $_POST['gender']:"";
$gender = 	mysql_real_escape_string($gender);

$school = 	isset($_POST['school'])? $_POST['school']:"";
$school = 	mysql_real_escape_string($school);

//$liability = 	isset($_POST['liability'])? $_POST['liability']:"";
//$liability = 	mysql_real_escape_string($liability);

$year = 	isset($_POST['year'])? $_POST['year']:"";
$year = 	mysql_real_escape_string($year);

$linkedin = 	isset($_POST['linkedin'])? $_POST['linkedin']:"";
$linkedin = 	mysql_real_escape_string($linkedin);

$github = 	isset($_POST['github'])? $_POST['github']:"";
$github = 	mysql_real_escape_string($github);

$personal_website = 	isset($_POST['personal_website'])? $_POST['personal_website']:"";
$personal_website = 	mysql_real_escape_string($personal_website);

$shirt_size = 	isset($_POST['shirt_size'])? $_POST['shirt_size']:"";
$shirt_size = 	mysql_real_escape_string($shirt_size);

$diet = 	isset($_POST['diet'])? $_POST['diet']:"";
$diet = 	mysql_real_escape_string($diet);

$experience = 	isset($_POST['experience'])? $_POST['experience']:"";
$experience = 	mysql_real_escape_string($experience);

$liability = $_FILES["liability"]["name"];

//file
if ($_FILES["liability"]["error"] > 0) {
    echo "Return Code: " . $_FILES["liability"]["error"] . "<br>";
  } else {
    
$newfilename = $name.rand(1,99999).$_FILES["liability"]["name"];
move_uploaded_file($_FILES["liability"]["tmp_name"], "uploadwaiver/" . $newfilename);
      //move_uploaded_file($_FILES["liability"]["tmp_name"], "../uploadwaiver/". $_FILES["liability"]["name"]);
    
  }
$liability = $newfilename;
//mail

$to = $email;

// subject
$subject = 'HackUWIN 2014 Registration';

// message
$message = '
<html>
<head>
  <title>HackUWIN 2014 Registration</title>
</head>
<body>
<div id="content">
	<div></div>
	<div><img src="http://hackuwin.com/images/hackuwin.png" height="250" width="320" align="middle"></div><br/><br/>
	<div>
	Hi ' . $name . '! <br/><br/>You are successfully registered for HackUWIN 2014.<br/>
        <a href="http://www.hackuwin.com" target="_blank">Click Here</a> to go back to HackUWIN website and have a look at other stuffs. Happy Hacking!!<br/><br/><br/>
  Regards,<br/>Force HackUWIN<br/>
<a href="https://www.facebook.com/HackUWIN2014" target="_blank"><img src="http://hackuwin.com/images/facebook_256.png" height="50" width="50"></a>
<a href="https://twitter.com/HackUWIN" target="_blank"><img src="http://hackuwin.com/images/twittersd.jpg" height="50" width="50"></a>  
</div>
  </div>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: ' . $email . "\r\n";
$headers .= 'From: noreply@hackuwin.com' . "\r\n";



$access = "SELECT * FROM registration WHERE (email = '$email')";
$access = mysql_query($access);
$accessrow = mysql_num_rows($access);

if($accessrow == 1)
{
    header('Location: cheers.html');
}
else
{
	$sql1= "INSERT INTO registration (name,email,pwd,repwd,gender,school,lw,year,li,gh,pw,ssize,diet,exp) VALUES('$name','$email','$password','$repassword','$gender','$school','$liability','$year','$linkedin','$github','$personal_website','$shirt_size','$diet','$experience')";
	mysql_query($sql1) or die("Cannot Query".mysql_error());
// Mail it
mail($to, $subject, $message, $headers);
	header('Location: registersuccessful.html');
}
mysql_close($con);
}
?>