    <?php
        #connection and retrieving admin info
        if(isset($_POST['loginButton'])) 
        {
            ob_start();
            session_start();
            //Login button was pressed
            $id = $_POST['id'];
            $password = $_POST['psw'];

            $con = mysqli_connect("localhost", "root", "", "sportsclub");
        
            $pw = md5($password);

            $res=mysqli_query($con,"SELECT * FROM `login` WHERE `id`= $id AND `password`=$pw;");
            // if(!$res)
            if($id == 'admin@sportsclub.com' && $password == 'iamadmin')
            {
                
                echo "login done successfully";
                $_SESSION['userLoggedIn'] = "$id";
                header('Location: /sportsClub/adminPage.html');
            }
            if($id != 'admin@sportsclub.com' || $password != 'iamadmin')
            {
                header('Location: /sportsClub/index.html');
            }
        }
    ?>