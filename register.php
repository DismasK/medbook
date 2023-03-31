<?php
#Connect to the database
include('db_conn/db_conn.php');

session_start();


if(isSet($_POST['cmdEnter']))
{

$txtLawFirm = strtoupper(mysqli_real_escape_string($db,$_POST['city2']));
$cityLat = strtoupper(mysqli_real_escape_string($db,$_POST['cityLat']));
$cityLng = strtoupper(mysqli_real_escape_string($db,$_POST['cityLng']));
$txtLawer = strtoupper(mysqli_real_escape_string($db,$_POST['txtLawer']));
$mnuCounty = strtoupper(mysqli_real_escape_string($db,$_POST['mnuCounty']));
$txtTown = strtoupper(mysqli_real_escape_string($db,$_POST['txtTown']));
$txtStreet = strtoupper(mysqli_real_escape_string($db,$_POST['txtStreet']));
$txtBuilding = strtoupper(mysqli_real_escape_string($db,$_POST['txtBuilding']));
$txtWing_Suite = strtoupper(mysqli_real_escape_string($db,$_POST['txtWing_Suite']));
$txtEMail = strtolower(mysqli_real_escape_string($db,$_POST['txtEMail']));
$txtPhoneNumber = mysqli_real_escape_string($db,$_POST['txtPhoneNumber']);
$txtPassword = mysqli_real_escape_string($db,$_POST['txtPassword']);

$ip = mysqli_real_escape_string($db,$_SERVER['REMOTE_ADDR']);



mysqli_query($db,"insert into users(law_firm, latitude, longitude, lawer_name, county, town, street, building, wing_suite, e_mail, phone_number, password, ip) values ('$txtLawFirm','$cityLat','$cityLng','$txtLawer','$mnuCounty','$txtTown','$txtStreet','$txtBuilding','$txtWing_Suite','$txtEMail','$txtPhoneNumber','$txtPassword','$ip')");

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="icon" href="images/medbook.png"/>
<title>MedBook MIS</title>

<meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=no, maximum-scale=1, height=device-height" />

<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css">

<style type="text/css">
body,td,th {
  color: #000000;
}

#header
{
  position:fixed;
  left:0px;
  right:0px;
  top:0px;
}

#footer
{
  background-color:F3F3F3;
  position:fixed;
  height:80px;
  bottom:0px;
  left:0px;
  right:0px;
  margin-bottom:0px;
}
</style>

<style type="text/css">
body,td,th {
  color: #000000;
}
a:link {
  color: #0000FF;
}
a:visited {
  color: #00F;
}
a:hover {
  color: #FF00FF;
}
a:active {
  color: #0FF;
}
.borderdesigner
{
	margin-top: 10px;
	border: 1px solid transparent;
	border-radius: 9px;
	box-sizing: border-box;
	-moz-box-sizing: border-box;
	height: 32px;
	outline: none;
	box-shadow: 0 6px 30px rgba(0, 0, 0, 0.9);
}
</style>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function () {
  //Disable cut copy paste
  $('body').bind('cut copy paste', function (e) {
    e.preventDefault();
  });
  
  //Disable mouse right click
  $("body").on("contextmenu",function(e){
    return false;
  });
});
</script>


<script>
$(document).ready(function(){
                      
//check phone number if used before               
                
$('#txtPhoneNumber').change(function(){
  
  var txtPhoneNumber = $("#txtPhoneNumber").val();
  
  var dataString = 'txtPhoneNumber='+txtPhoneNumber;
            
  if(txtPhoneNumber.length == 12)
  {       
    $.ajax({
    type: "POST",
    url: "data_phone_number_check.php",
    data: dataString,
    cache: true,
    beforeSend: function()
    {
      document.getElementById('divPhoneNumberLoader').hidden = false;
    },
    success: function(data)
    {
      if(data == 'true')
      {
        document.getElementById('divPhoneNumberLoader').hidden = false;
        document.getElementById('divPhoneNumberLoader').innerHTML = "<b><font color='red'>this phone number has already been used to register</font></b>";
        document.getElementById('cmdEnter').disabled = true;      
      }
      else if(data == 'false')
      {
        document.getElementById('divPhoneNumberLoader').hidden = true;
        document.getElementById('cmdEnter').disabled = false;
      }
  }
  })
  }
})


//////////////////////////////////////////////////////////////////////////////
//check email if used before

$('#txtEMail').change(function(){
  
  var txtEMail = $("#txtEMail").val();
  
  var dataString = 'txtEMail='+txtEMail;
                  
    $.ajax({
    type: "POST",
    url: "data_phone_number_check.php",
    data: dataString,
    cache: true,
    beforeSend: function()
    {
      document.getElementById('divEMailLoader').hidden = false;
    },
    success: function(data)
    {
      if(data == 'true')
      {
        document.getElementById('divEMailLoader').hidden = false;
        document.getElementById('divEMailLoader').innerHTML = "<b><font color='red'>this email has already been used to register</font></b>";
        document.getElementById('cmdEnter').disabled = true;
      }
      else if(data == 'false')
      {
        document.getElementById('divEMailLoader').hidden = true;
        document.getElementById('cmdEnter').disabled = false;
      }
    }
  })
})

//////////////////////////////////////////////////////////////////////////
    
})
</script>


<script type="text/javascript">
$(function() {
$("#txtPhoneNumber").change(function() {
var txtPhoneNumber = $("#txtPhoneNumber").val();

if(txtPhoneNumber.length != 12)
{
  document.getElementById("txtPhoneNumber").value = "254";
}


})
})
</script>


<!-- geolocation auto complete -->


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu3_60CcfCAzSJTZg_HP6yZjaQ27Hnypg&libraries=places"></script>
<script>
function initialize()
{
	var options = {
	types: ['establishment'],
	componentRestrictions: {country: "ke"}
}

	var input = document.getElementById('txtLawFirm');
	var autocomplete = new google.maps.places.Autocomplete(input, options);


///////////////////////////////////////////////////////////////////////////////////////////////////////////

            google.maps.event.addListener(autocomplete, 'place_changed', function () 
			{
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
		
google.maps.event.addDomListener(window, 'load', initialize);

</script>

<body>
<div align="left" style="background-image:url(../images/header.jpg);background-repeat:no-repeat;background-size:cover;" id="header">
  <table width="100%" style="border:none" border="0">
      <tr>
        <td width="41%"><img src="images/medbook.png" width="50%" /></td>
            <td align="right">
           
              <br />
            </td>
      </tr>
  </table>
</div>

<p>&nbsp;</p>


<form class="login-form" name="fomRegistration" id="fomRegistration" action="" method="POST" autocomplete="off">

<p>&nbsp;</p>
<p>&nbsp;</p>



<p align="right" style="font-weight:bold;font-size:12px;z-index:1;">
	<b>
		<u>
    		<a href="index.html" style="color:#000000;">Client Login</a>&nbsp;||&nbsp;<a href="">Forgot Password</a>&nbsp;
		</u>
	</b>
</p>
  

  
<h4 align="center"><u>User Registration.</u></h4>

<br />

<table border="0" align="center" class="borderdesigner">
    <tr>
      <td style="font-weight:bold;" width="40%" align="right">Name: &nbsp;</td>
      <td align="center">
        <br />
        <input id="txtLawer" name="txtLawer" placeholder="user name" type="text" style="color:#000000;" autocomplete="off" class="span4" />
      </td>
      <td width="10%" align="center">&nbsp;</td>
    </tr>
  <tr>
    <td style="font-weight:bold;" width="40%" align="right"><font color="#FF0000" size="+2">*</font>County: &nbsp;</td>
    <td align="center">
      <br />
      <span id="spryselect1">
      <select style="color:#000000;" class="span4" name="mnuCounty" id="mnuCounty">
        <option value="" selected="selected">Select the firm's location (county)</option>
        <option value="NAIROBI">NAIROBI</option>
        <option value="KIAMBU">KIAMBU</option>
        <option value="MACHAKOS">MACHAKOS</option>
        <option value="NAKURU">NAKURU</option>
        <option value="KERICHO">KERICHO</option>
        <option value="KIRINYAGA">KIRINYAGA</option>
        <option value="NYERI">NYERI</option>
        <option value="UASIN-GISHU">UASIN-GISHU</option>
        <option value="KISUMU">KISUMU</option>
        <option value="MOMBASA">MOMBASA</option>
        </select>
        
        <br />
        
      <span class="selectInvalidMsg">Please select a valid firm location (county).</span>
        <span class="selectRequiredMsg">Please select your firms location (county).</span>
        </span>
    </td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-weight:bold;" align="right">User Email: &nbsp;</td>
    <td align="center">
      <br />
      <span id="sprytextfield3">
        <input id="txtEMail" name="txtEMail" placeholder="Key in the firm's contact information (Email)" type="email" style="color:#000000;" autocomplete="off" class="span4" />
        <br />
        <div id="divEMailLoader" hidden="hidden"><img src="../images/material_spinner.gif" width="20">checking.....</div>
        <span class="textfieldInvalidFormatMsg">Invalid Email format.</span>
        </span>    
      </td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-weight:bold;" align="right"><font color="#FF0000" size="+2">*</font>Phone Number:<br /><font size="-2">please start with (254)</font> &nbsp;</td>
    <td align="center">
      <br />
      <span id="sprytextfield4">
      <input id="txtPhoneNumber" name="txtPhoneNumber" placeholder="Contact phone number starting with 254" type="number" style="color:#000000;" autocomplete="off" class="span4" onclick="document.getElementById('txtPhoneNumber').value = '254';" />
      <br />
      <div id="divPhoneNumberLoader" hidden="hidden"><img src="../images/material_spinner.gif" width="20">checking.....</div>
      <span class="textfieldRequiredMsg">Please enter a valid mobile phone number.</span>
      <span class="textfieldMinCharsMsg">Minimum number of characters not met.</span>
      <span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span>
      </span>
    </td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-weight:bold;" align="right"><font color="#FF0000" size="+2">*</font>Password: &nbsp;</td>
    <td align="center">
      <br />
      <span id="sprytextfield5">
      <input id="txtPassword" name="txtPassword" placeholder="Key in the desired login Password" type="text" style="color:#000000;" autocomplete="off" class="span4" />
      <br />
      <span class="textfieldRequiredMsg">A password is required.</span></span></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center">
    <br />
<input type="submit" name="cmdEnter" id="cmdEnter" value="Submit" style="width:100px;height:50px;" class="btn-success search-query" onClick="document.getElementById('cmdEnter').value = 'Submitting…';" />
    </td>
  </tr>
</table>

</form>

<script type="text/javascript">
  var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur", "change"], invalidValue:"-1"});
  var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email", {validateOn:["blur", "change"], isRequired:false});
  var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur", "change"], minChars:12, maxChars:12});
  var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur", "change"]});
</script>
</body>

</html>

