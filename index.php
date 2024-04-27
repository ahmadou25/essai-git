<?php
session_start();
if(isset($_POST['send'])) {
    extract($_POST);
    if (isset($username) && $username != "" &&
       isset($email) && $email != "" &&
       isset($phone) && $phone != "" &&
       isset($message) && $message != "" ){

        $to = "ahmadou.diaw.sio@gmail.com";
        $subject = "Vous avez un message de: " .$email;
        $message = " 
            <p>Vous avez reçu un message de <strong>".$email."</strong></p>
            <p><strong>nom :</strong>.$username</p>
            <p><strong>Telephone :</strong>.$phone </p>
            <p><strong>message :</strong>.$message </p>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <'.$email.'>' . "\r\n";

        $send = mail($to,$subject,$message,$headers);
        if($send){
            $_SESSION['success_message'] = "message envoyé";
            header("location:index.php");
        }else{
            $info = "message non envoyé";
        }

    }else {
        $info = "veuillez remplir tous les champs !";
      
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>mon portfolio</h1>
    <p>mon image</p>
    <img src="image/about.png" alt="">
    <section class="contact" id="contact">
        <!-- afficher le message d'ereur -->
        <?php
           if (isset($info)){?>
            <p class="info_message" style="color:red">
                  <?=$info?>
            </p>
        <?php
           }
        ?>
        <!-- afficher le message envoyee -->
        <?php
           if (isset($_SESSION['success_message'])){?>
            <p class="info_message" style="color:green">
                  <?=$_SESSION['success_message']?>
            </p>
        <?php
           }
        ?>

        <form action="" method="POST">
        <h2 class="heading">Contact <span>Me!</span></h2>
            <div class="input-box">
                <input type="text" name="username" placeholder="Nom complet">
                <input type="email" name="email" placeholder="Addresse électronique">
            </div>
            <div class="input-box">
                <input type="number" name="phone" placeholder="Numéro de téléphone mobile">
                <input type="text" name="message" placeholder="Sujet du courrier électronique">
            </div>
            <textarea name="" id="" cols="30" rows="10" placeholder="Votre message"></textarea>
            <button class="btn" name="send">Envoyer </button>
        </form>
    </section>
</body>
</html>