  <!DOCTYPE html>


<?php 
session_start();
include("includes/connection.php");
include("functions/functions.php");

?>

<html>
<head>
    
    <title>Welcome User!</title>
    <link rel="stylesheet" href="styles/home_style.css" media="all"/>
</head>

<body>
   <!-- Container starts here-->
    <div class="container">
       <!--Headere Wrapper Starts-->
        <div id="head_wrap">
            <!--Header Starts-->
            <div id="header">
                
                <ul id="menu">
                   <li><a href="home.php">Home</a></li>
                   <li><a href="members.php">Members</a></li>
                 <strong>Topics:</strong>
                    
                    <?php
                    
                    $get_topics = "select * from topics";
                    $run_topics = mysqli_query($con,$get_topics);
                    
                    while($row=mysqli_fetch_array($run_topics)){
                        
                        $topic_id = $row['topic_id'];
                        $topic_name = $row['topic_name'];
                        
                        echo"<li><a href='topic.php?topic=$topic_id'>$topic_name</a></li>";
                        
                    }
                    ?>
                    
                </ul>
              <form method="get" action="results.php" id='form1'>
                  <input type="text" name="user_query" placeholder="Search a topic"/>
                  <input type="submit" name="search" value="Search"/>
                </form>
            
            
            </div>
            <!--Header Ends-->
        
         </div>
        <!--Header Wrapper Ends Here-->
        
        <!--Content Area Starts-->
        
        <div class="content">
        
        <!--User Timeline Starts-->
            <div id="user_timeline">
                <div id="user_details">
                <?php
                $user = $_SESSION['user_email'];
                $get_user = "select * from users where user_email='$user'";
                $run_user = mysqli_query($con,$get_user);
                $row = mysqli_fetch_array($run_user);
                
                
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_country = $row['user_branch'];
                $user_image = $row['user_image'];
                $user_date = $row['user_reg_date'];
                $user_login = $row['user_last_login'];
                
                $user_posts = "select * from post where user_id='$user_id'";
                $run_posts = mysqli_query($con,$user_posts);
                $posts = mysqli_num_rows($run_posts);
                
                //getting the number of unread messages
                $sel_msg = "select * from messages where receiver='$user_id' AND status='unread' ORDER by 1 DESC";
                $run_msg = mysqli_query($con,$sel_msg);
                $count_msg = mysqli_num_rows($run_msg);
                
                echo"
                <center>
                <img src='users/$user_image' width='200' height='200'/>
                </center>
                <div id='user_mention'>
                
                <p><strong>Name:</strong> $user_name</p>
                <p><strong>Country:</strong> $user_country</p>
                <p><strong>Last Login:</strong> $user_login</p>
                <p><strong>Member Since:</strong> $user_date Hrs</p>
                
                <p><a href='my_messages.php?inbox&u_id=$user_id'>Messages($count_msg)</a></p>
                <p><a href='my_posts.php?inbox&u_id=$user_id'>My Posts($posts)</a></p>
                <p><a href='edit_profile.php?inbox&u_id=$user_id'>Edit My Account</a></p>
                <p><a href='logout.php'>Logout</a></p>
                </div>
                
                ";
                    
                
                ?>
                    </div>
            
            </div>
            <!--User Timeline Ends-->
        <!--Content Timeline Starts-->  
            <div id="content_timeline">
                
                    <h3><font color="white" size="5">All Posts...</font></h3>
                       <?php user_posts(); ?>
                    
            
            </div>
            <!--Content timeline ends-->
        
        </div>
    <!--Content Area Ends-->    
    
    </div>
    <!--Container Ends-->

</body>
</html>