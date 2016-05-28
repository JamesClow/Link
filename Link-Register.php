<head>
    <script src="../sha512.js"></script>
    <script>
        function submitHashed(form, username, email, password, confirm){
            if(username.value == '' || email == '' || password == '' || confirm == ''){
                alert("Feild missing");
                return false;
            }
            userRegex = /^\w+$/;
            if(! userRegex.test(username.value)){
                alert("Username can contain only letters, numbers and underscores");
                form.username.focus();
                return false;
            }
            if(password.value != confirm.value){
                alert("passwords do not match");
                form.confirm-password.focus();
                return false;
            }
            if(password.value.length < 6){
               alert("password must be longer than 6 characters");
               form.password.focus();
               return false;
            }
            
            var hashed = document.createElement("input");
            form.appendChild(hashed);
            hashed.name = "pass";
            hashed.type = "hidden";
            hashed.value = hex_sha512(password.value);
            password.value = "";
            confirm.value = "";
            form.submit();
            return true;
        }
    </script>
</head>
<body>
    <div class="content flaoting-form">
        <div class="form">
            <h1 class="LINK">Link</h1>
            <h3>Register</h3>
            <?php 
            if(isset($_GET['error'])){
                echo '<div class="error">'.$_GET['error'].'</div>';    
            }
            ?>
            <form id="resistation" name="registration-form" method="post" action="Link-Process-Registration.php">
                Username: <input type="text" name="username" class="form-control"><br>
                Email: <input type="text" name="email" class="form-control"><br>
                Password: <input type="password" name="password" class="form-control"><br>
                Confirm Password: <input type="password" name="confirm_password" class="form-control"><br>
                <input type="button" class="btn btn-primary btn-block" value="Sumbit" onclick="submitHashed(this.form, this.form.username, this.form.email, this.form.password, this.form.confirm_password)"/>
            </form>
            <a href="Link-Home.php">Back to Login</a>
        </div>
    </div>
</body>
