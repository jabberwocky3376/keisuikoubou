<?php 
if(!$_POST){
header('Location: /');
}
session_start();
if(isset($_POST['name'],$_POST['email'],$_POST['comment'])){
$_SESSION['name'] = $_POST['name'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['comment'] = $_POST['comment'];
}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無題ドキュメント</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="stylesheet" href="css/reset.css" media="all">
<link rel="stylesheet" href="css/style.css" media="all">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>

    <div class="wrap">
        <main id="right">
        
<?php
$action = $_POST['action'];
$name = htmlspecialchars($_SESSION['name']);
$email = htmlspecialchars($_SESSION['email']);
$comment = htmlspecialchars($_SESSION['comment']);
$to = 'jabberwocky3376@gmail.com';
$subject = 'お問い合わせ';
$message = '[name]'."\n".$name."\n";
$message .= '[email]'."\n".$email."\n";
$message .= '[comment]'."\n".$comment."\n\n\n";
$header = 'From: '.$email."\r\n";
$header .= 'Reply-To: '.$email."\r\n";
if($action == "post"){
echo '<div class="tb-cell mail-form">';
echo '<form id="form" action="send.php" method="post">';
echo '<div class="row">';
echo '<div class="cell">';
echo '<label>お名前</label>';
echo '<!--cell--></div>';
echo '<div class="cell">';
echo $_SESSION['name'];
echo '<!--cell--></div>';
echo '<!--row--></div>';
echo '<div class="row">';
echo '<div class="cell">';
echo '<label>メールアドレス</label>';
echo '<!--cell--></div>';
echo '<div class="cell">';
echo $_SESSION['email'];
echo '<!--cell--></div>';
echo '<!--row--></div>';
echo '<div class="row">';
echo '<div class="cell">';
echo '<label>お問い合わせ内容</label>';
echo '<!--cell--></div>';
echo '<div class="cell">';
echo $_SESSION['comment'];
echo '<!--cell--></div>';
echo '<!--row--></div>';
echo '<div class="row">';
echo '<div class="cell">';
echo '&nbsp;';
echo '<!--cell--></div>';
echo '<div class="cell">';
echo '<p>入力内容が正しければ送信してください</p><br>';
echo '<button type="submit" id="sbtn" name="action" value="send">送　信</button>';
echo '<button type="button" onclick="history.go(-1)">入力フォームに戻る</button>';
echo '<!--cell--></div>';
echo '<!--row--></div>';
echo '</form>';
echo '<!--tb-cell--></div>';
}elseif($action == "send"){
$status = mb_send_mail($to, $subject, $message, $header);
if ($status) {
echo '<p class="msg">メッセージは正常に送信されました</p>';
echo '<button type="button" onclick="history.go(-2)">入力フォームに戻る</button>';
} else {
echo '<p class="msg">メッセージの送信に失敗しました</p>';
echo '<button type="button" onclick="history.go(-2)">入力フォームに戻る</button>';
}
$_SESSION = array();
session_destroy();
}
?>
        </main><!--END right-->
    </div><!--END wrap-->


    <footer>  	
        <nav>
        	<ul>
            	<li><a href="#">about</a></li>
            	<li><a href="#">works</a></li>
                <li><a href="mail.html">contact</a></li>
            </ul>
        </nav>
    
    	<p>Copyrights&copy;Junki Akutagawa.</p>
    </footer>

</body>