<?php
echo heading("Your Sent Messages",2);
echo anchor("messages/index", "inbox") . nbs(2) . "|" . nbs(2);
echo "sent" . nbs(2) . "|" . nbs(2);
echo anchor("messages/archive", "archives");

echo "<pre>";
print_r($messages);

?>