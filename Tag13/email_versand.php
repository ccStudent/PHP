<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Email Vesand</title>
</head>
<body>
<h1>Email Versand</h1>
<?php
    // https://de.wikipedia.org/wiki/Header_(E-Mail)
   // //mail(
    //    'maxxidomgermany@gmail.com',
    //    'Betreff Tets',
    //    'Nachricht an PHP',
    //    'from:maxxidomgermany@gmail.com'
    //);

    $an         = 'ludmila@web.de';
    $kopie      = 'ewgenij@gmail.com';
    $von        = 'alexander@maxxidom.com';
    $betreff    = 'Einladung zum Geburstag';
    $nachricht  = 'Hallo Freuende, Ich möchte euch recht herzlich zu meine Geburstag einladen.';

    $kopf  = "From: $von\n";
    $kopf .= "CC: $kopie\n";

    $ok = mail($an,$betreff,$nachricht,$kopf);

    var_dump($ok);
?>
</body>
</html>