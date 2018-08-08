<!DOCTYPE html>
<html>
    <head>
        <title>Challenge(Phonebook)</title>
<script>
function alltabs(evt, ctabs) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(ctabs).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            
            .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
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
}
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
             .inputalign {
  width: 500px;
  clear: both;
}

.inputalign input {
  width: 100%;
  clear: both;
}   
table { width:50% }

            
        </style>
    </head>
    <body>
        
      
<?php

$link = mysqli_connect("localhost", "root", "","phonebook");

// Check connection
if (mysqli_connect_errno()) {
    
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
        
      
      <h1> Phonebook </h1>
      
      <div class="tab">
  <button class="tablinks" onclick="alltabs(event, 'AddContact')">Add Contacts</button>
  <button class="tablinks" onclick="alltabs(event, 'View')">View Contacts</button>
  <button class="tablinks" onclick="alltabs(event, 'Edit')">Edit Contacts</button>
  <button class="tablinks" onclick="alltabs(event,'Search')">Search Contacts</button>
  <button class="tablinks" onclick="alltabs(event, 'Delete')">Delete Contacts</button>
</div>

<!-- Tab content -->
 <div id="AddContact" class="tabcontent">
 <center> <h3>Add Contact</h3><center>
 <center>
     <div inputalign>
         
      <form action="" method="post" enctype="multipart/form-data">
          Name </br>
<input type="text" name="name" id= "nameid" required><br>
    Phone Number </br>
 <input type="number" name="contact" id="contactid" required><br>
 E-mail </br>
<input type="email" width=100% name="email" id="emailid" required><br>
Address </br>
 <input type="text" name="address" id="addressid" ><br>
  Image <br>
<center> <input type="file" name="imageUpload" id="imageUpload"   accept="image/*" ></center>    

<input onclick="AddedAlert()" type="submit" name="submit">
</form>
<!--  -->


</script>
 <?php 
             if (isset($_POST["submit"])) {
         
                echo "<meta http-equiv='refresh' content='0'>";
           
                $name = $_POST['name'];   
                $contact = $_POST['contact'];
                 $email = $_POST['email'];
                $address = $_POST['address'];
                
               
               
               $image = addslashes($_FILES['imageUpload']['tmp_name']);
                    $image = file_get_contents($image);
                    $image = base64_encode($image);

                $sql = "INSERT INTO contacts (name,phone,email,address,image) VALUES ('$name','$contact','$email','$address','$image')";



                if (mysqli_query($link, $sql)) {

                    echo "Contact inserted successfully";

                    echo "<br>";
                } else {

                    echo "ERROR: COULD NOT ABLE TO EXECUTE $sql. " . mysqli_error($link);
                }




             }
            
            ?>














<script>
function AddedAlert() {
    alert("Contact Added!");
    window.location.reload();
}
</script>

</center>
</form> </div>

</p>
</div>

<div id="View" class="tabcontent">
  <h3>View Contacts</h3>
  <p>Contact list.</p> 
  
  <?php
   $sqlview = "Select name,phone,email,address,image FROM contacts";


                $resultcontacts = mysqli_query($link, $sqlview);

                if (mysqli_num_rows($resultcontacts) > 0) {
                    echo "<table><tr><th>Name    </th><th>Contact Number    </th><th>E-mail   </th><th>Address</th><th>Image </th>  </tr>";
                    while ($row = mysqli_fetch_assoc($resultcontacts)) {
$image = $row['image'];
                        echo "<tr> <td >" . $row["name"] . " </td> <td> " . $row["phone"] . "</td><td>" . $row["email"] . " </td><td>" . $row["address"] . " </td>"
                                . "<td> <img height='80' width='100'  src = 'data:image;base64," . $image . "' </tr>";
                        }
                    echo "</table>";
                     
                } else {
                    echo "RESULTS: 0";
                }
            

  ?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
</div>

<div id="Edit" class="tabcontent">
  <h3>Edit</h3>
  <p>Edit.</p>
</div>
<div id="Search" class="tabcontent">
  <h3>Search</h3>
  <p>Search</p>
</div>
      
      <div id="Delete" class="tabcontent">
  <h3>Delete</h3>
  <p>Delete.</p>
</div>
      
      
      
      
      
      
      
        <div class="container">
            <div class="content">
            
            </div>
        </div>
    </body>
    
    
    
    
    
</html>
