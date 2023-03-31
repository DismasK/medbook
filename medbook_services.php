<?php
	//error_reporting(0);
	include("db_conn/db_conn.php");
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


<link href="date_picker/jquery.datepick.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="date_picker/jquery.plugin.js"></script>
<script src="date_picker/jquery.datepick.js"></script>
<script>
$(function() {
	$('#popupDatepicker').datepick();
	$('#inlineDatepicker').datepick({onSelect: showDate});
});

function showDate(date) {
	alert('The date chosen is ' + date);
}
</script>

<!--Modals controls -->
<link rel="stylesheet" href="css/modal.css">

<script>
function units_modal()
{	
	var modal = document.getElementById('mdlUnits');
	modal.style.display = "block";
}
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

  
<h4 align="center"><u>Patient Register.</u></h4>

<table border="0" align="center" class="borderdesigner">
  <tr>
    <td>
    	<br />
    	<input id="txtLawer" name="txtLawer" placeholder="user name" type="text" style="color:#000000;" autocomplete="off" class="span3" />
    </td>
    <td>
    
    	<br />
      	<input type="text" id="popupDatepicker" placeholder="Date of Birth" class="span3" />
    </td>
    
    <td>
    <br />
      
      <select style="color:#000000;" class="span3" name="mnuGender" id="mnuGender">
        <option value="" selected="selected">Select the patients gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </td>
    
    <td>
    <br />
      
      <select style="color:#000000;" class="span3" name="mnuGender" id="mnuGender">
        <option value="" selected="selected">Type of service</option>
        <option value="Male">X-ray</option>
        <option value="Chemotherapy">Chemotherapy</option>
        <option value="Consultation">Consultation</option>
        <option value="Outpatient check up">Outpatient check up</option>
        <option value="Surgery">Surgery</option>
        <option value="CT scan">CT scan</option>
      </select>
    </td>
  </tr>
  
  <tr>
  <td align="center" colspan="4">
  <input type="submit" name="cmdEnter" id="cmdEnter" value="Submit" style="width:100px;height:50px;" class="btn-success search-query" onClick="document.getElementById('cmdEnter').value = 'Submitting…';" />
  </td>
  </tr>
</table>

<br />
</form>

<p>&nbsp;</p>

<h4 align="center"><u>Client Records</u></h4>


<?php

$sql_client_id = "SELECT * FROM tbl_service";
$rs_client_id = mysqli_query($db, $sql_client_id ) or die('Database Error: ' . mysqli_error());
$num_client_id = mysqli_num_rows( $rs_client_id );
while($row_client_id = mysqli_fetch_array( $rs_client_id ))
{
?>

<table border="1" align="center" class="table-striped table-hover" width="90%">
  <tr style="color:#FFFF;background-color:#000;font-weight:bold;">
    <td>Patient Name</td>
    <td>Date Of Birth</td>
    <td>Gender</td>
    <td>Service Done</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
        <?php
			$ind = $row_client_id['ind'];
			
			$sql_client_name = "SELECT * FROM tbl_patient WHERE ind = '$ind'";
			$rs_client_name = mysqli_query($db, $sql_client_name ) or die('Database Error: ' . mysqli_error());
			$num_client_name = mysqli_num_rows( $rs_client_name );
			while($row_client_name = mysqli_fetch_array( $rs_client_name ))
			{
				echo $row_client_name['first_name'] . " " . $row_client_name['middle_name'] . " " . $row_client_name['last_name']; 
			}
		?>   
    </td>
    <td>
    	<?php echo $row_client_id['date_time']; ?>
    </td>
    
    <td>
   		<?php
			$ind = $row_client_id['ind'];
			
			$sql_client_gender = "SELECT * FROM tbl_gender WHERE ind = '$ind'";
			$rs_client_gender = mysqli_query($db, $sql_client_gender ) or die('Database Error: ' . mysqli_error());
			$num_client_gender = mysqli_num_rows( $rs_client_gender );
			while($row_client_gender = mysqli_fetch_array( $rs_client_gender ))
			{
				echo $row_client_gender['gender']; 
			}
		?>
    </td>
    
    <td>
    	<?php
			$ind = $row_client_id['ind'];
			
			$sql_client_service = "SELECT * FROM tbl_service WHERE ind = '$ind'";
			$rs_client_service = mysqli_query($db, $sql_client_service ) or die('Database Error: ' . mysqli_error());
			$num_client_service = mysqli_num_rows( $rs_client_service );
			while($row_client_service = mysqli_fetch_array( $rs_client_service ))
			{
				echo $row_client_service['service_done']; 
			}
		?>
    </td>
    
    
    <td align="center">
    	<input type="button" name="cmdEdit" id="cmdEdit" value="Edit" class="btn-primary search-query" onClick="units_modal();"/>
    </td>
    
  </tr>
</table>

<?php
}
?>


<div id="mdlUnits" class="w3-modal">
<div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:50%;width: 20%;position: relative;margin: 10% auto;padding: 5px 20px 13px 20px;
border-radius: 10px;
background: #fff;">

<div class="w3-center">

<div id="divMemberDetails">

    
<h4 align="center"><u>Update Patient Data.</u></h4>

<table border="0" align="center" class="borderdesigner">
  <tr>
    <td>
    	<br />
    	<input id="txtLawer" name="txtLawer" placeholder="user name" type="text" style="color:#000000;" autocomplete="off" class="span3" />
    </td>
    </tr>
    
    <tr>
    <td>
    
    	<br />
      	<input type="text" id="popupDatepicker" placeholder="Date of Birth" class="span3" />
    </td>
    </tr>
    
    <tr>
    <td>
    <br />
      
      <select style="color:#000000;" class="span3" name="mnuGender" id="mnuGender">
        <option value="" selected="selected">Select the patients gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </td>
    
    <tr>
    <td>
    <br />
      
      <select style="color:#000000;" class="span3" name="mnuGender" id="mnuGender">
        <option value="" selected="selected">Type of service</option>
        <option value="Male">X-ray</option>
        <option value="Chemotherapy">Chemotherapy</option>
        <option value="Consultation">Consultation</option>
        <option value="Outpatient check up">Outpatient check up</option>
        <option value="Surgery">Surgery</option>
        <option value="CT scan">CT scan</option>
      </select>
    </td>
  </tr>
  
  <tr>
  <td align="center" colspan="4">
  <input type="submit" name="cmdEnter" id="cmdEnter" value="UPDATE" style="width:100px;height:50px;" class="btn-success search-query" />
  </td>
  </tr>
</table>
    
    
    
    
</div>
</div>
</div>
</div>


</div>
</div>


</body>

</html>