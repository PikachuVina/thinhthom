<?php
require_once('config.php');
require_once('myfunc.php');

if ($_GET['type'] === 'delete') {
	$json = '
	{
	  "fields":[
	    "persistent_menu"
	  ]
	}';
	requestDelete($json);
} elseif ($_GET['type'] === 'insert') {
	$json = '
	{
	  "persistent_menu":[
	    {
	      "locale":"default",
	      "composer_input_disabled":true,
	      "call_to_actions":[
	        {
				"title":"Bắt Đầu Thả Thính",
				"type":"postback",
				"payload":"start"
	        },
	        {
				"title":"Ngừng Thả Thính",
				"type":"postback",
				"payload":"stop"
	        },
	        {
				"type": "web_url",
				"title": "Contact Info",
				"url": "http://nghĩa.vn",
				"webview_height_ratio": "full"
	        }
	      ]
	    },
	    {
	      "locale":"zh_CN",
	      "composer_input_disabled":false
	    }
	  ]
	}';
	requestInsert($json);
}
?>