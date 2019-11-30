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
            
            if(! $conn ) {
            die('Could not connect: ' . mysql_error());
            }
            #---------------------------------------------------------------------------------------
            #retreiving values from the form
            $sid = $sname = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                $sid = $_POST["sid"];
                $sname = $_POST["sname"];
            }
            if(isset($_POST['submit'])) 
            {
                #-------------------------------------------------------------------------------------------
                #inserting values into the db
                $query="insert into sports (sports_id,sports_name) values ('$sid','$sname') ";
                if($conn->query($query)==TRUE)
                {
                    echo "Sports added!";
                }
                else
                {
                    echo "Error in adding the data";
                }
            }
            if(isset($_POST['delete']))
            {
                $query="delete from sports where sports_id = '$sid'; ";
                if($conn->query($query)==TRUE)
                {
                    echo "Sports deleted!";
                }
                else
                {
                    echo "Error in deleting the data";
                }
            }
        ?>
        <br>
        <form class="form-inline justify-content-center" method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" placeholder="sports id" name="sid" class="form-control mr-1"/>
            <input type="text" placeholder="sports name" name="sname" class="form-control mr-1"/>
            <button type="submit" name="submit" class="btn btn-success mr-1" >Add sports</button>
            <button type="submit" name="delete" class="btn btn-danger">Delete sports</button>
        </form>

        <?php
        $con=mysqli_connect("localhost","root","","sportsclub");
        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $result = mysqli_query($con,"SELECT * FROM sports");

        echo "<table style='text-align:center;border:3px solid grey;margin:auto;width:70%;'  border='1'>
        <tr>
        <th>Sports ID</th>
        <th>Sports name</th>
        </tr>";

        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['sports_id'] . "</td>";
            echo "<td>" . $row['sports_name'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($con);
        ?>
        <br>
        <script src="adminNav.js"></script>
    </body>
</html>