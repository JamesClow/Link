<?php
    function secure_session_start() {
        $session_name = 'sec_session_id';
        $secure = false;
        $httponly = true;
        ini_set('session.use_only_cookies', 1);
        $cookiePamrams = session_get_cookie_params();
        session_set_cookie_params($cookiePamrams['lifetime'],$cookiePamrams["path"],$cookiePamrams['domain'],$secure,$httponly);
        session_name($session_name);
        session_start();
        session_regenerate_id(true);   
    }