<?php
    $user_request = $mysqli->prepare('SELECT city, zip, boulder, sport, trad, bio FROM members WHERE id=? LIMIT 1');
    $user_request->bind_param('i', $_SESSION['user_id']);
    $user_request->execute();
    $user_request->store_result();
    $user_request->bind_result($city, $zip, $boulder, $sport, $trad, $bio);
    if ($user_request->num_rows == 1){
        while($user_request->fetch()){
        ?>
            <head>
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
            <form id="user_info" method ="post" action="Link-Process-User-Info.php">
                City: <input type="text" name="city" value="<?php echo $city; ?>" class="form-control"><br>
                Zipcode: <input type="text" name="zipcode" value="<?php echo $zip; ?>" class="form-control"><br>
                What type of climbing do you most often:<br><br>
                <table>
                    <tr>
                        <td>
                            Bouldering
                        </td>
                        <td>
                            <input type="checkbox" id="bouldering" name="bouldering">
                        </td>
                        <td>
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
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Sport 
                        </td>
                        <td>
                            <input type="checkbox" id="sport" name="sport">
                        </td>
                        <td>
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
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Trad 
                        </td>
                        <td>
                            <input type="checkbox" id="trad" name="trad">
                        </td>
                        <td>
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
                            </select>
                        </td>
                    </tr>
                </table><br>
                About yourself: <textarea name="bio" form="user_info" class="form-control" rows="3"><?php echo $bio; ?></textarea><br>
                <input type="button" class="btn btn-primary btn-block" value="Save" onclick="submitUserBio(this.form)"/>
            </form>
        <?php
        }
    }


?>
