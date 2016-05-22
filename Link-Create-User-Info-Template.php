<html>
    <head>
        <script>
            bouldering = document.getElementById('bouldering');
            sport = document.getElementById('sport');
            trad = document.getElementById('trad');
            
            bouldering_grade = document.getElementById('bouldering-grade');
            sport_grade = document.getElementById('sport-grade');
            trad_grade = document.getElementById('trad-grade');
            

        </script>
    </head>
    <body>
        <form id="user_info" method ="post" action="Link-Process-User-Info.php">
            zipcode: <input type="text" name="zipcode"><br>
            What type of climbing do you most often: 
                <input type="checkbox" id="bouldering" name="bouldering">Bouldering
                <select id="bouldering_grade" name="bouldering_grade">
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
                </select>
                <input type="checkbox" id="sport" name="sport">Sport
                <select id="sport_grade" name="sport_grade">
                    <option value="5.8">5.8</option>
                    <option value="5.9">5.9</option>
                    <option value="5.10">5.10</option>
                    <option value="5.11">5.11</option>
                    <option value="5.12">5.12</option>
                    <option value="5.13">5.13</option>
                    <option value="5.14">5.14</option>
                    <option value="5.15">5.15</option>
                </select>
                <input tpye="checkbox" id="trad" name="trad">Trad 
                <select id="trad_grade" name="trad_grade">
                    <option value="5.8">5.8</option>
                    <option value="5.9">5.9</option>
                    <option value="5.10">5.10</option>
                    <option value="5.11">5.11</option>
                    <option value="5.12">5.12</option>
                    <option value="5.13">5.13</option>
                    <option value="5.14">5.14</option>
                    <option value="5.15">5.15</option>
                </select>
            
        </form>
    </body>
</html>