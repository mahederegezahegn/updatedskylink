<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News Website</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Graduate&display=swap');

::-webkit-scrollbar {
  width: 10px;
  background-color: #f5f5f5;
}

::-webkit-scrollbar-thumb {
  background-color: #337ab7;
  /* border-radius: 6px//; */
}

::-webkit-scrollbar-thumb:hover {
  background-color: #135897;
}


header nav {
    color: #777;
    font-size:15px;
    font-family: 'Graduate', cursive;
  }
  body{
    
    font-family: 'Open sans', cursive !important;
    overflow-x: hidden;
  }
  header nav ul li{
      padding-left: 1rem;
  }
  header nav ul li:hover a {
    color: #5252db;
  }
  header nav ul li:active a {
    color: #5252db;
  }
  header {
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    background-color: rgb(255, 255
    , 255
    );
    padding:0 20px;

    font-family: "Raleway";
    font-weight: bolder;
    position: sticky;
    top: 0;
    z-index: 100;}
  
    

  .swiper-container {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  /* Restyled CSS */
  .navbar {
    padding: 1rem;
  }

  .navbar-brand {
    font-size: 24px;
  }

  .navbar-toggler {
    border: none;
  }

  .navbar-nav .nav-link {
    font-size: 18px;
    padding: 0.5rem 1rem;
  }

  .section-title {
    font-size: 24px;
    margin-bottom: 2rem;
  }

  .article-card {
    border: none;
    border-radius: 5px;
    overflow: hidden;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  

  .article-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }

  .article-card .card-body {
    padding: 1.5rem;
  }
.breaking-news h1,h3{
  font-size:3rem;
  font-weight:bolder;
  
  text-transform:capitalize;
}
.breaking-news p{
  text-transform:capitalize;
  text-align:start;
  font-size:1.52rem;
}
  .article-card h3 {
    font-size: 20px;
    margin-bottom: 1rem;
  }

  .article-card p {
    color: #777777;
  }
.news{
  padding:0 2rem;
}
  .read-more-btn {
    margin-top: 1rem;
  }
</style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <div class="container">
           <a class="navbar-brand" href="index.html">
            <img  class="dark-logo" alt="Skylink Technologies" width="210" height="120px" src="assets/images/Ict expo final .png" /></a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active " href="index.html">Home</a>
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
              <a class="nav-link active" href="what_new.php">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sponsors.html">sponsors</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
          </ul>
        </div>

      </div>
    </nav>
  </header>
  <main>
    <div class="container">
      

      <section class="mt-5" data-aos="fade-up">
      <?php
include_once('dbcon.php');
// Fetch breaking news from the event table
$query = "SELECT * FROM events WHERE event_type = 'breaking-n' ORDER BY event_date DESC LIMIT 3"; // Adjust the query based on your table structure
$result = mysqli_query($mysqli, $query);
?>

<div class="card-container">
  <swiper-container class="mySwiper" navigation="true">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <swiper-slide>
        <div class="cards">
          <div class="row">
            <div class="col-lg-6">
            <img src="admin/<?php echo $row['event_image']; ?>" class="card-img-top">
            </div>
            <div class="col-lg-6 breaking-news text-center">
              <h1>
                <?php// echo $row['event_type']; ?>
              </h1>
              <h3><?php echo $row['event_title']; ?></h3>
              <p><?php echo $row['event_description']; ?></p>
             
            </div>
          </div>
        </div>
      </swiper-slide>
    <?php } ?>
  </swiper-container>
</div>

</div>
      </section>
 <!-- Other Articles Section -->
 <section class="news mt-5" data-aos="fade-up">
   <h2 class="section-title">Other Articles</h2>
   <div class="row">
     <?php
     // Fetch events and news from the events table
     $query = "SELECT * FROM events WHERE event_type IN ('event', 'news') ORDER BY event_date DESC";
     $result = mysqli_query($mysqli, $query);

     while ($row = mysqli_fetch_assoc($result)) {
       ?>
       <div class=" cards col-md-4">
         <div class="card article-card">
           <img src="admin/<?php echo $row['event_image']; ?>" class="card-img-top">
           <div class="card-body">
             <h3><?php echo $row['event_title']; ?></h3>
             <p><?php echo $row['event_description']; ?></p>
             <!-- <a href="#" class="btn btn-primary read-more-btn">Read More</a> -->
           </div>
         </div>
       </div>
     <?php
     }
     ?>
   </div>
 </section>
    </div>
  </main>

 
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>