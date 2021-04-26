<?php
require_once('app/config.php');

$sql = "SELECT * FROM workflow";
$result = mysqli_query($conn, $sql);

$events = "SELECT * FROM events  WHERE status = '1' ORDER BY  event_date DESC";
$event_result = mysqli_query($conn, $events);

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <link href="app/style.css" rel="stylesheet">
        <title>WorkFlow Automation</title>
    </head>
    <body>
        <div class="container mt-20" >
            <div class="card">
                <div class="card-body">
                    <div class="sameline" style="margin-bottom: 5em;">
                        <h2 style="float:left">WorkFlow Automation</h2>
                        <button type="button" class="btn btn-success" style="float:right" id="show">New WorkFlow</button>
                    </div>
                    
                    <div id="new-workflow" style="margin-bottom: 5em;">
                        <form id="regForm" method="POST" action="/store_workflow.php">
                            <h1>New WorkFlow:</h1>
                            <!-- One "tab" for each step in the form: -->
                            <div class="tab">WorkFlow Name:
                                <p><input type="text" placeholder="Name..." name="name" autofocus required></p>
                                
                                <p><input type="text" placeholder="Description..."  name="description" required></p>
                            </div>
                            <div class="tab">Choose your Trigger<br><br>
                                <div class="row">
                                    <div class="col form-check">
                                        Message<input class="form-check-input" type="radio" name="type" value="message" id="message" required> 
                                        
                                    </div>
                                    <div class="col form-check">
                                    Call<input class="form-check-input" type="radio" name="type" value="call" id="call" required>
                                        
                                    </div>
                                    <div class="col form-check">
                                    Appointment<input class="form-check-input" type="radio" name="type" value="appointment" id="appointment" required>
                                        
                                    </div>
                                </div>
                                <div class="form-group message_form"  style="margin-top: 20px;">
                                    <!-- <div class="row" id="dynamic_message_form[]" style="margin-top: 20px;">
                                        <div class="col"><input type="number" class="form-control" name="message_from[]" id="message_from" placeholder="From"/></div>
                                        <div class="col"><input type="number" class="form-control" name="message_to[]" id="message_to" placeholder="To"/></div>
                                        <div class="col"><input type="date" class="form-control" name="message_date[]" id="message_date" placeholder="Date" /></div>
                                        <div class="col">
                                            <select name="mode[]" class="form-control">
                                                <option value="sent">Sent</option>    
                                                <option value="recieved">Recieved</option>    
                                            </select>
                                        </div>
                                        <div class="col button-group">
                                            <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                        </div>
                                    </div> -->
                                    <div id="newRow"></div>
                                    <button id="addRow" type="button" class="btn btn-info" style="margin-top: 20px;">Add Row</button>
                                    
                                </div>

                                <div class="form-group call_form"style="margin-top: 20px;">
                                    <!-- <div class="row"  id="dynamic_call_form" style="margin-top: 20px;" >
                                        <div class="col"><input type="number" class="form-control" name="call_from[]" id="call_from" placeholder="From"/></div>
                                        <div class="col"><input type="number" class="form-control" name="call_to[]" id="call_to" placeholder="To"/></div>
                                        <div class="col"><input type="date" class="form-control" name="call_date[]" id="call_date" placeholder="Date" /></div>
                                        <div class="col">
                                            <select name="mode[]" class="form-control">
                                                <option value="made">Made</option>    
                                                <option value="recieved">Recieved</option>    
                                            </select>
                                        </div>
                                        <div class="col"><input type="time" class="form-control" name="call_duration[]" id="call_duration" placeholder="Call Duration" /></div>
                                        <div class="col button-group">
                                            <button id="removeRow1" type="button" class="btn btn-danger">Remove</button>
                                        </div>
                                    </div> -->
                                    <div id="newRow1"></div>
                                    <button id="addRow1" type="button" class="btn btn-info" style="margin-top: 20px;">Add Row</button>
                                </div>

                                <div class="form-group appointment_form" style="margin-top: 20px;">
                                    <!-- <div class="row"  id="dynamic_appointment_form" style="margin-top: 20px;">
                                        <div class="col"><input type="date" class="form-control" name="appointment_date[]" id="appointment_date" placeholder="Appointment Date" /></div>
                                        <div class="col"><input type="email" class="form-control" name="email[]" id="email" placeholder="Email" /></div>
                                        <div class="col button-group">
                                            <button id="removeRow2" type="button" class="btn btn-danger">Remove</button>
                                        </div>
                                    </div> -->
                                    <div id="newRow2"></div>
                                    <button id="addRow2" type="button" class="btn btn-info" style="margin-top: 20px;">Add Row</button>
                                </div>

                            </div>
                            <div style="overflow:auto;">
                                <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)" value="submit">Next</button>
                                </div>
                            </div>
                            <!-- Circles which indicates the steps of the form: -->
                            <div style="text-align:center;margin-top:40px;">
                                <span class="step"></span>
                                <span class="step"></span>
                            </div>
                        </form>
                    </div>


                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Upcoming Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Your WorkFlows</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <?php 
                            if (mysqli_num_rows($event_result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($event_result)) { ?>
                                    <div class="card" style="margin-top: 20px;">
                                        <div class="card-header">
                                            Trigger Type : <?php echo strtoupper($row['workflow_type']) ?>
                                        </div>
                                        <div class="card-body">
                                            <?php if($row['workflow_type'] == 'appointment') { ?>
                                                <h5 class="card-title"><span style="float:left"> Appointment Date : <?php echo $row['event_date'] ?> - Email : <?php echo $row['email'] ?></span></h5><br>
                                            <?php } else {  ?>
                                            <h5 class="card-title"><span style="float:left"> From : <?php echo $row['event_from'] ?> - To : <?php echo $row['event_to'] ?></span></h5><br>
                                            <p class="card-text" style="float: left;">Date :  <?= $row['event_date'] ?>. (<?= $row['event_mode'] ?>)<br>
                                            <?php if($row['workflow_type'] == 'call') { ?>Call Duration : <?= $row['duration'] ?>.<?php } ?></p> 
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php }
                                } else {
                                    echo "No WorkFlow !! Please Create One ";
                                }
                                ?>
                        
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <?php 
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="card" style="margin-top: 20px;">
                                        <div class="card-header">
                                            WorkFlow <?php echo $row['id'] ?>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['name'] ?></h5>
                                            <p class="card-text"><?= $row['description'] ?>.</p>
                                            <div class="custom-control custom-switch" style="float:right">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch<?php echo $row['id']; ?>" onclick="workflowSwitch(<?php echo $row['id']; ?>)" <?php if($row['status'] == 1)  { ?> checked <?php } ?>>
                                                <label class="custom-control-label" for="customSwitch<?php echo $row['id']; ?>"></label>
                                            </div>
                                            <!-- <a href="#" class="btn btn-primary">View </a> -->
                                        </div>
                                    </div>
                                <?php }
                                } else {
                                echo "No WorkFlow !! Create One ";
                                }
                                ?>
                            
                        </div>
                    </div>


                </div>
            </div>
            
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="app/main.js"></script>
        <script>
            var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab

            function showTab(n) {
            // This function will display the specified tab of the form...
                var x = document.getElementsByClassName("tab");
                x[n].style.display = "block";
                //... and fix the Previous/Next buttons:
                if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                }
                if (n == (x.length - 1)) {
                    document.getElementById("nextBtn").innerHTML = "Submit";
                } else {
                    document.getElementById("nextBtn").innerHTML = "Next";
                }
                //... and run a function that will display the correct step indicator:
                fixStepIndicator(n)
            }

            function nextPrev(n) {
                // This function will figure out which tab to display
                var x = document.getElementsByClassName("tab");
                // Exit the function if any field in the current tab is invalid:
                if (n == 1 && !validateForm()) return false;
                // Hide the current tab:
                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:
                currentTab = currentTab + n;
                // if you have reached the end of the form...
                if (currentTab >= x.length) {
                    // ... the form gets submitted:
                    document.getElementById("regForm").submit();
                    return false;
                }
                // Otherwise, display the correct tab:
                showTab(currentTab);
            }

            function validateForm() {
                // This function deals with validation of the form fields
                var x, y, i, valid = true;
                x = document.getElementsByClassName("tab");
                y = x[currentTab].getElementsByTagName("input");
                // A loop that checks every input field in the current tab:
                for (i = 0; i < y.length; i++) {
                    // If a field is empty...
                    if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                    }
                }
                // If the valid status is true, mark the step as finished and valid:
                if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                }
                return valid; // return the valid status
            }

            function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
                var i, x = document.getElementsByClassName("step");
                for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                }
                //... and adds the "active" class on the current step:
                x[n].className += " active";
            }

            function workflowSwitch(id) {
                $.ajax({
                    method:"POST",
                    url: "update-status.php",
                    data:{
                        id:id,
                    },
                    success: function(data) {
                        $('#table-container').load('show-data.php');
                        $('#msg').html(data);
                    }
                });
            }
        </script>


    </body>
</html>