<?php
function request($jsondata){
	global $accessToken;
	$url = "https://graph.facebook.com/v2.9/me/messages?access_token=$accessToken";
	$ch  = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json'
	));
	curl_exec($ch);
}
function requestInsert($jsondata){
	global $accessToken;
	$url = "https://graph.facebook.com/v2.9/me/messenger_profile?access_token=$accessToken";
	$ch  = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json'
	));
	curl_exec($ch);
}
function requestDelete($jsondata){
	global $accessToken;
	$url = "https://graph.facebook.com/v2.9/me/messenger_profile?access_token=$accessToken";
	$ch  = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json'
	));
	curl_exec($ch);
}
function sendMessageText($receiver, $content){
	$payload = '
	{
		"recipient": {
			"id":"' . $receiver . '"
		},
		"message": {
			"text":"' . $content . '"
		}
	}';
	request($payload);
}
function sendMessageImage($receiver, $url){
	$payload = '
	{
		"recipient": {
			"id":"' . $receiver . '"
		},
		"message": {
			"attachment":{
				"type":"image",
				"payload":{
					"url":"' . $url . '"
				}
			}
		}
	}';
	request($payload);
}
function sendMessageAudio($receiver, $url){
	$payload = '
	{
		"recipient": {
			"id":"' . $receiver . '"
		},
		"message": {
			"attachment":{
				"type":"audio",
				"payload":{
					"url":"' . $url . '"
				}
			}
		}
	}';
	request($payload);
}
function sendMessageFile($receiver, $url){
	$payload = '
	{
		"recipient": {
			"id":"' . $receiver . '"
		},
		"message": {
			"attachment":{
				"type":"file",
				"payload":{
					"url":"' . $url . '"
				}
			}
		}
	}';
	request($payload);
}
function sendMessageVideo($receiver, $url){
	$payload = '
	{
		"recipient": {
			"id":"' . $receiver . '"
		},
		"message": {
			"attachment":{
				"type":"video",
				"payload":{
					"url":"' . $url . '"
				}
			}
		}
	}';
	request($payload);
}
function MessageNoti($receiver, $content, $sub){
	$payload = '
	{
		"recipient": {
			"id": "' . $receiver . '"
		},
		"message":{
			"attachment":{
				"type": "template",
				"payload": {
					"template_type": "generic",
					"elements": [
						{
							"title": "' . $content . '",
							"subtitle": "' . $sub . '",
						}
					]
				}
			}
		}
	}';
	request($payload);
}
function RelationshipNO($receiver){
	sendTypingOn($receiver);
	MessageNoti($receiver, "Bạn Chưa Ngắt Kết Nối", "Bạn cần ngắt kết nối với người lạ hiện tại mới có thể bắt đầu.");
}
function notRelationship($receiver){
	sendTypingOn($receiver);
	MessageNoti($receiver, "Bạn Chưa Kết Nối", "Bạn chưa kết nối với người lạ nào cả nên làm sao mà kết thúc được.");
}
function findRelationshipc($receiver){
	sendTypingOn($receiver);
	MessageNoti($receiver, "Đang Tìm", "Vẫn đang tìm thính cho bạn đây. Bình tĩnh đợi nhé!");
}
function MessageHuongDan($receiver){
	sendTypingOn($receiver);
	$payload = '
	{
		"recipient": {
			"id":"' . $receiver . '"
		},
		"message": {
			"text":"Xin chào ^^ \nT-Thính Thơm được tạo ra nhằm mục đích tạo nơi cho các bạn trò chuyện, thả thính, làm quen, tán gẫu... hoàn toàn ẩn danh. Đối phương sẽ không biết bạn là ai trừ khi bạn nói :) \nĐể Sử Dụng Bạn Vui Lòng Chọn Vào Menu Bên Trái Khung Chat:\n[Thao Tác]->[Bắt Đầu Thả Thính] - Để Tìm Người Tám\n[Thao Tác]->[Ngừng Thả Thính] - Để Kết Thúc Cuộc Trò Chuyện Hiện Tại\nHoặc Thể Dùng Từ Khóa Nhanh:\n@start - Để Tìm Người Tám\n@stop - Để Kết Thúc Cuộc Trò Chuyện Hiện Tại."
		}
	}';
	request($payload);
}
function MessageHome($receiver){
	sendTypingOn($receiver);
	$payload = '
	{
		"recipient": {
			"id": "' . $receiver . '"
		},
		"message":{
			"attachment":{
				"type": "template",
				"payload": {
					"template_type": "generic",
					"elements": [
						{
							"title": "Thính Thơm",
							"subtitle": "Bả không phải Thính",
							"item_url": "http://Nghĩa.Vn",
							"image_url": "http://giaitri.danongonline.com.vn/wp-content/uploads/2016/11/1-1479377234390.jpg",
							"buttons": [
								{
									"type": "postback",
									"title": "Bắt Đầu Thả Thính",
									"payload": "start",
								},
								{
									"type": "postback",
									"title": "Ngừng Thả Thính",
									"payload": "stop",
								},
								{
									"type": "postback",
									"title": "Hướng Dẫn Sử Dụng",
									"payload": "huongdan",
								}
							]
						}
					]
				}
			}
		}
	}';
	request($payload);
}

function sendTypingOn($receiver){
	$payload = '
	{
		"recipient": {
			"id": "' . $receiver . '"
		},
		"sender_action":"typing_on"
	}';
	request($payload);
}
function sendTypingOff($receiver){
	$payload = '
	{
		"recipient": {
			"id": "' . $receiver . '"
		},
		"sender_action":"typing_off"
	}';
	request($payload);
}
function sendQuickReply($receiver, $content){
	$payload = '
	{
		"recipient": {
			"id": "' . $receiver . '"
		},
		"message":{
			"text":"' . $content . '",
			"quick_replies":[
				{
					"content_type":"text",
					"title":"Kết Thúc",
					"payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_RED"
				}
			]
		}
	}';
	request($payload);
}

function isUser($userid){
	global $conn;
	$result = mysqli_query($conn, "SELECT * from nguoidung WHERE userID = $userid");
	$num    = mysqli_num_rows($result);
	if ($num > 0)
		return true;
	else {
		mysqli_query($conn, "INSERT INTO nguoidung (userID) VALUES ($userid)");
		return false;
	}
}
function checkUser($userid){
	global $conn;
	$result = mysqli_query($conn, "SELECT * from users WHERE id = $userid LIMIT 1");
	$row    = mysqli_num_rows($result);
	return $row;
}

function checkStatus($userid){
	global $conn;
	$result = mysqli_query($conn, "SELECT status from users WHERE id = $userid");
	$row    = mysqli_fetch_assoc($result);
	$status = intval($row['status']);
	return $status;
}

function getRelationship($userid){
	global $conn;
	$result       = mysqli_query($conn, "SELECT relationship from users WHERE id = $userid");
	$row          = mysqli_fetch_assoc($result);
	$relationship = $row['relationship'];
	return $relationship;
}

function addRelationship($user1, $user2){
	global $conn;
	mysqli_query($conn, "UPDATE users SET status = 2, relationship = $user2 WHERE id = $user1");
	mysqli_query($conn, "UPDATE users SET status = 2, relationship = $user1 WHERE id = $user2");
}

function deleteRelationship($userid){
	global $conn;
	$partner = getRelationship($userid);
	mysqli_query($conn, "UPDATE users SET status = 0, relationship = NULL WHERE id = $userid");
	mysqli_query($conn, "UPDATE users SET status = 0, relationship = NULL WHERE id = $partner");
	MessageNoti($userid, "Bạn đã rời khỏi cuộc trò chuyện.", "Like page để cập nhật tin tức về DUT-T nha! ﾍ(￣▽￣*)ﾉ ♪♪");
	MessageNoti($partner, "Người lạ đã rời khỏi cuộc trò chuyện.", "Like page để cập nhật tin tức về DUT-T nha! ﾍ(￣▽￣*)ﾉ ♪♪");
}

function addUser($userid){
	global $conn;
	mysqli_query($conn, "INSERT INTO users (id, status) VALUES ($userid, 0)");
}

function forwardMessage($userid, $msg){
	$partner = getRelationship($userid);
	if ($partner != NULL) {
		if ($msg['text']) {
			sendMessageText($partner, $msg['text']);
			//sendQuickReply($partner);
		} else {
			switch ($msg['attachments'][0]['type']) {
				case 'image':
					sendMessageImage($partner, $msg['attachments'][0]['payload']['url']);
					break;
				case 'audio':
					sendMessageAudio($partner, $msg['attachments'][0]['payload']['url']);
					break;
				case 'file':
					sendMessageFile($partner, $msg['attachments'][0]['payload']['url']);
					break;
				case 'video':
					sendMessageVideo($partner, $msg['attachments'][0]['payload']['url']);
					break;
				default:
					sendMessageText($partner, "Hệ thống đang gặp lỗi. Bạn thông cảm về sự cố này");
					break;
			}
		}
	}
}

function findRelationship($userid){
	global $conn;
	$result  = mysqli_query($conn, "SELECT id FROM users WHERE status = 1 AND id != $userid ORDER BY RAND() LIMIT 1");
	$row     = mysqli_fetch_assoc($result);
	$partner = $row['id'];
	mysqli_query($conn, "UPDATE users SET status = 1 WHERE id = $userid");
	if (!$partner) {
		MessageNoti($userid, "Đang Tìm...", "Chờ chút nha.");
	} else {
		addRelationship($userid, $partner);
		MessageNoti($userid, "Đã Tìm Thấy Đối Tượng", "Thả thính đi nào ♥♥♥ (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧");
		MessageNoti($partner, "Đã Tìm Thấy Đối Tượng", "Thả thính đi nào ♥♥♥ (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧");
	}
}
?>