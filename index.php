<?php
    include_once 'header.php' ;
?>


        <section class="main-container">
            <div class="main-wrapper">
                <h2>Home</h2>
                <?php
                    if (isset($_SESSION['u_id']))
                    {
                       echo "User details: ";
                       echo $_SESSION['u_first_name'];
                       echo $_SESSION['u_last_name'];
                       
                    }
                ?>
            </div>
            
        </section>
    </body>
</html>

<?php
    include_once 'footer.php' ;
?>


