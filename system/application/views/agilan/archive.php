<?php
echo heading("Your Archive",2);
echo anchor("messages/index", "inbox") . nbs(2) . "|" . nbs(2);
echo anchor("messages/sent", "sent") . nbs(2) . "|" . nbs(2);
echo "archives";

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
		
		if ($msg->from_id != $_SESSION['userid']){
			echo br();
			echo anchor("messages/respond/".$msg->id, "respond") . nbs(2) . "|" . nbs(2);
			echo anchor("messages/inbox_message/".$msg->id, "move to inbox"); 
		}
		echo "<hr/>";
		echo br();	}

}else{
	echo "No messages in archives!";

}

?>