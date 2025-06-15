<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>V serve</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Poppins:wght@600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon"       href="images/fav-icon.png" type="image/gif" sizes="16x16"> 
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Icon Font Stylesheet -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11.1.0/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
  </head>
  <body>
  <?php
include('header.php')
?>
<section class="product-form-banner">
    <div class="container" id="form-banner-left">
        <div class="row">
            <div class="col-md-5">
                <div style="padding: 5%;">
                    <img src="img/product-form-img.png" alt="" width="100%">
                </div>
            </div>
            <div class="col-md-5">
                <div id="tab-1" class="tab-contents current">
                    <form action="userquery.php" method="post" enctype="multipart/form-data">
                        <div class="today-para">
                            <p>Register</p>
                        </div>
                        <div class="today-para">
                            <input type="text" name="user_name" placeholder="Your Name" class="form-control" required>
                        </div>
                        <div class="today-para">
                            <input type="email" name="email" placeholder="Enter a Mail-id" class="form-control" required>
                        </div>
                        <div class="today-para">
                            <input type="number" name="phone_number" placeholder="+91 Mobile Number" class="form-control" required>
                        </div>
                        <div class="today-para">
                            <input type="text" name="address" placeholder="Your Address" class="form-control" required>
                        </div>
                            <div class="today-para">
                            <label for="adharcard">Upload Aadhar Card:</label>
                            <input type="file" name="adharcard" id="adharcard" class="form-control" accept="image/*,application/pdf" required>
                        </div>

                        <div class="today-para">
                            <label for="pancard">Upload PAN Card:</label>
                            <input type="file" name="pancard" id="pancard" class="form-control" accept="image/*,application/pdf" required>
                        </div>

                        <div class="today-para">
                            <label for="photo">Upload Your Photo:</label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*" required>
                        </div>
                        <div class="today-para">
                            <input type="text" name="vehicle_number" placeholder="Vehicle Number" class="form-control" required>
                        </div>
                        <div class="today-para">
                            <input type="text" name="chase_number" placeholder="Chase Number or Engine Number" class="form-control" required>
                        </div>
                        <div class="today-para">
                            <select name="insurance_type" class="form-control" required>
                                <option value="" disabled selected>Select Insurance Type</option>
                                <option value="Life Insurance">Life Insurance</option>
                                <option value="Health Insurance">Health Insurance</option>
                                <option value="Home Insurance">Home Insurance</option>
                                <option value="Vehicle Insurance">Vehicle Insurance</option>
                                <option value="Business Insurance">Business Insurance</option>
                                <option value="Property Insurance">Property Insurance</option>
                            </select>
                        </div>

                        <div class="today-para">
                            <label for="rc_book">Upload RC Book Document:</label>
                            <input type="file" name="rc_book" id="rc_book" class="form-control" accept="application/pdf,image/*" required>
                        </div>
                        <div class="term-btn">
                            <button type="submit" name="submit" class="form-control">Register</button>
                        </div>
                        <div class="quotes-para">
                            <p>By clicking on <a href="#">Register</a> and <a href="">Privacy Policy</a>, you agree to our terms and conditions.</p>
                        </div>
                    </form>
                            
                </div>
                <div id="tab-2" class="tab-contents" >
                            <form action="">
                            <div class="today-para">
                                <p> Grow Your <strong class="text-primary"> Wealth</strong> With <strong class="text-primary"> Protection (in-built life cover)</strong> </p>
    
                            </div>
                            <div class="today-para">
                                
                                <input type="text" placeholder="Your Name" class="form-control">
                            </div>
                            
                            <div  class="today-para">
                               
                                <input type="number" placeholder="+91 Mobile Number" class="form-control">
                            </div>
                            <div class="term-btn">
                                <button type="submit"  class="form-control">View Investment Plans</button>
                            </div>
                            <div  class="quotes-para">
                                <p>By clicking on "View Term Quotes" you agree to our <a href=""> Privacy Policy </a>and <a href="">Terms of use</a>
                                    Tax benefit is subject to changes in tax laws</p>
                            </div>
                        </form>
            
                    
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 review-client">
                <h5>4.8 Rated</h5>
                <div>
                    <div class="ClientReview_Stars">
                        ★★★★★
                      </div>
                </div>
            </div>
            <div class="col-md-2 review-client">
                <h5>4.2  Crore</h5>
            </div>
            <div class="col-md-2 review-client">
                <h5>7.7 Crore</h5>
            </div>
            <div class="col-md-2 review-client">
                <h5>50 Partners</h5>
            </div>
        </div>
    </div>
</section>
  <!-- Footer Start -->
  <?php
     include('footer.php');
     ?>
    <!-- Footer End -->





   <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
     $(document).ready(function(){
	
	$('ul.tabs-sec li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs-sec li').removeClass('current');
		$('.tab-contents').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

});
    </script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </body>
</html>