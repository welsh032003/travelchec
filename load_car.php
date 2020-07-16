<?php 
// Include the database config file 
include_once 'inc/config.php'; 
 
if(!empty($_POST["make_id"])){ 
    // Fetch state data based on the specific country 
    $query = "SELECT * FROM make_years WHERE make_id = ".$_POST['make_id']." ORDER BY year ASC"; 
    $result = $db->query($query); 
     
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select Year</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['id'].'">'.$row['year'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Year not available</option>'; 
    } 
}elseif(!empty($_POST["state_id"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT * FROM models WHERE makeyear_id = ".$_POST['state_id']."  ORDER BY name ASC"; 
    $result = $db->query($query); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select Model</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Model not available</option>'; 
    } 
} 
?>