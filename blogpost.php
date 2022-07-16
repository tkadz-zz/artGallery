<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";
?>

    <div class="page-content">
        <div class="container">
            <div class="pp-section pp-container-readable">
                <div class="pp-post"><a class="h3" href="blog-post.html">You can do anything if you believe</a>
                    <div class="pp-post-meta mt-2">
                        <ul>
                            <li><i class="fa fa-calendar-check-o" aria-hidden="true"></i><span>November 04, 2017</span></li>
                            <li><i class="fa fa-tags" aria-hidden="true"></i><span><a href="#"><span>Branding</span></a>, <a href="#"><span>Design</span></a></span></li>
                            <li><i class="fa fa-comments" aria-hidden="true"></i><a href="#pp-comment">Comments</a></li>
                            <li><i class="fa fa-user-circle" aria-hidden="true"></i><a href="#">Admin</a></li>
                        </ul>
                    </div><img class="img-fluid mt-3" src="images/blog-4.jpg" alt="Blog Image"/>
                </div>
                <div class="pp-blog-details">
                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit molestie, non vel turpis urna erat cum      parturient hac penatibus, nibh fusce semper sociis feugiat tempus fames.</p>
                    <p>Duis sociosqu fermentum curae tellus vehicula class velit morbi facilisi neque aptent porta,       faucibus ultrices ridiculus proin gravida hac cras felis penatibus mus primis pulvinar ultricies,    auctor pharetra a cubilia nisi habitant dictumst iaculis vestibulum nibh fusce.</p>
                    <blockquote>Cras sapien nullam proin platea taciti lacinia curae ridiculus, hac aptent at mus           litora habitant facilisis, netus vestibulum vel mattis porttitor odio massa.</blockquote>
                    <p>Egestas tristique etiam pharetra magnis sapien proin curabitur netus consequat dui eros primis     aptent sed imperdiet leo fames, auctor ultrices lobortis accumsan nullam vivamus posuere lacus     sociis sodales vestibulum lacinia luctus in suspendisse.</p>
                    <div class="pp-tags">
                        <div class="h6">Tags</div><a class="badge badge-primary" href="#">Nature</a><a class="badge badge-primary" href="#">Photography</a><a class="badge badge-primary" href="#">Model</a><a class="badge badge-primary" href="#">Flower</a>
                    </div>
                    <div class="pp-comments" id="pp-comment">
                        <div class="h2">Comments</div>
                        <div class="media"><img class="img-fluid mr-3" src="images/face-5.jpg" alt="Image"/>
                            <div class="media-body">
                                <div class="h5 mt-0">Alena</div>
                                <p class="text-muted">Nov 23, 2017 11:45am</p>
                                <p>I love this</p>
                            </div><a href="#pp-drop-comment"><i class="fa fa-reply" aria-hidden="true"></i><span>Reply</span></a>
                        </div>
                        <div class="media pl-5"><img class="img-fluid mr-3" src="images/face-3.jpg" alt="Image"/>
                            <div class="media-body">
                                <div class="h5 mt-0">Jina Sara</div>
                                <p class="text-muted">Nov 23, 2017 11:48am</p>
                                <p>Thanks</p>
                            </div><a href="#pp-drop-comment"><i class="fa fa-reply" aria-hidden="true"></i><span>Reply</span></a>
                        </div>
                        <div class="media"><img class="img-fluid mr-3" src="images/face-5.jpg" alt="Image"/>
                            <div class="media-body">
                                <div class="h5 mt-0">Alena</div>
                                <p class="text-muted">Nov 23, 2017 11:50am</p>
                                <p>I need this image for bill poster</p>
                            </div><a href="#pp-drop-comment"><i class="fa fa-reply" aria-hidden="true"></i><span>Reply</span></a>
                        </div>
                        <div class="media pl-5"><img class="img-fluid mr-3" src="images/face-4.jpg" alt="Image"/>
                            <div class="media-body">
                                <div class="h5 mt-0">Adelle Charles</div>
                                <p class="text-muted">Nov 23, 2017 11:55am</p>
                                <p>Our team will send as soon as possible</p>
                            </div><a href="#pp-drop-comment"><i class="fa fa-reply" aria-hidden="true"></i><span>Reply</span></a>
                        </div>
                    </div>
                </div>
                <div class="pp-section"></div>
                <div class="row" id="pp-drop-comment">
                    <div class="col">
                        <div class="h4 mb-3">Drop a Comment</div>
                        <form action="https://formspree.io/your@email.com" method="POST">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <input class="mr-3 form-control" type="text" name="first-name" placeholder="*First Name"/>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <input class="form-control" type="text" name="last-name" placeholder="*Last Name"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <input class="form-control" type="email" name="_replyto" placeholder="*E-mail"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <textarea class="form-control" name="message" placeholder="*Your Message"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-primary" type="submit">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="pp-section"></div></div>
    </div>
<?php
include 'includes/footer.inc.php';
?>