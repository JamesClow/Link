<head>
    <script src="../sha512.js"></script>
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
    <div class="content flaoting-form">
        <div class="form">
            <h1 class="LINK">Link</h1>
            <h3>Login</h3>
            <?php 
                if(isset($_GET['error'])){
                    if($_GET['error'] == "invalid"){
                       echo '<div class="error">Invalid Username or Password</div>';
                    }else{
                        echo '<div class="error">'.$_GET['error'].'</div>';
                    }
                }
            ?>
            <form name="login" method="post" action="Link-Process-Login.php">
                Username: <input type="text" name="username" class="form-control"/><br>
                Password: <input type='text' name="password" class="form-control"/><br>
                <input type="button" class="btn btn-primary btn-block" value="Login" onclick="submitHashed(this.form, this.form.password)"/>
                <a href="Link-Home.php?register=true" class="btn btn-warning btn-block">New User</a>
            </form>
            <div class="guest">Guest Login { guest:password }</div>
        </div>
    </div>
</body>


