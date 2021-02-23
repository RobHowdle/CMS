<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
    if(isset($_POST['submit'])) {
        $to = "support@rob.com";
        $subject = $_POST['subject'];
        $body = $_POST['message'];
    }
?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control"
                                    placeholder="Enter your subject">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Message</label>
                                <textarea class="form-control" id="message" rows="3"
                                    placeholder="Enter you message"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                value="Send">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php";?>