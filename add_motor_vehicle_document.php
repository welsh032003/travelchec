<?php include 'emp_login_session.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
     <title>Travelchec Dashboard</title>
     <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-form.css">
    <link rel="stylesheet" href="css/daterangepicker.min.css">
    <style type="text/css">
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  height: 1000px;
}
#tab-head {
    font-weight: bold;
    font-size: 20px;
}
#tab-item {
    font-weight: bold;
}
.form-row {
  display: flex;
}

/* Create two equal columns that sits next to each other */
.form-column {
  flex: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}


</style>

 </head>   
<body>
    
    <input type="checkbox" id="check">


<!--header area start-->    
<header>
    <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
        <h3>Travel<span>Chec</span></h3>
    </div>
    <div class="right_area">
  <?php
     if (isset($_SESSION['user']['role'])) { ?>
        <a href="logout.php" class="logout_btn">Logout</a>
     <?php } else { ?>
     
     <?php }
  ?>
    </div>
</header>
<!--header area end-->


<!--Sidebar included-->   
<?php include 'sidebar_emp.php'; ?>
<?php
$login_emp = $_SESSION['employee']['id'];
$select_doc = mysqli_query($conn, "SELECT mv.status, mv.id as mvid, mv.model, md.id, md.name as modl, my.id, mv.year, my.year as yea, m.id, m.name, mv.emp_id, mv.EngineNo, e.id, e.first_name, e.last_name, e.address1, e.address2, mv.make, mv.model, mv.year, mv.ChassisNo
  FROM motor_vehicle mv
  JOIN employee_details e on mv.emp_id = e.id
  JOIN makes m on mv.make = m.id
  JOIN make_years my on mv.year = my.id
  JOIN models md on mv.model = md.id 
  WHERE mv.emp_id = '$login_emp'");
$erow = mysqli_fetch_assoc($select_doc);

?>


<!--Main content area started--> 
<div class="content">
  <div class="content-body"><br><br>
<h2>Motor Vehicle Documents</h2>
<p>Click on the buttons inside the tabbed menu:</p>

<div class="tab">
  <button class="tablinks"  onclick="openCity(event, 'Information')" id="defaultOpen">Information</button>
  <button class="tablinks" onclick="openCity(event, 'Licence')">Drivers Licence</button>
  <button class="tablinks" onclick="openCity(event, 'Registration')">Registration Certificate</button>
  <button class="tablinks" onclick="openCity(event, 'Fitness')">Certificate of Fitness</button>
  <button class="tablinks" onclick="openCity(event, 'Insurance')">Certificate of Insurance</button>
</div>

<div id="Information" class="tabcontent">
  <h3>Motor Vehicle Information</h3>
    <p><span id="tab-item" >Name:</span> <?php echo $erow['first_name']; ?> <?php echo $erow['last_name']; ?></p>
    <p><span id="tab-item" >Make:</span> <?php echo $erow['name']; ?></p>
    <p><span id="tab-item" >Year:</span>  <?php echo $erow['yea']; ?></p>
    <p><span id="tab-item" >Model:</span>  <?php echo $erow['modl']; ?></p>
    <p><span id="tab-item" >Engine #:</span>  <?php echo $erow['EngineNo']; ?></p>
    <p><span id="tab-item" >Chassis #:</span>  <?php echo $erow['ChassisNo']; ?></p>
</div>

<div id="Licence" class="tabcontent">
  <h3>Drivers Licence Information</h3>

<div class="form-row">

<div class="form-column">

    <div class="col-25">
        <label>Name:</label>
    </div>
    <div class="col-75">
      <div style="display: inline-flex;">
        <input style="width:200px; text-transform: uppercase;" type="text" value="<?php echo $erow['first_name']; ?>" disabled>
        <input style="width:200px; text-transform: uppercase;" type="text" value="<?php echo $erow['last_name']; ?>" disabled>
      </div>
    </div>

    <div class="col-25">
        <label>Gender:</label>
    </div>
    <div class="col-75">
        <select style='width:400px;'>
            <option>Select Gender</option>
            <option>Male</option>
            <option>Female</option>
        </select>
    </div>

    <div class="col-25">
        <label>TRN:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Class:</label>
    </div>
    <div class="col-75">
        <select style='width:400px;'>
            <option>Select Class</option>
            <option>General</option>
            <option>Private</option>
        </select>
    </div>

    <div class="col-25">
        <label>Issue Date:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="date" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Expire Date:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="date" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Address 1:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="date" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Address 2:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="date" name="engineno" required>
    </div>


    <div class="col-25">
        <input class="btn btn-primary" type="submit" value="Save Drivers Licence" name="submit">
    </div>

</div>


  <div class="form-column">
     <input id="img-file" type="file" name="image" >
    <div class="agent-avatar-box">
      <img id="preview" style="height: 450px; width: 500px;" src="img/placeholder.jpg" alt="" class="agent-avatar img-fluid">
    </div>
  </div>

 </div>
    
</div>



<div id="Registration" class="tabcontent">
  <h3>Motor Vehicle Registration</h3>
 <div class="form-row">

<div class="form-column">

    <div class="col-25">
        <label>Owner Name:</label>
    </div>
    <div class="col-75">
      <div style="display: inline-flex;">
        <input style="width:200px; text-transform: uppercase;" type="text" value="<?php echo $erow['first_name']; ?>" disabled>
        <input style="width:200px; text-transform: uppercase;" type="text" value="<?php echo $erow['last_name']; ?>" disabled>
      </div>
    </div>

    <div class="col-25">
        <label>Address 1:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="<?php echo $erow['address1']; ?>" disabled>
    </div>

    <div class="col-25">
        <label>Address 2:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="<?php echo $erow['address2']; ?>" disabled>
    </div>

    <div class="col-25">
        <label>Motor Vehicle :</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  value="<?php echo $erow['yea']; ?> - <?php echo $erow['name']; ?> - <?php echo $erow['modl']; ?>" type="text" name="engineno" disabled>
    </div>

    <div class="col-25">
        <label>Engine #:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="<?php echo $erow['EngineNo']; ?>" disabled>
    </div>

    <div class="col-25">
        <label>Chassie #:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="<?php echo $erow['ChassisNo']; ?>" disabled>
    </div>



    <div class="col-25">
        <label>Issue Date:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="date" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Expire Date:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="date" name="engineno" required>
    </div>

    <div class="col-25">
        <label>CC Rating:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>


    <div class="col-25">
        <label>Color:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Fuel:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

        <div class="col-25">
        <label>Fee Paid:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Laden Weight:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Issues Officer:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>


    <div class="col-25">
        <input class="btn btn-primary" type="submit" value="Save Registration document" name="submit">
    </div>

</div>


  <div class="form-column">
     <input id="img-file" type="file" name="image" >
    <div class="agent-avatar-box">
      <img id="preview" style="height: 450px; width: 500px;" src="img/placeholder.jpg" alt="" class="agent-avatar img-fluid">
    </div>
  </div>

 </div>
</div>

<div id="Fitness" class="tabcontent">
  <h3>Certificate of Fitness</h3>
   <div class="form-row">

<div class="form-column">


    <div class="col-25">
        <label>Plate No:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="" >
    </div>

    <div class="col-25">
        <label>Issue Date:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="date" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Expire Date:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="date" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Motor Vehicle :</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  value="<?php echo $erow['yea']; ?> - <?php echo $erow['name']; ?> - <?php echo $erow['modl']; ?>" type="text" name="engineno" disabled>
    </div>

    <div class="col-25">
        <label>Engine #:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="<?php echo $erow['EngineNo']; ?>" disabled>
    </div>

    <div class="col-25">
        <label>Chassie #:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="<?php echo $erow['ChassisNo']; ?>" disabled>
    </div>





    <div class="col-25">
        <label>CC Rating:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>


    <div class="col-25">
        <label>Color:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Fuel:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

        <div class="col-25">
        <label>Fee Paid:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Laden Weight:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Issues Officer:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>


    <div class="col-25">
        <input class="btn btn-primary" type="submit" value="Save Fitness Certificate" name="submit">
    </div>

</div>


  <div class="form-column">
     <input id="img-file" type="file" name="image" >
    <div class="agent-avatar-box">
      <img id="preview" style="height: 450px; width: 500px;" src="img/placeholder.jpg" alt="" class="agent-avatar img-fluid">
    </div>
  </div>

 </div>
</div>

<div id="Insurance" class="tabcontent">
  <h3>Certificate of Insurance </h3>
   <div class="form-row">

<div class="form-column">

    <div class="col-25">
        <label>Owner Name:</label>
    </div>
    <div class="col-75">
      <div style="display: inline-flex;">
        <input style="width:200px; text-transform: uppercase;" type="text" value="<?php echo $erow['first_name']; ?>" disabled>
        <input style="width:200px; text-transform: uppercase;" type="text" value="<?php echo $erow['last_name']; ?>" disabled>
      </div>
    </div>

    <div class="col-25">
        <label>Address 1:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="<?php echo $erow['address1']; ?>" disabled>
    </div>

    <div class="col-25">
        <label>Address 2:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="<?php echo $erow['address2']; ?>" disabled>
    </div>

    <div class="col-25">
        <label>Motor Vehicle :</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  value="<?php echo $erow['yea']; ?> - <?php echo $erow['name']; ?> - <?php echo $erow['modl']; ?>" type="text" name="engineno" disabled>
    </div>

    <div class="col-25">
        <label>Engine #:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="<?php echo $erow['EngineNo']; ?>" disabled>
    </div>

    <div class="col-25">
        <label>Chassie #:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  type="text" value="<?php echo $erow['ChassisNo']; ?>" disabled>
    </div>



    <div class="col-25">
        <label>Issue Date:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="date" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Expire Date:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="date" name="engineno" required>
    </div>

    <div class="col-25">
        <label>CC Rating:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>


    <div class="col-25">
        <label>Color:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Fuel:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

        <div class="col-25">
        <label>Fee Paid:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Laden Weight:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>

    <div class="col-25">
        <label>Issues Officer:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>


    <div class="col-25">
        <input class="btn btn-primary" type="submit" value="Save Insurance Certificate" name="submit">
    </div>

</div>


  <div class="form-column">
     <input id="img-file" type="file" name="image" >
    <div class="agent-avatar-box">
      <img id="preview" style="height: 450px; width: 500px;" src="img/placeholder.jpg" alt="" class="agent-avatar img-fluid">
    </div>
  </div>

 </div>
</div>






















  </div>
</div>
<!--Main content area end--> 
  <script src="js/jquery/jquery.min.js"></script>
  <script src="js/jquery/jquery-migrate.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/jquery.daterangepicker.min.js"></script>
  
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>

<script>
$(document).ready(function(){
$('#phone-number', '#example-form')

    .keydown(function (e) {
        var key = e.charCode || e.keyCode || 0;
        $phone = $(this);

        // Auto-format- do not expose the mask as the user begins to type
        if (key !== 8 && key !== 9) {
            if ($phone.val().length === 4) {
                $phone.val($phone.val() + ')');
            }
            if ($phone.val().length === 5) {
                $phone.val($phone.val() + ' ');
            }           
            if ($phone.val().length === 9) {
                $phone.val($phone.val() + '-');
            }
        }

        // Allow numeric (and tab, backspace, delete) keys only
        return (key == 8 || 
                key == 9 ||
                key == 46 ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105)); 
    })
    
    .bind('focus click', function () {
        $phone = $(this);
        
        if ($phone.val().length === 0) {
            $phone.val('(');
        }
        else {
            var val = $phone.val();
            $phone.val('').val(val); // Ensure cursor remains at the end
        }
    })
    
    .blur(function () {
        $phone = $(this);
        
        if ($phone.val() === '(') {
            $phone.val('');
        }
    });
    });
</script>
  <script type="text/javascript">
     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#img-file").change(function(){
        readURL(this);
    });
  </script>


</body>
</html>
     
     
