<?php  
include ("../misc/header.php"); 
include ("../core/dbsys.ini");
include_once ("../query/system.qry");

$sys = new SYSTEM();
$show_toast = ''; // Variable to hold toast message

if(isset($_POST['submit'])){
    // Collect user input from the form
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['cpassword'];
    $dept = $_POST['dept'];

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        $show_toast = "Passwords do not match. Please try again."; // Set toast message
    } else {
        // Call the signup function
        $response = $sys->signupUser($db, $name, $email, $dept, $password);
        
        // Check if the response indicates success
        if ($response === 'Signup successful') {
            // Redirect to the login page
            header("Location: login.php");
            exit(); // Ensure no further code is executed after redirect
        } else {
            $show_toast = $response; // Set the toast message if signup fails
        }
    }
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
<link href="../../plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
<link href="../../plugins/simplebar/simplebar.css" rel="stylesheet" />
<link href="../plugins/nprogress/nprogress.css" rel="stylesheet" />
<link id="main-css-href" rel="stylesheet" href="../css/style.css" />

<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-5 col-md-10 ">
                    <div class="card card-default mb-0">
                        <div class="card-header pb-0">
                            <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                                <a class="w-auto pl-0" href="login.php">
                                    <img src="../images/logo3.png" alt="Mono">
                                    <span class="brand-name text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <form id="signup-form" action="#" method="POST">
                            <div class="card-body px-5 pb-5 pt-0">
                                <h4 class="text-dark text-center mb-5">Sign Up</h4>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" class="form-control input-lg" id="username" name="username" placeholder="Username" required>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="email" class="form-control input-lg" id="email" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" class="form-control input-lg" id="dept" name="dept" placeholder="Department" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="password" class="form-control input-lg" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between mb-3"></div>
                                        <input type="submit" name="submit" class="btn btn-primary btn-pill mb-4" value="Sign Up">
                                        <p>Already have an account? <a class="text-blue" href="login.php">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="toast"></div> <!-- Toast for messages -->

    <script>
    $(document).ready(function() {
        // Function to display the toast message
        function showToast(message) {
            var toast = document.createElement('div');
            toast.className = 'custom-toast';
            toast.innerText = message;
            
            document.body.appendChild(toast);

            setTimeout(function() {
                toast.classList.add('visible');
            }, 100); // Slight delay to allow transition

            setTimeout(function() {
                toast.classList.remove('visible');
                setTimeout(function() {
                    document.body.removeChild(toast);
                }, 300); // Delay to remove the element after the fade-out
            }, 3000); // Display for 3 seconds
        }

        // Display toast if there's a message to show
        <?php if ($show_toast): ?>
            showToast("<?php echo $show_toast; ?>");
        <?php endif; ?>
    });
    </script>

</body>
