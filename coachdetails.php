<html>
    <head>
        <title>Sports details</title>
        <link rel="stylesheet" type="text/css" href="bootstrap.css">
        <link rel="stylesheet" type="text/css" href="adminPage.css">
    </head>
    <body>
        <nav id="adminNav"></nav>
        <?php
            #connection
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $db = 'sportsclub';
            $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
            if(! $conn ) 
            {
                die('Could not connect: ' . mysql_error());
            }
            #retreiving values from the form-------------------------------------------------------
            $cid = $cname = $details = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                $cid = $_POST["cid"];
                $cname = $_POST["cname"];
                $details = $_POST["details"];
            }
            if(isset($_POST['submit'])) 
            {
                #inserting values into the db-----------------------------------------------------
                $query="insert into coach_details (coach_id,coach_name,details) values ('$cid','$cname','$details') ";
                if($conn->query($query)==TRUE)
                {
                    echo "Coach added!";
                }
                else
                {
                    echo "Error in adding the data";
                }
            }
            #deleting data-----------------------------------------------------------------------
            if(isset($_POST['delete']))
            {
                $query="delete from coach_details where coach_id = '$cid'; ";
                if($conn->query($query)==TRUE)
                {
                    echo "Coach removed!";
                }
                else
                {
                    echo "Error in deleting the data";
                }
            }
        ?>
        <br>
        <form class="form-inline justify-content-center"  method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text"  placeholder="coach id" name="cid" class="form-control mr-1" />
            <input type="text" placeholder="coach name" name="cname" class="form-control mr-1"/>
            <input type="text" placeholder="sports name" name="details" class="form-control mr-1"/>
            <button type="submit" name="submit" class="btn btn-success mr-1" >Add coach</button>
            <button type="submit" name="delete" class="btn btn-danger">Remove coach</button>
        </form>

        <?php
        $con=mysqli_connect("localhost","root","","sportsclub");
        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $result = mysqli_query($con,"SELECT * FROM coach_details");

        echo "<table style='text-align:center;border:3px solid grey;margin:auto;width:70%;' border='1'>
        <tr>
        <th>Coach ID</th>
        <th>Coach name</th>
        <th>Details</th>
        </tr>";

        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['coach_id'] . "</td>";
            echo "<td>" . $row['coach_name'] . "</td>";
            echo "<td>" . $row['details'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($con);
        ?>
        <br>
        <script src="adminNav.js"></script>
    </body>
</html>