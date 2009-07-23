<?php
echo heading("Here are your login credentials....",2);
echo "<p>Username: " . $_SESSION['username'] . "<br/>";
echo "Password: " . $_SESSION['random_pw'] . "</p>";

echo br(2);
echo anchor("welcome/index", "Login now.");

?>