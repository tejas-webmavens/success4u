<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ARMCIP Intallation</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
    <link href="css/font-awesome.css" type="text/css" rel="stylesheet" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300|Merriweather' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Coda:400,800' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="js/jquery.min.js" ></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </head>
<body>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('max_execution_time', 300);
  if (!empty($_POST)){
    $file = '../config.php';
    
    $contents = "<?php \n";
    $contents .= "//Database details \n";
    $contents .= "define ('DB_HOST', '".$_POST['dbHost']."'); \n";
    $contents .= "//Username \n";
    $contents .= "define ('DB_USERNAME', '".$_POST['dbUserName']."'); \n";
    $contents .= "//Pass \n";
    $contents .= "define ('DB_PASS', '".$_POST['dbPass']."'); \n";
    $contents .= "//Database Name \n";
    $contents .= "define ('DB_NAME', '".$_POST['dbName']."'); \n";
    $contents .= "//Base URL \n";
    $contents .= "define ('BASE_URL', '".$_POST['siteURL']."'); \n";
    $contents .= "?>";  
  
    $mysql_host = $_POST['dbHost'];
    $mysql_username = $_POST['dbUserName'];
    $mysql_password = $_POST['dbPass'];
    $mysql_database = $_POST['dbName'];

    // Name of the file
    $filename = 'install.php';
    
    


    // Connect to MySQL server
    mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
    
    $con = mysqli_connect($mysql_host, $mysql_username, $mysql_password);
    
   

    // Select database
    mysqli_select_db($con, $mysql_database) or die('Error selecting MySQL database: ' . mysql_error());


    // $MyFile = file($filename);
    // foreach (explode(";\n", $MyFile) as $MyFile) {
    //   $MyFile = trim($MyFile);

    //   if ($MyFile) {
    //     $import_status = mysql_query($MyFile) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    //   }
    // }

    $sql = '';
    // Read in entire file
    $lines = file($filename);

    // Loop through each line

    foreach($lines as $line) {
      if ($line && (substr($line, 0, 2) != '--') && (substr($line, 0, 1) != '#')) {
        $sql .= $line;

        if (preg_match('/;\s*$/', $line)) {
          $sql = str_replace("DROP TABLE IF EXISTS ", "DROP TABLE IF EXISTS ", $sql);
          $sql = str_replace("CREATE TABLE ", "CREATE TABLE ", $sql);
          $sql = str_replace("INSERT INTO ", "INSERT INTO ", $sql);
          mysqli_query($con, $sql);

          $sql = '';
        }
      }
    }

    $myfile = fopen($file, "w+") or die("Unable to open file!");
    
    fwrite($myfile, $contents);
    
    fclose($myfile);

    // file_put_contents($file, $contents);

    // The function automatically generates a cryptographically safe salt.
    //$hashToStoreInDb = password_hash($password, PASSWORD_BCRYPT);

    // Check if the hash of the entered login password, matches the stored hash.
    //$isPasswordCorrect = password_verify($password, $existingHashFromDb);

    // Create connection
    $conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "UPDATE arm_members SET Email = '".$_POST['adminEmail']."', UserName = '".$_POST['LoginName']."', Password='".sha1(sha1($_POST['LoginPassword']))."', UserType='1' WHERE MemberId = '1'";

    // $sql = "UPDATE arm_members SET siteTitle='".$_POST['siteName']."' WHERE siteID=0";

    if ($conn->query($sql) === TRUE) {
      // admin inserted
      // header('Location: '.BASE_URL);
      ?>
      
      <script language="javascript">
        window.location.href = "<?php echo $_POST['siteURL'];?>/install/success";
      </script>
    <?php
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error; 
    }

  $conn->close();
}
$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$site_url = str_replace('/install/index.php', '', $actual_link);
?>


<div id="wrapper">
  <div class="header">
    <div class="content">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="logo"> <a href=""><img src="images/logo.png" class="img-responsive"/></a> </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Installation wizard - ARM MLM</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="main">
    <p class="para">Please fill out the information below to continue your ARM MLM. All fields are required</p>
    <div class="content">
      <div class="row install" id="install_row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <form method="post" action="" id="installation" novalidate="novalidate">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                <div class="cntct-right-top"><h4>Installation Info</h4></div>
                <div class="heading"> <img src="images/icon03.png" width="40" /> Site Settings</div>
                <div class="col-lg-12 ">
                  <div class="form-group ">
                    <input type="text" class="form-control" name="siteName" id="siteName" placeholder="Site Name">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="siteURL" value="<?php echo $site_url;?>" id="siteURL" placeholder="Site URL">
                  </div>
                  <div class="form-group ">
                    <input type="email" class="form-control" name="adminEmail" id="adminEmail" placeholder="Email">
                  </div>
                  <div class="form-group ">
                    <input type="text" class="form-control" name="LoginName" id="LoginName" placeholder="Username">
                  </div>
                  <div class="form-group ">
                    <input type="password" class="form-control" name="LoginPassword" id="LoginPassword" placeholder="Password">
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="heading"> <img src="images/icon01.png" width="40" /> Data Base Settings</div>
                <div class="col-lg-12 ">
                  <div class="form-group">
                    <input type="text" class="form-control" name="dbHost" id="dbHost" placeholder="Host Name">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="dbUserName" id="dbUserName" placeholder="Database UserName">
                  </div>
                  <div class="form-group ">
                    <input type="password" class="form-control" name="dbPass" id="dbPass" placeholder="Database Password">
                  </div>
                  <div class="form-group ">
                    <input type="text" class="form-control" name="dbName" id="dbName" placeholder="Database Name">
                  </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
              <div class="text-center "> <button class="submit" id="btn-install" onclick="installFunc()">Send</button> </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row success_install" style="display:none;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
            <div class="cntct-right-top text-center"><h4>Success! Installation complete</h4></div>
            <div class="heading"> 
              <img src="images/icon03.png" width="40" /> Ready to start!
            </div>
            <div class="col-sm-5 col-sm-offset-1 text-center">
              <p><i class="fa fa-group fa-5x"></i></p>
              <a class="submit" href="../">user</a>
              <p>Go to your Online Shop</p>
            </div>

            <div class="col-sm-5 text-center">
              <p><i class="fa fa-cog fa-5x white"></i></p>
              <a class="submit" href="../admin/">admin</a>
              <p>Login to your Administration</p>
            </div>
          </div>
        </div>
      </div>
     
    </div>
  </div>
</div>
</body>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery.validate.min.js"></script>
  
  <!-- jQuery Form Validation code -->
  <script>
  function installFunc() {
     if ($('#installation').valid()) {
      $('#btn-install').attr('disabled','disabled');
      $('#installation').submit();
    }
  }
  // When the browser is ready...
  $(function() {
  $('#btn-install').attr('disable');
    // Setup form validation on the #register-form element
    $("#installation").validate({

        errorClass: "text-danger",
        validClass: "text-success",
    
        // Specify the validation rules
        rules: {
            siteName: "required",
            siteURL: {
              required: true
            },
            adminEmail: {
                required: true,
                email: true
            },
            LoginName: {
                required: true,
                minlength: 5
            },
            LoginPassword: {
                required: true,
                minlength: 6
            },
            dbHost: "required",
            dbUserName: "required",
            dbName: "required"
        },
        
        // Specify the validation error messages
        messages: {
            siteName: "Please enter site name",
            siteURL: {
              required: "Please enter site URL"
            },
            adminEmail: {
                required: "Please provide a email",
                email: "Please enter valid email"
            },
            LoginName: {
                required: "Please provide admin login name",
                minlength: "Your loginname must be at least 5 characters long"
            },
            LoginPassword: {
                required: "Please provide admin login password",
                minlength: "Your password must be at least 6 characters long"
            },
            dbHost: "Please enter database host name",
            dbUserName: "Please enter database user name",
            dbName: "Please enter database name"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
 
  </script>
</html>
