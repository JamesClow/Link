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
    <?php 
    if(isset($_GET['message'])){
        echo $_GET['message'];    
    }
    ?>
    <form id="resistation" name="registration-form" method="post" action="Link-Process-Registration.php">
        Username: <input type="text" name="username"><br>
        Email: <input type="text" name="email"><br>
        Password: <input type="password" name="password"><br>
        Confirm Password: <input type="password" name="confirm_password"><br>
        <input type="button" value="Sumbit" onclick="submitHashed(this.form, this.form.username, this.form.email, this.form.password, this.form.confirm_password)"/>
    </form>
    <a href="Link-Login.php">Back to Login</a>
</body>
