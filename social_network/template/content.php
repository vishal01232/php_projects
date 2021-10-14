<div id="content">
    <!--content area start here-->
    <div>
        <img src="images/image.jpg" width="1100" height="700" style="float: left; margin-left:-40px" />
    </div>
    <div id="form2">
        <form action="" method="POST">
            <h2>Sign Up Today</h2>
            <table>
                <tr>
                    <td align="right"><strong>Name:</strong></td>
                    <td><input type="text" name="u_name" required="required" placeholder="write your name" /></td>
                </tr>

                <tr>
                    <td align="right"><strong>Password:</strong></td>
                    <td><input type="password" name="u_pass" required="required" placeholder="write your password" /></td>
                </tr>

                <tr>
                    <td align="right"><strong>Email:</strong></td>
                    <td><input type="email" name="u_email" required="required" placeholder="write your email" /></td>
                </tr>

                <tr>
                    <td align="right"><strong>Country:</strong></td>
                    <!--<td><input type="text" name="u_country" required="required" placeholder="enter country name" /></td>-->
                    <td>
                        <select name="u_country">
                            <option>Select a country</option>
                            <option>India</option>
                            <option>Japan</option>
                            <option>England</option>
                            <option>Dubai</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td align="right"><strong>Gender:</strong></td>
                    <td><select name="u_gender">
                            <option>Male</option>
                            <option>Female</option>
                        </select></td>
                </tr>

                <tr>
                    <td align="right"><strong>Birthday:</strong></td>
                    <td><input type="date" name="u_birthday" required="required" /></td>
                </tr>

                <tr>
                    <td colspan="6">
                        <button name="sign_up">Sign Up</button>
                    </td>

                </tr>

            </table>
        </form>
        <?php include("insert_user.php"); ?>
    </div>

</div>
<!--content area end here-->