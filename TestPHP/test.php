<?php
$name = "";
$message = "";
$age = 0;


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["my_name"];
    if($name == "Eva") {
        $message = "Ahoj, Evo!";
        $age = $_POST["my_age"];
    } else {
        $message = "Neznám tě";

    }
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PHP</title>
</head>
<body>
    <h1>Test formuláře</h1>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique necessitatibus eum nam totam, expedita commodi ipsum eius veritatis cum nemo nisi maiores fugit. Aliquam nostrum distinctio ab alias est fugiat!</p>
    <form method="post">
        <input type="text" name="my_name" placeholder="Zadejte své jméno">
        <input type="text" name="my_age" placeholder="Zadejte svůj věk">
        <button type="submit">Odeslat</button>
    </form>


    <p>
        <?php echo "Výstup: ";
              echo $message;
        ?>
    </p>

    <p>
        <?php echo "Tvůj věk: ";
              echo $age;
        ?>
    </p>

</body>
</html>