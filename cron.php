<?php


date_default_timezone_set("Asia/Kolkata");

require_once('app/config.php');

use PHPMailer\PHPMailer\PHPMailer;


// echo date("Y-m-d");
try {
    $mail = new PHPMailer; 
    $mail->isSMTP();                      // Set mailer to use SMTP 
    $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
    $mail->SMTPAuth = true;               // Enable SMTP authentication 
    $mail->Username = 'test@gmail.com';   // SMTP username 
    $mail->Password = '';   // SMTP password 
    $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
    $mail->Port = 587;                    // TCP port to connect to 
    
    // Sender info 
    $mail->setFrom('kriyakbc@gmail.com', 'Testing'); 
    $mail->addReplyTo('kriyakbc@gmail.com', 'Testing'); 

    $sql = "SELECT * FROM events WHERE workflow_type='appointment' AND status='1'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            if($row['event_date'] == date("Y-m-d")) {
                $workflow_sql = "SELECT * FROM workflow WHERE id='$row[workflow_id]' AND status='1'";
                $workflow_result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {

                    $mail->addAddress($row['email']);
                    // Set email format to HTML
                    $mail->isHTML(true);
                    // Mail subject
                    $mail->Subject = 'Appointment Scheduled';
                    // Mail body content
                    $bodyContent = '<h1>Appointment Scheduled</h1>';
                    $bodyContent .= '<p>This HTML email is sent from the localhost server using PHP by <b>Sakshi</b></p>';
                    $mail->Body    = $bodyContent;
                    
                    // Send email
                    if (!$mail->send()) {
                        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                    } else {
                        $sql = "UPDATE events SET status='2' WHERE id=$row[id]";
                        mysqli_query($conn, $sql);
                        echo 'Message has been sent.';
                    }
                }
            }        
        }
    } else {
        echo "0 results";
    }
    }catch(\Throwable $th){
    file_put_contents(__DIR__ . '/error.log', $th->getMessage() . PHP_EOL, 8);
}