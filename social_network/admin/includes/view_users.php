<table align="center" width="800" bgcolor="skyblue">
    <tr bgcolor="orange" border="1">
        <th>S.N</th>
        <th>Name</th>
        <th>Country</th>
        <th>Gender</th>
        <th>Image</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    <?Php
    include("includes/connection.php");
    $sel_users = "select * from users ORDER by 1 DESC";
    $run_users = mysqli_query($con, $sel_users);

    $i = 0;
    while ($row_users = mysqli_fetch_array($run_users)) {
        $user_id = $row_users['user_id'];
        $user_name = $row_users['user_name'];
        $user_country = $row_users['user_country'];
        $user_gender = $row_users['user_gender'];
        $user_image = $row_users['user_image'];
        $user_reg_date = $row_users['user_reg_date'];
        $i++;
    ?>
        <tr align="center">
            <td><?php echo $i; ?></td>
            <td><?php echo $user_name; ?></td>
            <td><?php echo $user_country; ?></td>
            <td><?php echo $user_gender; ?></td>
            <td><img src="../users/<?php echo $user_image; ?>" width='50' height='50' /></td>
            <td><a href="delete_user.php?delete=<?php echo $user_id; ?>">Delete</a></td>
            <td><a href="index.php?view_users&edit=<?php echo $user_id; ?>">Edit</a></td>
        </tr>
    <?php } ?>
</table>

<?php
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];

    $sel_msg = "select * from messages where receiver='$user_id' AND status='unread' ORDER by 1 DESC";
    $run_msg = mysqli_query($con, $sel_msg);
    $count_msg = mysqli_num_rows($run_msg);
}
?>