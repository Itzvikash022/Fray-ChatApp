<?php 
session_start();
if(isset($_SESSION['unique_id'])){
    header("location: users.php");
}

include_once "header.php" ?>

<body>
    <div class="wrapper">
        <section class="form login">
            <header>Chat App</header>
            <form action="#">
                <div class="error-txt"></div>
               
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Email Address">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password">
                    <i class="fas fa-eye"></i>
                </div>
                
                <div class="field btn">
                    <input type="button" value="Login">
                </div>
            </form>
            <div class="link">Not yet Signed up <a href="index.php">SignUp now</a></div>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
</body>
</html>