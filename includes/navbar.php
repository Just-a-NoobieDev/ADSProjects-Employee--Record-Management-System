<nav class="bg-light shadow layout d-flex align-items-center w-100 nav-bar">
    <div class="wrapper">
        <div class="left" id="menu">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="30" height="30"
viewBox="0 0 30 30"
style=" fill:#000000;"><path d="M 3 7 A 1.0001 1.0001 0 1 0 3 9 L 27 9 A 1.0001 1.0001 0 1 0 27 7 L 3 7 z M 3 14 A 1.0001 1.0001 0 1 0 3 16 L 27 16 A 1.0001 1.0001 0 1 0 27 14 L 3 14 z M 3 21 A 1.0001 1.0001 0 1 0 3 23 L 27 23 A 1.0001 1.0001 0 1 0 27 21 L 3 21 z"></path></svg>
        </div>
        <div class="right">
            <h3 class="mt-2 user"><?php echo $_SESSION['username'] ?></h3>
            <form action="logout.php" method="POST"><button type="submit" class="btn btn-md btn-primary ">Logout</button></form>
        </div>
    </div>
</nav>