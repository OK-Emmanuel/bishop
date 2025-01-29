 <?php include 'includes/db.php';?>
 <?php include 'includes/header.php'?>
 <?php include 'includes/functions.php'?>
 <?php if (isset($_POST['submit']) ) {
    
     
     // Send mail to us and to the client
     $mailto = "" ;//our email
     $name = Sanitizer($_POST['message_name']); //client name
     $phone = Sanitizer($_POST['message_phone']); //client phone
     $email = Sanitizer($_POST['message_email']); //client mail
     $subject = Sanitizer($_POST['message']); //client msg to us
     $subject2 = "Your message has been submitted successfully | Bishop Oyedola"; // our subject to client 
     $message = "$name wrote the following message". "\n\n" . $subject; //feed us with this message
     $message2 = "Dear ". $name . "\n\n" ."Thank you for contacting us! we will get back to you shortly"; //our message to client
     $header = "From: ". $email;
     $header2 = "From: " . $mailto;  // send our email to client
     $result = mail($mailto, $subject, $message, $header);//send to us
     $result2 = mail($email, $subject2, $message2, $header2);//send to client


     $sql = "INSERT INTO contact (contact_name, contact_email, contact_phone, contact_message)
     VALUES('$name', '$email', '$phone', '$subject')";
     $query = mysqli_query($connection, $sql);
     if ($query || $result || $result2 ) {
         echo "<script>window.alert('Your message has been successfully received')</script>";
         echo "<script>window.location('contact.php') </script>";
     }else{
        echo  "<script>window.alert('Something went wrong. Please try again later')</script>";
     }

 } ?>
    <!-- contact -->
    <section class="contact-wthree align-w3" id="contact">
        <div class="container">
            <div class="wthree_pvt_title text-center">
                <h4 class="w3pvt-title">contact me
                </h4>
                <span class="sub-title">You can get in touch with me via these platforms</span>
            </div>

            <div class="mx-auto text-center">
                <div class="row">
                    <div class="col-lg-4 contact-w3">
                        <span class="fa fa-envelope-open mr-2 my-3"></span>
                        <div class="d-flex flex-column">
                            <a href="mailto:example@email.com" class="d-block">message@bishopoyedola.org</a>
                        </div>
                    </div>
                    <div class="col-lg-4 contact-w3 my-lg-0 my-4">
                        <span class="fa fa-phone mr-2 my-3"></span>
                        <div class="d-flex flex-column">
                            <a href="tel: +"><p>+456 123 7890</p></a>
                        </div>
                    </div>
                    <div class="col-lg-4 contact-w3">
                        <span class="fa fa-home mr-2 my-3"></span>
                        <address>2016, Minesotta Columbus AV, United Kingdom</address>
                    </div>
                </div>
                <!-- //footer right -->
            </div>


            <div class="row mt-4">
                <div class="col-lg-8 mx-auto">
                    <h5 class="cont-form">send me a message</h5>
                    <div class="contact-form-wthreelayouts">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="register-wthree">
                            <div class="form-group">
                                <label>
                                    Your Name
                                </label>
                                <input class="form-control" type="text" placeholder="Your Name" name="message_name" required="">
                            </div>
                            <div class="form-group">
                                <label>
                                    Mobile
                                </label>
                                <input class="form-control" type="number" placeholder="Your Phone Number" name="message_phone" required="">
                            </div>
                            <div class="form-group">
                                <label>
                                    Email
                                </label>
                                <input class="form-control" type="email" placeholder="example@email.com" name="message_email"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>
                                    Your message
                                </label>
                                <textarea placeholder="Type your message here" name="message" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn bg-dark text-white w-100 font-weight-bold text-uppercase">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2798902705!2d-74.25986790365911!3d40.697670067823786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1536917325197"
            allowfullscreen></iframe> -->
    </section>
    <!-- //contact -->
 <?php include('includes/footer.php')?>