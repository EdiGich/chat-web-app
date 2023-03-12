<?php
session_start();
if(isset($_SESSION['unique_id'])){ //if user is logged in.
    header("location: users.php");
}
?>
<?php include_once "header.php"; ?>
    <body>
        <div class="wrapper">
            <section class="form signup">
                <header>Real Time Chat App</header>
                <form action="POST" enctype="multipart/form-data"><!-- Do not forget to add enctype="multipart/form-data" if your inpu type is file.-->
                    <div class="error-txt"></div>
                    <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                    <div class="field input">
                        <label>Email address</label>
                        <input type="text" name="email" placeholder="Enter your Email Address" required>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your Password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field image">
                        <label>select Image</label>
                        <input type="file" name="image" required>
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continue to Chat">
                    </div>
                    </div>
                    <p>Edwin is learning on better programming skills</p>
                </form>
                <div class="link">Already signed up? <a href="login.php">Login Now</a> </div>
            </section>
        </div>
<script src="javascript/pass-show-hide.js"></script>
<script src="javascript/signup.js"></script>

    </body>
