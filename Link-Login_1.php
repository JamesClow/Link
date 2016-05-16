<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Gallery.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
        <script src="./sha512.js"></script>
        <script>
            function submitHashed(form, password){
                var hashed = document.createElement("input");
                form.appendChild(hashed);
                hashed.name = "pass";
                hashed.type = "hidden";
                hashed.value = hex_sha512(password.value);
                password.value = ""
                form.submit();
            }
        </script>
    </head>
    <body>
        <div class="content form">
            <h3>Login</h3>
            <?php 
                if(isset($_GET['error'])){
                    if($_GET['error'] == "invalid"){
                       echo "<p>Invalid Username or Password</p>";
                    }
                }
            ?>
            <form name="login" method="post" action="Process_Login.php">
                Username: <input type="text" name="username"/><br>
                Password: <input type='text' name="password"/><br>
                Guest Login { test_user : test_password }<br>
                <input type="button" value="Login" onclick="submitHashed(this.form, this.form.password)"/>
            </form>
        </div>
    </body>
</html>

