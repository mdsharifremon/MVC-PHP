<?php

foreach($data['users'] as $user ){
    echo "ID : ".  $user->user_id . " Name  : " . $user->user_name . "  Email : " . $user->user_email . "  Password : " . $user->password . "<br>";
}


?>