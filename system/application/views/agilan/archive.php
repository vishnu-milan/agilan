<?php
echo heading("Your Archive",2);
echo anchor("messages/index", "inbox") . nbs(2) . "|" . nbs(2);
echo anchor("messages/sent", "sent") . nbs(2) . "|" . nbs(2);
echo "archives";

echo "<pre>";
print_r($messages);

?>