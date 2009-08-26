<?php
//needs threading for responses/etc


echo heading("Your Sent Messages",2);
echo anchor("messages/index", "inbox") . nbs(2) . "|" . nbs(2);
echo "sent" . nbs(2) . "|" . nbs(2);
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
		echo br();

		echo anchor("messages/archive_message/".$msg->id, "archive this"); 
		echo "<hr/>";
		echo br();	}

}else{
	echo "No messages in sent folder!";

}

?>