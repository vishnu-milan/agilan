<?php
echo heading("Welcome, " . $user['firstname'],3);
echo br(2);
echo anchor("agilan/edit_profile",'edit profile');
echo br();
echo anchor("agilan/index",'back home');
echo br();
echo anchor("agilan/logout",'logout');
?>