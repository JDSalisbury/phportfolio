<?php
    $message = 'This will not work unless an SMTP is set up';

    if(isset($_POST['submit'])){

        $to = "Where you want the email to be sent";
        $headers = "From: " . $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        if(!empty($headers) && !empty($subject) && !empty($body) ){

            $headers = mysqli_real_escape_string($connection, $headers);
            $subject = mysqli_real_escape_string($connection, $subject);
            $body = mysqli_real_escape_string($connection, $body);
    
            
            mail($to, $subject, $body, $headers);
    
            
            $message = "You are Registered";
        } 

    } else {

    }
?>


   
<section id="email">       
    <div class="form-wrap">
        <h1>Contact</h1>
        <form role="form" action="" method="POST" id="about-form" autocomplete="off">
            <H6><?php echo $message; ?></H6>
    
            <div class="form-group">
                <label for="email">YOUR EMAIL</label>
                <input required type="email" name="email" id="email" class="form-control" >
            </div>

            <div class="form-group">
                <label for="subject">SUBJECT</label>
                <input required type="text" name="subject" id="subject" class="form-control">
            </div>

            <div class="form-group">
                <label for="body">MESSAGE</label>
                <textarea required class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
            </div>
    
            <input type="submit" name="submit" id="btn-send" class="btn btn-primary" value="SEND">
        </form>
    </div>        
</section>
<hr>
