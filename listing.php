<?php
    include_once 'header.php' ;
?>


        <section class="main-container">
            <div class="main-wrapper">
                <h2>Add New Listing</h2>
                <form class="signup-form" action="includes/signup-inc.php"
                      method="POST">
                    <input type="text" name="first_name" placeholder="First Name">
                    <input type="text" name="last_name" placeholder="Last Name">
                    <input type="text" name="email" placeholder="E-mail">
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" name="submit">Sign Up</button>
                </form>
            </div>
            
        </section>
    </body>
</html>

<?php
    include_once 'footer.php' ;
?>