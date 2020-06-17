<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>ChatBot</title>
</head>
<body>
<?php
    if(isset($_POST["submit"])){
        $firstName = "Name: ".$_POST["firstName"]." ";
        $surName = $_POST["surName"]."\n";
        $email = "Email: ".$_POST["email"]."\n";
        $day = "birth day: ".$_POST["day"];
        $month = " ".$_POST["month"];
        $year = " ".$_POST["year"]."\n";
        $all = "$firstName $surName $email $day $month $year";
        file_put_contents("data.txt",$all,FILE_APPEND);
        header("Location: chatbot.php");
    }

?>
    <div id="aboveChatbot">
        <h1 class="title">Welkom bij de "een ChatBot is geen ChatRobot en al helemaal geen RobotChat" chatbot.</h1>
    </div>
    <div class="chatbot">
        <form action="" method="post">
            <p>Wat  is je voornaam?</p>
            <input type="text" name="firstName"> <br><br>
            <p>Wat  is je achternaam?</p>
            <input type="text" name="surName"> <br><br>
            <p>Wat is je email adress?</p>
            <input type="text" name="email"> <br><br>
            <p>Wat is uw geboorte datum?</p>
            <select name="day">
                <?php
                for ($i=1; $i<=31; $i++)
                {
                    ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                }
                ?>
            </select>
            <label for="day">dag</label> <br><br>
            <select list="month" name="month">
                <?php
                for ($i=1; $i<=12; $i++)
                {
                    ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                }
                ?>
            </select>
            <label for="month">maand</label> <br><br>
            <select name="year">
                <?php
                for ($i=1900; $i<=2020; $i++)
                {
                    ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                }
                ?>
            </select>
            <label for="year">jaar</label> <br><br>
            <input type="submit" name="submit">
        </form>
    </div>
</body>
</html>