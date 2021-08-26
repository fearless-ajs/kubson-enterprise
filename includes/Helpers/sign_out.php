<?php
require_once("../../includes/Helpers/initialize.php");
//checking if the user is logged in with the constructor
            $login_user = new LoginControl();
            
            //Logout the user
            $login_user->logoutUser();
            
