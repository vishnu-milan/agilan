<?php
echo heading("Your Inbox",2);
echo "inbox" . nbs(2) . "|" . nbs(2);
echo anchor("messages/sent", "sent") . nbs(2) . "|" . nbs(2);
echo anchor("messages/archive", "archives");

echo br(2);
if (count($messages)){
	foreach ($messages as $key => $msg){
		echo "Subject: <b>". $msg->subject ."</b>";
		echo br();
		echo "From: ". $usernames[$msg->from_id];
		echo br();
		echo "To: ". $usernames[$msg->to_id];
		echo br();
		echo "Sent: ". $msg->created;
		echo br();
		echo auto_typography($msg->message);
		echo "<hr/>";
	}

}else{
	echo "No messages in inbox!";

}
?>