<?php
$con = mysqli_connect("localhost", "root", "", "social_media") or die("connection was not established");

//function for getting topics
function getTopics()
{
    global $con;

    $get_topics = "select * from topics";

    $run_topics = mysqli_query($con, $get_topics);

    while ($row = mysqli_fetch_array($run_topics)) {
        $topic_id = $row['topic_id'];
        $topic_name = $row['topic_name'];

        echo "<option value='$topic_id'>$topic_name</option>";
    }
}

//function for inserting posts
function insertPOST()
{
    if (isset($_POST['sub'])) {
        global $con;
        global $user_id;
        $title = addslashes($_POST['title']);
        $content = addslashes($_POST['content']);
        $topic = addslashes($_POST['topic']);

        if ($content == '' or $title == '') {
            echo "<h2>Please enter topic and description</h2>";

            exit();
        } else {
            $insert = "insert into posts (user_id,topic_id,post_title,post_content,post_date) values ('$user_id','$topic','$title','$content',NOW())";

            $run = mysqli_query($con, $insert);
            if ($run) {
                echo "<h3>Posted to timeline,Looks great!</h3>";

                $update = "update users set posts='yes' where user_id='$user_id'";
                $run_update = mysqli_query($con, $update);
            }
        }
    }
}

//function for displaying posts
function get_posts()
{
    global $con;

    $per_page = 5;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $start_from = ($page - 1) * $per_page;
    $get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from,$per_page";
    $run_posts = mysqli_query($con, $get_posts);
    while ($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = substr($row_posts['post_content'], 0, 100);
        $post_date = $row_posts['post_date'];

        //getting the user who has posted the thread
        $user = "select * from users where user_id='$user_id' AND posts='yes'";
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        //now displaying all at once
        echo "<div id='posts'>
        <p><img src='users/$user_image' width='50' height='50' ></p>
        <h3><a href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
        <h3>$post_title</h3>
        <p>$post_date</p>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style='float:right;'><button>See Replies or Reply to This</button></a>

        </div><br/>";
    }
    include("pagination.php");
}

function single_post()
{
    if (isset($_GET['post_id'])) {
        global $con;

        $get_id = $_GET['post_id'];
        $get_posts = "select * from posts where post_id='$get_id'";

        $run_posts = mysqli_query($con, $get_posts);
        $row_posts = mysqli_fetch_array($run_posts);

        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];

        //getting the user who has posted the thread
        $user = "select * from users where user_id='$user_id' AND posts='yes'";

        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        //getting the user session
        $user_com = $_SESSION['user_email'];
        $get_com = "select * from users where user_email='$user_com'";
        $run_com = mysqli_query($con, $get_com);
        $row_com = mysqli_fetch_array($run_com);
        $user_com_id = $row_user['user_id'];
        $user_com_name = $row_user['user_name'];

        //now displaying all at once
        echo "<div id='posts'>
        <p><img src='users/$user_image' width='50' height='50' ></p>
        <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
        <h3>$post_title</h3>
        <p>$post_date</p>
        <p>$content</p>
        </div>";

        include("comments.php");

        echo "
        <form action='' method='POST' id='reply'>
        <textarea cols='50' rows='5' name='comment' placeholder='Write your reply'></textarea><br/>
        <input type='submit' name='reply' value='Reply to This'/>
        </form>";

        if (isset($_POST['reply'])) {
            $comment = $_POST['comment'];
            $insert = "insert into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','$comment','$user_com_name',NOW())";

            $run = mysqli_query($con, $insert);

            echo "<h2>Your Reply was added!</h2>";
        }
    }
}

function members()
{
    global $con;
    //select all members
    $user = "select * from users";

    $run_user = mysqli_query($con, $user);

    while ($row_user = mysqli_fetch_array($run_user)) {
        $user_id = $row_user['user_id'];
        $user_name = $row_user['user_name'];
        $user_image = $row_user['userc_image'];

        echo "
        <span>
        <a href='user_profile.php?u_id=$user_id'>
        <img src='users/$user_image' width='50' height='50' title='$user_name' style='float:left; margin:2px'/>
        </a>
        </span>";
    }
}

//function for displaying user posts
function user_posts()
{
    global $con;

    if (isset($_GET['u_id'])) {
        $u_id = $_GET['u_id'];
    }

    $get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5";

    $run_posts = mysqli_query($con, $get_posts);

    while ($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];

        //getting the user who has posted the thread
        $user = "select * from users where user_id='$user_id' AND posts='yes'";

        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        //now displaying all at once
        echo "<div id = 'posts'>

        <p><img src='users/$user_image' width='50' height='50' ></p>
        <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
        <h3>$post_title</h3>
        <p>$post_date</p>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style='float:right;'><button>View</button></a>
        <a href='edit_post.php?post_id=$post_id' style='float:right;'><button>Edit</button></a>
        <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button>Delete</button></a>
        </div><br/>";

        include("delete_post.php");
    }
}

function user_profile()
{
    if (isset($_GET['u_id'])) {
        global $con;

        $user_id = $_GET['u_id'];
        $select = "select * from users where user_id='$user_id'";

        $run = mysqli_query($con, $select);
        $row = mysqli_fetch_array($run);

        $id = $row['user_id'];
        $image = $row['user_image'];
        $name = $row['user_name'];
        $country = $row['user_country'];
        $gender = $row['user_gender'];
        $last_login = $row['user_last_last_login'];
        $register_date = $row['user_reg_date'];

        if ($gender == 'male') {
            $msg = "Send him a message";
        } else {
            $msg = "Send her a message";
        }

        echo "<div id='user_profile'>
        <img src='users/$image' width='150' height='150'/><br/>
                    
                    <p><strong>Name:</strong>$name</p>
                    <p><strong>Gender:</strong>$gender</p>
                    <p><strong>Country:</strong>$country</p>
                    <p><strong>Last Login:</strong>$last_login</p>
                    <p><strong>Member Since:</strong>$register_date</p>
                    <a href='messages.php?u_id=$id'><button>$msg</button>)</a><hr>
        </div>";
    }
}

//function for displaying category posts
function show_topics()
{
    global $con;

    if (isset($_GET['topic'])) {
        $id = $_GET['topic'];
    }

    $get_posts = "select * from posts where topic_id='$id'";

    $run_posts = mysqli_query($con, $get_posts);

    while ($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];

        //getting the user who has posted the thread
        $user = "select * from users where user_id='$user_id' AND posts='yes'";

        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        //now displaying all at once
        echo "<div id = 'posts'>

        <p><img src='users/$user_image' width='50' height='50' ></p>
        <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
        <h3>$post_title</h3>
        <p>$post_date</p>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style='float:right;'><button>View</button></a>
        <a href='edit_post.php?post_id=$post_id' style='float:right;'><button>Edit</button></a>
        <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button>Delete</button></a>
        </div><br/>";

        include("delete_post.php");
    }
}

//function for displaying displaying search results
function result()
{
    global $con;

    if (isset($_GET['search'])) {
        $search_query = $_GET['user_query'];
    }

    $get_posts = "select * from posts where post_title like '%$search_query%' OR post_content like '%$search_query%'";

    $run_posts = mysqli_query($con, $get_posts);

    while ($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];

        //getting the user who has posted the thread
        $user = "select * from users where user_id='$user_id' AND posts='yes'";

        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        //now displaying all at once
        echo "<div id = 'posts'>

        <p><img src='users/$user_image' width='50' height='50' ></p>
        <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
        <h3>$post_title</h3>
        <p>$post_date</p>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style='float:right;'><button>View</button></a>
        <a href='edit_post.php?post_id=$post_id' style='float:right;'><button>Edit</button></a>
        <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button>Delete</button></a>
        </div><br/>";

        include("delete_post.php");
    }
}
