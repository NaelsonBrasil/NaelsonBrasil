<?php

if (isset($_POST['email']) and !empty($_POST['email']) and isset($_POST['option']) and !empty($_POST['option']) and isset($_POST['message']) and !empty($_POST['message'])) {

    $headers = 'MIME-Version: 1.1' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $subject = $_POST['option'];
	$message .= "<h1>".$_POST['email']."</h1>";
    $message .= "<small>".$_POST['message']."</small>";
	
    if (mail(EMAIL_CONTACT, $subject, $message, $headers) === true) {
        echo'<div class="alert alert-success" role="alert">Send whti success!</div>';
    }
}
?>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body  bg-dark">
            <h4 class="card-title text-light">Contact us</h4>
            <p class="card-description text-warning">
                Answered in even 48 hours!
            </p>
            <form class="forms-sample" action="" method="post">
                <div class="form-group text-light">
                    <label for="exampleInputEmail3">Email Contact</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                </div>
                <div class="form-group text-light">
                    <label for="exampleFormControlSelect2">Option</label>
                    <select class="form-control" name="option" id="exampleFormControlSelect2">
                        <option>PAYMENT</option>
                        <option>WEBSITE BUGS?</option>
                        <option>OTHERS</option>
                    </select>
                </div>
                <div class="form-group text-light">
                    <label for="exampleTextarea1">Message</label>
                    <textarea class="form-control" name="message" id="exampleTextarea1" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>