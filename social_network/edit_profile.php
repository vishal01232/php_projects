<!DOCTYPE html>
<?Php
error_reporting(0);
session_start();
include("includes/connection.php");
include("functions/functions.php");
?>

<html lang="en">

<head>
    <title>Welcome User!</title>
    <link rel="stylesheet" href="styles/home_style.css" media="all" />
</head>

<body>
    <!--container starts-->
    <div class="container">
        <!--header wrapper starts-->
        <div id="head_wrap">
            <!--header starts-->
            <div id="header">
                <ul id="menu">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="members.php">Members</a></li>
                    <strong>Topics:</strong>
                    <?php
                    $get_topics = "select * from topics";
                    $run_topics = mysqli_query($con, $get_topics);

                    while ($row = mysqli_fetch_array($run_topics)) {
                        $topic_id = $row['topic_id'];
                        $topic_name = $row['topic_name'];

                        echo "<li><a href='topic.php?topic=$topic_id'>$topic_name</a></li>";
                    }
                    ?>
                </ul>
                <form method="get" action="result.php" id="form1">
                    <input type="text" name="user_query" placeholder="Search a topic" />
                    <input type="Submit" name="search" value="Search" />
                </form>
            </div>
            <!--header end-->
        </div>
        <!--header wrapper end-->

        <!--content area starts-->
        <div class="content">
            <!--user timeline start-->
            <div id="user_timeline">
                <div id="user_details">
                    <?php
                    $user = $_SESSION['user_email'];
                    $get_user = "select * from users where user_email='$user'";
                    $run_user = mysqli_query($con, $get_user);
                    $row = mysqli_fetch_array($run_user);

                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    $user_pass = $row['user_pass'];
                    $user_email = $row['user_email'];
                    $user_country = $row['user_country'];
                    $user_gender = $row['user_gender'];
                    $user_image = $row['user_image'];
                    $user_reg_date = $row['user_reg_date'];
                    $last_last_login = $row['last_last_login'];

                    $user_posts = "select * from posts where user_id='$user_id'";
                    $run_posts = mysqli_query($con, $user_posts);
                    $posts = mysqli_num_rows($run_posts);

                    //getting the number of unread mssg
                    $sel_msg = "select * from messages where receiver='$user_id' AND status='unread' ORDER by 1 DESC";
                    $run_msg = mysqli_query($con, $sel_msg);
                    $count_msg = mysqli_num_rows($run_msg);

                    echo "<center>
                    <img src='users/$user_image' width='200' height='200'/></center>
                    <div id='user_mention'>
                    <p><strong>Name:</strong>$user_name</p>
                    <p><strong>Country:</strong>$user_country</p>
                    <p><strong>Last Login:</strong>$last_last_login</p>
                    <p><strong>Member Since:</strong>$user_reg_date</p>

                    <p><a href='my_messages.php?inbox&u_id=$user_id'>Messages($count_msg)</a></p>
                    <p><a href='my_posts.php?u_id=$user_id'>My Posts($posts)</a></p>
                    <p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
                    <p><a href='logout.php'>Logout</a></p>

                    </div>
                    ";
                    ?>
                </div>
            </div>
            <!--user timeline end-->
            <!--content timeline start-->
            <div>
                <form action="" method="POST" id="f" class="ff" enctype="multipart/form-data">
                    <table>
                        <tr align="center">
                            <td colspan="6">
                                <h2>Edit Your Profile:</h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Name:</td>
                            <td>
                                <input type="text" name="u_name" required="required" value="<?php echo $user_name; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Password:</td>
                            <td>
                                <input type="password" name="u_pass" required="required" value="<?php echo $user_pass; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Email:</td>
                            <td>
                                <input type="Email" name="u_email" required="required" value="<?php echo $user_email; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Country:</td>
                            <td>
                                <select name="u_country" disabled="disabled">
                                    <option><?php echo $user_country; ?></option>
                                    <option>Afganistan:</option>
                                    <option>India:</option>
                                    <option>UK:</option>
                                    <option>United states:</option>
                                    <option>United Arab Emirates:</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Gender:</td>
                            <td>
                                <select name="u_gender" disabled="disabled">
                                    <option><?php echo $user_gender; ?></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Photo:</td>
                            <td>
                                <input type="file" name="u_image" required="required" />
                            </td>
                        </tr>

                        <tr align="center">
                            <td colspan="6">
                                <input type="submit" name="update" value="update" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?Php
                if (isset($_POST['update'])) {
                    $u_name = $_POST['u_name'];
                    $u_pass = $_POST['u_pass'];
                    $u_email = $_POST['u_email'];
                    $u_image = $_FILES['u_image']['name'];
                    $image_tmp = $_FILES['u_image']['tmp_name'];

                    move_uploaded_file($image_tmp, "users/$u_image");

                    $update = "update users set user_name='$u_name',user_pass='$u_pass',user_email='$u_email',user_image='$u_image', where user_id='$user_id'";

                    $run = mysqli_query($con, $update);

                    if ($run) {
                        echo "<script>alert('Your Profile Updated!'</script>";
                        echo "<script>window.open('home.php','self')</script>";
                    }
                }
                ?>
            </div>

            <!--content timeline end-->
        </div>
        <!--content area end-->
    </div>
    </div>


    <!--container end-->
</body>

</html>