<?php
echo heading("Your Inbox",2);
echo "inbox" . nbs(2) . "|" . nbs(2);
echo anchor("messages/sent", "sent") . nbs(2) . "|" . nbs(2);
echo anchor("messages/archive", "archives");


echo "<pre>";
print_r($messages);

?>