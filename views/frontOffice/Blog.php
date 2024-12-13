<?php
include '../../controllers/PostC.php';
include '../../controllers/CommentC.php';
$PostC=new PostC();
$liste=$PostC->listPosts();
$commentC=new CommentC();
?>
<script>
    function validateComment(postID) {
        var pseudo = document.getElementById("Pseudo" + postID).value;
        var contenu = document.getElementById("Contenu" + postID).value;

        if (pseudo.trim() === "" || contenu.trim() === "") {
            alert("Veuillez remplir tous les champs.");
            return false;
        }
        return true;
    }
</script>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Free Education Template</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../frontOffice/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
<link href="../frontOffice/assets/css/font-awesome.min.css" rel="stylesheet" />
     <!-- FLEXSLIDER CSS -->
<link href="../frontOffice/assets/css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../frontOffice/assets/css/style.css" rel="stylesheet" />    
  <!-- Google	Fonts -->
	<link href='views/http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <style>
        /* Posts Section */
.tour-content {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 colonnes */
    gap: 20px; /* Espacement entre les boîtes */
    margin-top: 20px;
}

.box {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    padding: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.box img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 10px;
}

.box h4 {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 10px;
}

.box p {
    font-size: 0.9rem;
    color: #555;
    margin: 5px 0;
}

.box:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Top Posts Section */
.top-posts .tour-content {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 20px;
}

/* Search Bar */
.searchbar {
    display: block;
    margin: 20px auto;
    padding: 10px 15px;
    font-size: 1rem;
    border: 2px solid #004085;
    border-radius: 5px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s ease;
}

.searchbar:focus {
    border-color: #0062cc;
    outline: none;
}

/* Adjustments for Section Headers */
.center-text h2 {
    font-size: 1.8rem;
    color: #004085;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.center-text {
    text-align: center;
}

/* Button Styling */
button {
    background-color: #004085;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

button:hover {
    background-color: #0062cc;
    transform: translateY(-2px);
}

/* Global Adjustments for Responsiveness */
@media (max-width: 768px) {
    .tour-content {
        grid-template-columns: repeat(2, 1fr);
    }

    .searchbar {
        width: 90%;
    }
}

@media (max-width: 480px) {
    .tour-content {
        grid-template-columns: 1fr;
    }

    .searchbar {
        width: 100%;
    }
}

    </style>
</head>
<body >
   
 <div class="navbar navbar-inverse navbar-fixed-top " id="menu">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img class="logo-custom" src="../frontOffice/assets/img/logo180-50.png" alt=""  /></a>
            </div>
            <div class="navbar-collapse collapse move-me">
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="#home">HOME</a></li>
                     <li><a href="#features-sec">FEATURES</a></li>
                     <li><a href="#contact-sec">CONTACT</a></li>
                     <li><a href="../frontOffice/index.php">ACCOUNT</a></li>
                </ul>
            </div>
           
        </div>
    </div>
      <!--NAVBAR SECTION END-->
       <div class="home-sec" id="home" >
           <div class="overlay">
 <div class="container">
           <div class="row text-center " >
           
               <div class="col-lg-12  col-md-12 col-sm-12">
               
                <div class="flexslider set-flexi" id="main-section" >
                    <ul class="slides move-me">
                        <!-- Slider 01 -->
                        <li>
                              <h3>Delivering Quality Education</h3>
                           <h1>THE UNIQUE METHOD</h1>
                            <a  href="#features-sec" class="btn btn-info btn-lg" >
                                GET AWESOME 
                            </a>
                             <a  href="#features-sec" class="btn btn-success btn-lg" >
                                FEATURE LIST
                            </a>
                        </li>
                        <!-- End Slider 01 -->
                        
                        <!-- Slider 02 -->
                        <li>
                            <h3>Delivering Quality Education</h3>
                           <h1>UNMATCHED APPROACH</h1>
                             <a  href="#features-sec" class="btn btn-primary btn-lg" >
                               GET AWESOME 
                            </a>
                             <a  href="#features-sec" class="btn btn-danger btn-lg" >
                                FEATURE LIST
                            </a>
                        </li>
                        <!-- End Slider 02 -->
                        
                        <!-- Slider 03 -->
                        <li>
                            <h3>Delivering Quality Education</h3>
                           <h1>AWESOME FACULTY PANEL</h1>
                             <a  href="#features-sec" class="btn btn-default btn-lg" >
                                GET AWESOME 
                            </a>
                             <a  href="#features-sec" class="btn btn-info btn-lg" >
                                FEATURE LIST
                            </a>
                        </li>
                        <!-- End Slider 03 -->
                    </ul>
                </div>
        
            </div>
                
               </div>
                </div>
           </div>
           
       </div>
       <!--HOME SECTION END-->   
    <div  class="tag-line" >
         <div class="container">
           <div class="row  text-center" >
           
               <div class="col-lg-12  col-md-12 col-sm-12">
               
        <h2 data-scroll-reveal="enter from the bottom after 0.1s" ><i class="fa fa-circle-o-notch"></i> WELCOME TO THE EDU-CENTER <i class="fa fa-circle-o-notch"></i> </h2>
                   </div>
               </div>
             </div>
        
    </div>
    <!--HOME SECTION TAG LINE END-->   
         <div id="features-sec" class="container set-pad" >
             <div class="row text-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1 data-scroll-reveal="enter from the bottom after 0.2s"  class="header-line">FEATURE LIST </h1>
                     <p data-scroll-reveal="enter from the bottom after 0.3s" >
                      El fazet lbehya eli aadna  
                         </p>
                 </div>

             </div>
             <!--/.HEADER LINE END-->


           <div class="row" >
           
               
                 <div class="col-lg-4  col-md-4 col-sm-4" data-scroll-reveal="enter from the bottom after 0.4s">
                     <div class="about-div">
                     <i class="fa fa-paper-plane-o fa-4x icon-round-border" ></i>
                   <h3 >Quality Education</h3>
                 <hr />
                       <hr />
                   <p >
                       Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                        Aenean commodo . 
                       
                   </p>
               <a href="#" class="btn btn-info btn-set"  >ASK THE EXPERT</a>
                </div>
                   </div>
                   <div class="col-lg-4  col-md-4 col-sm-4" data-scroll-reveal="enter from the bottom after 0.5s">
                     <div class="about-div">
                     <i class="fa fa-bolt fa-4x icon-round-border" ></i>
                   <h3 >SYSTEMATIC APPROACH</h3>
                 <hr />
                       <hr />
                   <p >
                       Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                        Aenean commodo . 
                       
                   </p>
               <a href="#" class="btn btn-info btn-set"  >ASK THE EXPERT</a>
                </div>
                   </div>
                 <div class="col-lg-4  col-md-4 col-sm-4" data-scroll-reveal="enter from the bottom after 0.6s">
                     <div class="about-div">
                     <i class="fa fa-magic fa-4x icon-round-border" ></i>
                   <h3 >ONE TO ONE STUDY</h3>
                 <hr />
                       <hr />
                   <p >
                       Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                        Aenean commodo . 
                       
                   </p>
               <a href="#" class="btn btn-info btn-set"  >ASK THE EXPERT</a>
                </div>
                   </div>
                 
                 
               </div>
             </div>
   <!-- FEATURES SECTION END-->



    <!-- FACULTY SECTION END-->
      <div id="course-sec" class="container set-pad">
             <div class="row text-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">OUR COURSES </h1>
                     <p data-scroll-reveal="enter from the bottom after 0.3s">
                            EL cours kfh (description)
                         </p>
                 </div>

             </div>
             <!--/.HEADER LINE END-->
             <section class="tour" id="posts-section">
    <div class="center-text">
      <h2>Posts</h2>
      <input type="text" id="searchInput" class="searchbar" placeholder="Rechercher par titre...">
    </div>
    <div id="normalPosts" class="tour-content">
    <?php foreach($liste as $post): ?>
    <div class="box" id="box-posts">
        <a href="post_details.php?id=<?= $post['ID_post']; ?>">
            <img src="../Images/<?= $post['Image']; ?>">
            <h4><?= $post['Titre']; ?></h4>
        </a>
        <p>Likes : <?= $post['Likes']; ?> Dislikes : <?= $post['Dislikes']; ?></p>
        <p>Commentaires: <?= $post['Commentaires']; ?></p>
        <p><?= $post['Auteur']; ?> <?= $post['Date_Publication']; ?></p>
    </div>
<?php endforeach; ?>
  </section>
  <section class="top-posts">
    <div class="center-text">
        <h2>Top 3 des Meilleurs Posts</h2>
    </div>
    <div class="tour-content">
        <?php $topPosts = $PostC->getTopPosts(); ?>
        <?php foreach($topPosts as $post): ?>
            <div class="box" id="box-top-posts">
                <a href="post_details.php?id=<?= $post['ID_post']; ?>">
                    <img src="../Images/<?= $post['Image']; ?>">
                    <h4><?= $post['Titre']; ?></h4>
                </a>
                <p>Likes : <?= $post['Likes']; ?> Dislikes : <?= $post['Dislikes']; ?></p>
                <p>Commentaires: <?= $post['Commentaires']; ?></p>
                <p><?= $post['Auteur']; ?> <?= $post['Date_Publication']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
      <!-- COURSES SECTION END-->
    <div id="contact-sec"   >
           <div class="overlay">
 <div class="container set-pad">
      <div class="row text-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line" >CONTACT US  </h1>
                     <p data-scroll-reveal="enter from the bottom after 0.3s">
                      Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                        Aenean commodo.
                         Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                        Aenean commodo.
                         </p>
                 </div>

             </div>
             <!--/.HEADER LINE END-->
           <div class="row set-row-pad"  data-scroll-reveal="enter from the bottom after 0.5s" >
           
               
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control "  required="required" placeholder="Your Name" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control " required="required"  placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <textarea name="message" required="required" class="form-control" style="min-height: 150px;" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-lg">SUBMIT REQUEST</button>
                        </div>

                    </form>
                </div>

                   
     
              
              
                
               </div>
                </div>
          </div> 
       </div>
     <div class="container">
             <div class="row set-row-pad"  >
    <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1 " data-scroll-reveal="enter from the bottom after 0.4s">

                    <h2 ><strong>Our Location </strong></h2>
        <hr />
                    <div ">
                        <h4>234/80 -UFG , New Street,</h4>
                        <h4>Switzerland.</h4>
                        <h4><strong>Call:</strong>  + 67-098-907-1269 / 70 / 71 </h4>
                        <h4><strong>Email: </strong>info@yourdomain.com</h4>
                    </div>


                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1" data-scroll-reveal="enter from the bottom after 0.4s">

                    <h2 ><strong>Social Conectivity </strong></h2>
        <hr />
                    <div >
                        <a href="#">  <img src="../frontOffice/assets/img/Social/facebook.png" alt="" /> </a>
                     <a href="#"> <img src="../frontOffice/assets/img/Social/google-plus.png" alt="" /></a>
                     <a href="#"> <img src="../frontOffice/assets/img/Social/twitter.png" alt="" /></a>
                    </div>
                    </div>


                </div>
                 </div>
     <!-- CONTACT SECTION END-->
    <div id="footer">
          &copy 2014 yourdomain.com | All Rights Reserved |  <a href="http://binarytheme.com" style="color: #fff" target="_blank">Design by : binarytheme.com</a>
    </div>
     <!-- FOOTER SECTION END-->
   
    <!--  Jquery Core Script -->
    <script src="../frontOffice/assets/js/jquery-1.10.2.js"></script>
    <!--  Core Bootstrap Script -->
    <script src="../frontOffice/assets/js/bootstrap.js"></script>
    <!--  Flexslider Scripts --> 
         <script src="../frontOffice/assets/js/jquery.flexslider.js"></script>
     <!--  Scrolling Reveal Script -->
    <script src="../frontOffice/assets/js/scrollReveal.js"></script>
    <!--  Scroll Scripts --> 
    <script src="../frontOffice/assets/js/jquery.easing.min.js"></script>
    <!--  Custom Scripts --> 
         <script src="../frontOffice/assets/js/custom.js"></script>
         </script>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/extrenaljq.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#searchInput').keyup(function(){
            var searchText = $(this).val();
            $.ajax({
                url: 'search_posts.php',
                method: 'GET',
                data: { searchText: searchText },
                success: function(response){
                    $('#normalPosts').html(response);
                }
            });
        });
    });
</script>
</body>
</html>