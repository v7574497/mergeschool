<?php
    $history_page = "button button01-1";
    $public_hearing_page = "button button02-1";
    $feedback_page = "button button03-1";
    $discuss_page = "button button04-1";
    $survey_page = "button button05-1";
    if(isset($now_pages)){
        switch($now_pages){
            case "history":$history_page = "button button01-2";break;
            case "public_hearing":$public_hearing_page = "button button02-2";break;
            case "feedback":$feedback_page = "button button03-2";break;
            case "discuss":$discuss_page = "button button04-2";break;
            case "survey":$survey_page = "button button05-2";break;
        }
    }
    $url = base_url('');
?>
<!DOCTYPE html lang="zh-TW">
<html>
<head>
    <meta charset="UTF-8" />
	<title>國立高雄應用科技大學 學生會 - 三校合併資訊平台<?=$title;?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="og:title" content="國立高雄應用科技大學 學生會 - 三校合併資訊平台" />
    <meta name="og:type" content="school" />
    <meta name="og:url" content="http://sa.kuas.edu.tw/mergeschool/" />
    <meta name="og:image" content="http://sa.kuas.edu.tw/images/fbim.jpg" />
    <meta name="og:site_name" content="三校合併資訊平台" />
    <meta name="fb:admins" content="100002215692927" />
    <meta name="KEYWords" content="高應大,學生會,三校合併資訊平台,三校合併,校園合併資訊" />
    <meta name="description" content="國立高雄應用科技大學學生會所提供的三校合併資訊平台">
    <meta name="author" content="國立高雄應用科技大學 學生會-KUAS STUDENT ASSOCIATION">
    <meta name="copyright" content="國立高雄應用科技大學 學生會 KUAS SA 2014.ALL RIGHTS RESERVED" />
    <link rel="shortcut icon" type="image/x-icon" href="<?=$url.'images/salogo.ico'?>" />
    <link rel="stylesheet" type="text/css" href="<?=$url?>css/style.css" />
<?php if($history_page=="button button01-2"){?>
    <link rel="stylesheet" type="text/css" href="<?=$url?>css/jiaoben912/component.css" />
    <script src="js/jiaoben912/modernizr.custom.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=$url?>css/ModalWindowEffects/component.css" />
    <script src="<?=$url?>js/ModalWindowEffects/modernizr.custom.js"></script>
<?php }?>
</head>
<body>
<div class="body_content">
	<div class="top"><div onclick="location.href='<?=$url?>'"></div></div>
    <div class="menu">
        <a href="<?=$url.'history'?>"><div class="<?=$history_page;?>"></div></a>
        <a href="<?=$url.'public_hearing'?>"><div class="<?=$public_hearing_page;?>"></div></a>
        <a href="<?=$url.'feedback'?>"><div class="<?=$feedback_page;?>"></div></a>
        <a href="<?=$url.'discuss'?>"><div class="<?=$discuss_page;?>"></div></a>
        <a href="<?=$url.'survey'?>"><div class="<?=$survey_page;?>"></div></a>
        <div class="button button06"></div>
    </div>
<div class="middle">
    <div class="middle-top"></div>
    <div class="middle-middle">