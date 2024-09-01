<?php include_once "header.php";
include_once "php/config.php";
session_start();

if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
$sql = mysqli_query($conn, "SELECT * FROM tblusers WHERE unique_id = '{$_SESSION['unique_id']}'");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
    }
?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <img src="php/img/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] ." ". $row['lname']; ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a>    
            </header>
            <div class="search">
                <span class="text">Search the user....</span>
                <input type="text" placeholder="Enter name">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                
            </div>
        </section>
    </div>
    <script src="javascript/users.js"></script>
</body>
</html>