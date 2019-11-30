<html>
    <head>
        <title>Sports details</title>
        <link rel="stylesheet" type="text/css" href="bootstrap.css">
        <link rel="stylesheet" type="text/css" href="adminPage.css">
    </head>
    <body>
        <nav id="adminNav"></nav>
    
        <?php
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $db = 'sportsclub';
            $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
            
            if(! $conn ) 
            {
                die('Could not connect: ' . mysql_error());
            }
            #---------------------------------------------------------------------------------------
            #retreiving values from the form
            $id = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                $id = $_POST["id"];
            }
            if(isset($_POST['delete']))
            {
                $query="delete from user where id = '$id'; ";
                if($conn->query($query)==TRUE)
                {
                    echo "User deleted!";
                }
                else
                {
                    echo "Error in deleting the data";
                }
            }
        ?>
        <br>
        <form class="form-inline justify-content-center" method = "POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="text" placeholder="unique ID" name="id" class="form-control mr-1"/>
            <button class="btn btn-danger" type="submit" name="delete">Delete user</button>
        </form>

        <?php
            #connection
            $con=mysqli_connect("localhost","root","","sportsclub");
            
            $q = "select user.id,user.fname,user.lname,user.dob,user.phone,user.email,user.address,user.city,user.state,user.pincode,user.sid,
            sports.sports_name,coach_details.coach_id,coach_details.coach_name 
            from user,sports,coach_details 
            where user.sid = sports.sports_id and sports.sports_name = coach_details.details; ";

            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $result = mysqli_query($con,$q);

            echo "<table style='text-align:center;border:3px solid grey;margin:auto;width:90%;' border='1'>
            <tr>
            <th>User ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Date of birth</th>
            <th>Phone no.</th>
            <th>Email ID</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Pincode</th>
            <th>Sports ID</th>
            <th>Sports name</th>
            <th>Coach ID</th>
            <th>Coach name</th>
            </tr>";

            while($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['lname'] . "</td>";
                echo "<td>" . $row['dob'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td>" . $row['state'] . "</td>";
                echo "<td>" . $row['pincode'] . "</td>";
                echo "<td>" . $row['sid'] . "</td>";
                echo "<td>" . $row['sports_name'] . "</td>";
                echo "<td>" . $row['coach_id'] . "</td>";
                echo "<td>" . $row['coach_name'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            mysqli_close($con);
        ?>

        <script src="adminNav"></script>
    </body>
</html>