<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100&family=Nanum+Myeongjo:wght@700&family=Playfair+Display+SC&family=Raleway:wght@100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="news.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>

  <title>Your Website</title>
</head>
<style>
  .swip .row{
    /* background: rgba( 255, 255, 255, 0.4 ); */
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
width:fit-content;
backdrop-filter: blur( 2px );
-webkit-backdrop-filter: blur( 2px );
border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );
text-align:center;

  }
  .news-card{
 display:flex;
 justify-content:center;
 align-items:center;
  }
  .news-card .row .f{
    display:flex;
    justify-content:space-around;
    text-transform:capitalize;
    
font-weight:500;
color:#fff;
  }
@keyframes heartbeat {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1.5);
  }
} 
.myswiper .news-card {
  color:black;
text-transform:capitalize' !important;
  /* text-transform: capitalize !important; */
}
  </style>
</style>
<body>

  <!-- Header -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">
            <img  class="dark-logo" alt="Skylink Technologies" width="190" height="50" data-src-retina="https://skylinkict.com/wp-content/uploads/2023/05/log-012-160x86@2x.png" src="https://skylinkict.com/wp-content/uploads/2023/05/log-012-160x86.png" />														</a>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link  " href="index.html">Home</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link "  href="about.html">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="program.html">Program</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="exhibitors.html">Exhibitors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="attend.html">Attend</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="news.php">News</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>


  <div class="containera">
    <div class="jumbotron">
   
<div class="swip">

<?php
// Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

// Create a new mysqli connection
$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}
$query = "SELECT * FROM events where event_type='breaking-n'";
$result = $mysqli->query($query);
?>
       <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" navigation="true" space-between="30"
    centered-slides="true" autoplay-delay="2500" autoplay-disable-on-interaction="false">


     <?php
     
            while ($row = $result->fetch_assoc()) {
                $eventTitle = $row['event_title'];
                $eventDate=$row['event_date'];
                $eventDescription = $row['event_description'];
                
                $eventImage = $row['event_image'];

                ?>


                  <swiper-slide>
                  <div class="news-card" style="background-image: url('admin/<?php echo $eventImage; ?>');
                             background-position: center;
                             background-size: cover;">
                             <div class="row">
                            <div class="f"><h1 class="text-black"><?php echo $eventTitle; ?></h1> 
                            <h2 class="text-black"><?php echo $eventDate;?></h2> <br></div>
                            <h3 class="text-black"><?php echo $eventDescription; ?></h3>
                        </div>
                        
                    </div>
                </swiper-slide>
            <?php
            }
            ?>
  </swiper-container>

  </div>
  

  </div>

<?php
$query = "SELECT * FROM events WHERE event_type != 'breaking-n'";
$result = $mysqli->query($query);
?>
<div class="row">
    <?php
    while ($row = $result->fetch_assoc()) {
        $eventTitle = $row['event_title'];
        $eventDate = $row['event_date'];
        $eventDescription = $row['event_description'];
        $eventImage = $row['event_image'];
    ?>
        <div class="card text-center" style="text-transform:capitalize;">
            <img src="admin/<?php echo $eventImage; ?>" class="card-img-top" alt="News Image">
            <div class="card-body">
                <h5 class="card-title"><?php echo $eventTitle; ?></h5>
                <p class="card-text"><?php echo $eventDescription; ?></p>
                <h5 class="text-black"><?php echo $eventDate; ?></h5>
                <hr>
            </div>
        </div>
    <?php
    }
    ?>
</div>
</div>





  

  


<section class="contact-section">
  <div class="container">
    <div class="row justify-content-evenly">
      <div class="col-md-4 text-center">
        <img src="assets/Date picker.gif" alt="Date & Venue Illustration" class="illustration">
        <h3>Date & Venue</h3>
        <p>May 14 - May 18, 2020</p>
        <p>Addis Ababa, Ethiopia</p>
      </div>
      <div class="col-md-4 text-center">
        <img src="assets/Get in touch.gif" alt="Get in Touch Illustration" class="illustration">
        <h3>Get in Touch</h3>
        <p>Email: info@example.com<br>Phone: +1 123 456 7890</p>
      </div>
      <div class="col-md-4 text-center">
        <img src="assets/Share link.gif" alt="Quick Links Illustration" class="illustration">
        <h3>Quick Links</h3>
        <ul class="list-unstyled">
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="program.html">Program</a></li>
          <li><a href="exhibitors.html">Exhibitors</a></li>
        </ul>
        <div class="follow-us">
          <h4>Follow Us</h4>
          <ul class="social-media-icons unstyled">
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<button class="scroll-to-top" onclick="scrollToTop()">
   
  <i class="fas fa-arrow-up"></i></button>
  <script src="js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>