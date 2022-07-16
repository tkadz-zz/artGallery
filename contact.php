<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";
?>

    <div class="page-content">
        <div class="container">
            <div class="row pp-section">
                <div class="col-md-9">
                    <h1 class="h4">Contact Us</h1>
                    <p>Message us with any questions or inquiries. We would be happy to answer your question. </p>
                </div>
            </div>
            <div class="container pp-contact px-0 mt-5">
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="h4">Call or email</div>
                        <p>Support and Photo Management services are currently available.</p>

                        <p class="pt-5"><b>Support</b></p>
                        <p>+263 783 973 142</p>

                        <p>Contact Support</p>
                        <p>Our technical support is available by phone or email from 11am to 7pm Monday through Friday.</p>

                        <p>Contact Support</p>
                        <p>Our technical support is available by phone or email from 11am to 7pm Monday through Friday.</p>

                        <p class="pt-5"><b>General Inquiries</b></p>
                        <p>info@artgallery.com</p>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="pp-contact-message">
                            <div class="h4 mb-3">Drop a Message</div>
                            <form action="includes/contact_us_send.inc.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <input class="mr-3 form-control" type="text"
                                               <?php
                                               if(isset($_SESSION['name'])){
                                               ?>
                                                   value="<?php echo $_SESSION['name'] ?>"

                                               <?php
                                               }
                                               ?>
                                               name="first_name" placeholder="*First Name" required/>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <input class="form-control" type="text"
                                            <?php
                                            if(isset($_SESSION['surname'])){
                                            ?>
                                               value="<?php echo $_SESSION['surname'] ?>"

                                               <?php
                                               }
                                               ?>
                                               name="last_name" placeholder="*Last Name" required/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input class="form-control" type="text" name="subject" placeholder="*Subject" required/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input class="form-control" type="email"
                                            <?php
                                            if(isset($_SESSION['email'])){
                                            ?>
                                               value="<?php echo $_SESSION['email'] ?>"
                                               <?php
                                               }
                                               ?>
                                               name="replyto" placeholder="*E-mail" required/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <textarea class="form-control" name="message" placeholder="*Your Message" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-primary" name="btn-contact-us" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pp-section"></div></div>
    </div>
<?php
include 'includes/footer.inc.php';
?>