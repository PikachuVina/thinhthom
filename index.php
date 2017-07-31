<?php
require_once('config.php');
require_once('myfunc.php');
if (isset($_GET['hub_verify_token'])) {
	if ($_GET['hub_verify_token'] === $verifyToken) {
		die($_GET['hub_challenge']);
	}
	die('Mã Xác Nhận Không Hợp Lệ');
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['entry'][0]['messaging'][0]['sender']['id'])) {
	$sender = $data['entry'][0]['messaging'][0]['sender']['id'];
}

if ($data['entry'][0]['messaging'][0]['message']) {
	$message = $data['entry'][0]['messaging'][0]['message'];
	if (strtolower($message['text']) === "menu") {
		MessageHome($sender);
	} elseif (strtolower($message['text']) === "@start") {
		if (checkUser($sender)) {
			if (checkStatus($sender) === 2) {
				RelationshipNO($sender);
			} elseif (checkStatus($sender) === 1) {
				findRelationshipc($sender);
			} else {
				findRelationship($sender);
			}
		} else {
			addUser($sender);
			findRelationship($sender);
		}
	} elseif (strtolower($message['text']) === "@stop") {
		if (checkUser($sender)) {
			if (checkStatus($sender) === 0) {
				notRelationship($sender);
			} else {
				deleteRelationship($sender);
			}
		} else {
			notRelationship($sender);
		}
	} else
		forwardMessage($sender, $message);
}

if (isset($data['entry'][0]['messaging'][0]['postback']['payload'])) {
	$postback = $data['entry'][0]['messaging'][0]['postback']['payload'];
	if ($postback === "start") {
		if (checkUser($sender)) {
			if (checkStatus($sender) === 2) {
				RelationshipNO($sender);
			} elseif (checkStatus($sender) === 1) {
				findRelationshipc($sender);
			} else {
				findRelationship($sender);
			}
		} else {
			addUser($sender);
			findRelationship($sender);
		}
	}
	if ($postback === "stop") {
		if (checkUser($sender)) {
			if (checkStatus($sender) === 0) {
				notRelationship($sender);
			} else {
				deleteRelationship($sender);
			}
		} else {
			notRelationship($sender);
		}
	}
	if ($postback === "huongdan") {
		MessageHuongDan($sender);
	}
	if ($postback === "menu") {
		MessageHome($sender);
	}
}
mysqli_close($conn);
?>