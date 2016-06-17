<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Formular</title>
    <style>
        .wrapper{max-width: 300px;margin: 50px auto;}
        input[type="checkbox"]{margin: 20px  5px;}
        input[type="text"],
        input[type="email"],
        input[type="submit"],
        textarea{padding: 10px;margin: 10px 0;width: 100%;}
        input[type="submit"]{width: 105%;}
        label p {color: brown;margin-bottom:0;max-width: 310px;padding: 3px;}
        h2{color: darkgreen;font-size: 24px;text-align: center;}
        h3{font-size: 18px;  font-family: Arial, serif;text-align: center;}
    </style>
</head>
<body>
<?php
    function myForm(){
        $form['name']       = '';
        $form['email']      = '';
        $form['thema']      = array(null, null);
        $form['betreff']    = '';
        $form['mitteilung'] = '';
        return $form;
    }
    $form = myForm();
    if(isset($_POST['senden'])){
        //var_dump($_POST);
        //echo '<hr>';
        $fehler = 0;
        foreach($form as $index => $feld){
            if($index == 'thema'){
                if(isset($_POST[$index])){
                    foreach($_POST[$index] as $num => $eintrag){
                        $form[$index][$num] = 'checked';
                    }
                }
            }else{
                $form[$index] = $_POST[$index];
            }
        }

        // Prüfung Felder
        if(strlen($_POST['name']) < 1){$fehler++;
            $errName = "Bitte geben Sie Ihren Namen ein";
        }
        if(empty($_POST['email'])){$fehler++;
            $errEmail = "Bitte geben Sie ihre E-Mail Adresse ein";
        }
        if(empty($_POST['thema'])){$fehler++;
            $errThema = "Bitte wählen Sie 1 oder mehrere Themen<br>";
        }
        if(empty($_POST['betreff'])){$fehler++;
            $errBetreff = "Bitte geben Sie einen Betreff ein";
        }
        if(strlen($_POST['mitteilung']) < 7){$fehler++;
            $errMitteilung = "Bitte geben Sie Mindestens 7 Zeilen";
        }

        // Result
        if($fehler == 0){
            $to       = "info@maxxidom.com";
            $from     = "formular@maxxidom.com";
            $subject  = "Mail von Anfrageformular";
            $header   = "From: $from\n";
            $header  .= "Content-Type: text/plain; charset=UTF-8\n";


            extract($_POST);
            $email    = $_POST["email"];

            // Datum hinzufügen
            $datum    = date('d.m.Y');
            $uhr      = date('H:i:s');

            //Nachrichten Kontent
            $message  = "$name hat am $datum um $uhr Uhr folgende Anfrage:\n";
            $message .= "Thema: ".implode(", ",$thema)."\n";
            $message .= "Betreff: $betreff\n";
            $message .= "Mitteilung: $mitteilung\n";
            $message .= "\nKontakt:\n";
            $message .= "Email: $email\n";
            $message .= "Name: $name\n";

            //nachricht mit mail versenden
            $ok = mail($to,$subject,$message,$header);
            if ($ok == true){
                $antwort = 'Anfrage versendet<br>Vielen Dank<br>';
                $form = myForm();
                
            }else{
                echo 'Anfrage Konnt nicht versendet werden,<br> Bitte versuchen Sie es später noch einmal ';
            }
        }
    }
?>

<div class="wrapper">
    <form action="formular.php" method="post">
        <h3><?php if (empty($antwort) ){echo 'ANFRAGE FORMULAR';}else{echo '<h2>' . $antwort . '</h2>';} ?></h3>
        <label><?php if( empty($errName) == false){ echo '<p>'; echo $errName; echo '</p>';} ?></label>
        <input type="text"     name="name"  value="<?php echo $form['name'] ?>"   placeholder="Name"><br>

        <label><?php if( empty($errEmail) == false){ echo '<p>'; echo $errEmail; echo '</p>';} ?></label>
        <input type="email"    name="email" value="<?php echo $form['email']; ?>" placeholder="Email"><br>

        <label><?php if( empty($errThema) == false){ echo '<p>'; echo $errThema; echo '</p>';} ?></label>
        <input type="checkbox" name="thema[0]" value="webdesign" <?php echo $form['thema'][0] ?> >Webdesign
        <input type="checkbox" name="thema[1]" value="programmirung" <?php echo $form['thema'][1] ?> >Programmirung<br>

        <label><?php if( empty($errBetreff) == false){ echo '<p>'; echo $errBetreff; echo '</p>';} ?></label>
        <input type="text"     name="betreff"  value="<?php echo $form['betreff'] ?>" placeholder="Betreff"><br>

        <label><?php if( empty($errMitteilung) == false){ echo '<p>'; echo $errMitteilung; echo '</p>';} ?></label>
        <textarea name="mitteilung" cols="37" rows="5"><?php echo $form['mitteilung'] ?></textarea>
        <input type="submit"   name="senden"   value="Anfrage Senden"><br>
    </form>
</div>

</body>
</html>



