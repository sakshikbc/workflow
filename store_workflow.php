<?php
require_once('app/config.php');
if(isset($_POST['type']))
{
    $workflow_type = $_POST['type'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO workflow (user_id, name, description, status)
                    VALUES ('1','$name','$description', '1' )";

        if (mysqli_query($conn, $sql)) {
            $workflow_id = $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    switch ($workflow_type) {
        case 'message':
            # code...
            $from = $_POST['message_from'];
            $to = $_POST['message_to'];
            $date = $_POST['message_date'];
            $mode=$_POST['mode'];
            for($i=0;$i<count($from);$i++)
            {
                if($from[$i]!="" && $to[$i]!="" && $date[$i]!="" && $mode[$i]!="")
                {
                    $sql = "INSERT INTO events (workflow_id, workflow_type, event_from, event_to, event_date, event_mode, status)
                                VALUES ('$workflow_id', '$workflow_type','$from[$i]','$to[$i]', '$date[$i]', '$mode[$i]', '1' )";

                    if (mysqli_query($conn, $sql)) {
                        echo "New record created successfully";
                        header('Location: /');
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
            break;
        
        case 'call':
            # code...
            $from = $_POST['call_from'];
            $to = $_POST['call_to'];
            $date = $_POST['call_date'];
            $mode=$_POST['mode'];
            $duration=$_POST['call_duration'];
            for($i=0;$i<count($from);$i++)
            {
                if($from[$i]!="" && $to[$i]!="" && $date[$i]!="" && $mode[$i]!="")
                {
                    $sql = "INSERT INTO events (workflow_id, workflow_type, event_from, event_to, event_date, event_mode, duration, status)
                                VALUES ('$workflow_id', '$workflow_type','$from[$i]','$to[$i]', '$date[$i]', '$mode[$i]', '$duration[$i]', '1' )";

                    if (mysqli_query($conn, $sql)) {
                        echo "New record created successfully";
                        header('Location: /');
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }

            break;
        
        case 'appointment':
            # code...
            $email=$_POST['email'];
            $date=$_POST['appointment_date'];
            for($i=0;$i<count($email);$i++)
            {
                if($email[$i]!="" && $date[$i]!="")
                {
                    $sql = "INSERT INTO events (workflow_id, workflow_type, event_date, email, status)
                                VALUES ('$workflow_id', '$workflow_type', '$date[$i]', '$email[$i]', '1' )";

                    if (mysqli_query($conn, $sql)) {
                        echo "New record created successfully";
                        header('Location: /');

                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
            break;
        
        default:
            echo "Please Select the type";
            break;
    } 
} else {
    echo "Please select the Type";
}