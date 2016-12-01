<?php 
//Если форма отправлена
  if (isset($_POST['submit'])) {
      //проверка имени
      if (trim($_POST['user_name']) == '') {$error = true;}
      else {$name = substr(htmlspecialchars(trim($_POST['user_name'])), 0, 80);}
      //проверка телефона
      if (trim($_POST['user_phone']) == '') {$error = true;}
      else {$phone = substr(htmlspecialchars(trim($_POST['user_phone'])), 0, 80);}
       //Проверка правильности ввода EMAIL
      if (trim($_POST['user_email']) == '') {$error = true;}
      else if (!preg_match("/^([a-zA-Z0-9_\.-]+)@([a-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,4})$/", trim($_POST['user_email']))) { $error = true;}
      else {$email = substr(htmlspecialchars(trim($_POST['user_email'])), 0, 50);}
     //Проверка наличия ТЕКСТА сообщения
      if(trim($_POST['user_message']) == '') {$error = true;}
      else if(function_exists('stripslashes')) {$text = wordwrap(stripslashes(trim($_POST['user_message'])), 350, "\r\n");}
      else {$text = wordwrap(htmlspecialchars(trim($_POST['user_message'])), 350, "\r\n"); }
  }
$subject = 'Письмо с сайта организации Благие Дела';
$header  = "MIME-Version: 1.0 \r\n";
$header .= "Content-type: text/html; charset=utf-8 \r\n"; 
$header .= "From: ".$email."\r\n";
$emailTo = 'mwp201@yandex.ru'; //Сюда введите Ваш email
$message = '
<!DOCTYPE html>
<html>
<head>
<title>Письмо с сайта организации Благие Дела</title>
</head>
<body>
<table width="100%">
<tr>
<td>
<h4>Имя отправителя : '.$name.'</h4>
<h4>Email отправителя : '.$email.'</h4>
<h4>Телефон отправителя : '.$phone.'</h4>
<p>Текст сообщения : '.$text.'</p>
</td>
</tr>
</table>
</body>
</html>';
//Если ошибок нет, отправить email
if(!isset($error)) {
 mail($emailTo, $subject, $message, $header);
$emailSent = true;
}
  ?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Отчет об отправлении</title>
    </head>

    <body>
        <div class="fixed-overlay" id="send">
            <div class="modal">
                <div class="modal-window-send clearfix">
                    <?php 
      if ($emailSent == true) {echo '<p style="color:#000;">Спасибо! Ваше письмо отправлено.</p>';} 
      else if ($error == true) {echo '<p>Ваше письмо не отправлено! <br> Проверьте правильность заполнения полей!</p>';} 
    ?>
                        <a class="btn" href="contact.html">Вернуться назад</a>
                </div>
            </div>
        </div>
        <script>
            window.setTimeout(function () {
                location.href = 'contact.html';
            }, 2000);
        </script>
    </body>

    </html>