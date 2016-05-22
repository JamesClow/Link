<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="Link-Style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script>
            function submitUserBio(form){
                if(form.city.value == '' || form.zipcode.value == ''){
                    alert("You must include your home city and zipcode");
                    return false;
                }
                form.submit();
                return true;
            }
        </script>
    </head>
    <body>
        <form id="user_info" method ="post" action="Link-Process-User-Info.php">
            city: <input type="text" name="city"><br>
            zipcode: <input type="text" name="zipcode"><br>
            What type of climbing do you most often:<br>
                <input type="checkbox" id="bouldering" name="bouldering">Bouldering
                <select id="bouldering_grade" name="bouldering_grade">
                    <option value="null">select grade</option>
                    <option value="V0">V0</option>
                    <option value="V1">V1</option>
                    <option value="V2">V2</option>
                    <option value="V3">V3</option>
                    <option value="V4">V4</option>
                    <option value="V5">V5</option>
                    <option value="V6">V6</option>
                    <option value="V7">V7</option>
                    <option value="V8">V8</option>
                    <option value="V9">V9</option>
                    <option value="V10">V10</option>
                    <option value="V11">V11</option>
                    <option value="V12">V12</option>
                    <option value="V13">V13</option>
                    <option value="V14">V14</option>
                    <option value="V15">V15</option>
                </select><br>
                <input type="checkbox" id="sport" name="sport">Sport
                <select id="sport_grade" name="sport_grade">
                    <option value="null">select grade</option>
                    <option value="5.8">5.8</option>
                    <option value="5.9">5.9</option>
                    <option value="5.10">5.10</option>
                    <option value="5.11">5.11</option>
                    <option value="5.12">5.12</option>
                    <option value="5.13">5.13</option>
                    <option value="5.14">5.14</option>
                    <option value="5.15">5.15</option>
                </select><br>
                <input type="checkbox" id="trad" name="trad">Trad 
                <select id="trad_grade" name="trad_grade">
                    <option value="null">select grade</option>
                    <option value="5.8">5.8</option>
                    <option value="5.9">5.9</option>
                    <option value="5.10">5.10</option>
                    <option value="5.11">5.11</option>
                    <option value="5.12">5.12</option>
                    <option value="5.13">5.13</option>
                    <option value="5.14">5.14</option>
                    <option value="5.15">5.15</option>
                </select><br>
                Short description about yourself: <textarea name="bio" form="user_info" class="form-control" rows="3"></textarea>
                <input type="button" value="Sumbit" onclick="submitUserBio(this.form)"/>
        </form>
    </body>
</html>