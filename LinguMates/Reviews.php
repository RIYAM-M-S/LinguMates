<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating & Reviews</title>
    <link rel="stylesheet" href="LHP.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-GLhlTQ8i1IIVoaFaLcl5wjKOBn0Kk/RUdFEae83a6ho1NFwnfA5qBLF85fwApQ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9eeac525af.js" crossorigin="anonymous"></script>
    <?php
        // Database connection details
        define("DBHOST", "localhost");
        define("DBUSER", "root");
        define("DBPWD", "");
        define("DBNAME", "web_project");
        // Create connection
        $conn = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    ?>

    <style>
        .round-image {
            width: 60px;
            height: 60px;
            border-radius: 50%; /* This will make the image round */
            border: 2px solid #333; /* This will create a dark outline */
            
        }
        .round-image2 {
            width: 150px;
            height: 150px;
            border-radius: 50%; /* This will make the image round */
            border: 2px solid #333; /* This will create a dark outline */
            
        }
        h2 {
            text-align: center;
            font-weight: 500;
            color:#333
        }
    
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="NS_homepage.html">
                    <img src="logo.png" alt="Logo">
                </a>
            </div>
          
            <div class="links">
                <ul>
                    <li>
                    
                        <a href="NativeProfilePage.html">
                          <img src="user.png" alt="User" class="round-image">
                        </a>
                    </li>
                    <li><a href="Homepage.html">Sign out</a></li>
                </ul>
            </div>
        </div>
    </header>

    <header >
        <div>
            <a href="learnerProfile.html">
              <img src="user.png" alt="User" class="round-image2">
            </a>
        </div>
      <h1 class="hero-title">Ahmad Ali</h1>
      <p class="hero-description">Hello I'm Ahmad, your expert language tutor! With 5 years of experience, I specialize in English. I create personalized lessons tailored to your needs, making learning fun and effective. Let's embark on this language journey</p>
      <h4 class="hero-description">Proficiency Level in English: Advanced</h4>
      <h4 class="hero-description">Rating:</h4>
      <?php
            $sql = "SELECT AVG(rating) AS avg_rating FROM reviews_ratings JOIN sessions ON reviews_ratings.sessionID = sessions.sessionID WHERE sessions.partnerID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $_SESSION["partnerID"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $roundedRating = floor($row['avg_rating']);

            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $roundedRating) {
                    echo "<img src='star-filled.png' alt='Filled Star' class='star-icon'>";
                } else {
                    echo "<img src='star-unfilled.png' alt='Empty Star' class='star-icon'>";
                }
            }

            mysqli_stmt_close($stmt);
        ?>

    </header>
    <div class="time-load-section">
        <div class="container">
            <h1 class="section-title">
                See some Reviews of Ahmad!
            </h1>
            <p class="section-description">
                read about the experience of Ahmad's students
            </p>

            <div class="row">
                <?php

                    // SQL query to retrieve review information
                    $sql = "SELECT  r.learnerID, r.rating, r.review, r.created_at, l.firstName, l.lastName
                    FROM reviews_ratings r
                    JOIN learners l ON r.learnerID = l.learnerID";
                    $result = mysqli_query($conn, $sql);

                    // Display review cards in HTML format
                    if(mysqli_num_rows($result) > 0) {
                    echo "<div class='row'>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $roundedRating = floor($row['rating']);
                        echo "<div class='card'>";
                        echo "<h1 class='card-timing'>" . $row['firstName'] . " ".  $row['lastName'] ."</h1>";
                        echo "<p class='card-description'>";
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $roundedRating) {
                                echo "<img src='star-filled.png' alt='Filled Star' class='star-icon'>";
                            } else {
                                echo "<img src='star-unfilled.png' alt='Empty Star' class='star-icon'>";
                            }
                        }
                        echo "</p>";
                        echo "<p class='card-description'>" . $row['review'] . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                    }else{
                        echo "<h2>You don't have any reviews </h2>";
                    }
                    // Close the connection
                    mysqli_close($conn);
                ?>
                
                
            </div>
         </div>
    </div>

 

    <footer>
        <div class="footerContainer">
            <div class="socialicon">
                <a href="https://facebook.com"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/?hl=ar"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
                <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        
        <div class="footerNav">
            <ul>
                <li><a href="aboutus.html">About us</a></li>
                <li><a href="mailto:lingumates@gmail.com">Contact us</a></li>
            </ul>
        </div>
    </footer>
    <div class="footerBottom">
      <p>&copy; LinguMates, 2024;  </p>
  </div>
    </body>
    
    </html>        
  
