<!DOCTYPE html>
<!--Open code made by: Willem Albeda and Jappie313.-->
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>ChatBot</title>
    <script>alert("Let op!\nDe gegevens die u invuld op deze website worden opgeslagen op onze server.\nGebruik de website op eigen risico.\n\nEN:\nWarning!\nThe information you submit on this website is saved on our server.\nUse the website at your own risk.")</script>
</head>
<body>
<?php
    //Open code made by: Willem Albeda and Jappie313.
    session_start();
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

        $_SESSION["name"] = $_POST["firstName"] . " " . $_POST["surName"];
        $birthDate = $_POST["month"] . "/" . $_POST["day"] . "/" . $_POST["year"];
        //explode the date to get month, day and year
        $birthDate = explode("/", $birthDate);
        //get age from date or birthdate
        $_SESSION["age"] = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
    }


?>
    <div id="aboveChatbot">
        <h1 class="title">Dit is geen ROBOCHAT.</h1>
        <p class="intro">Deze chatbot is een wiki geïnspireerd op codepanta.</p>
    </div>
    <div class="chatbot">
        <div class="indexVragenDiv">
            <form action="" method="post">
                <p class="indexVragen">Wat  is je voornaam?</p>
                <input class="inputIndexVragen" type="text" name="firstName" placeholder="voornaam">
                <p class="indexVragen">Wat  is je achternaam?</p>
                <input class="inputIndexVragen" type="text" name="surName" placeholder="achternaam">
                <p class="indexVragen">Wat is je email adress?</p>
                <input class="inputIndexVragen" type="text" name="email" placeholder="email">
                <p class="indexVragen">Wat is je geboorte datum?</p>
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
                <input class="submitCatbot" type="submit" name="submit" value="Naar de chatbot">
            </form>
        </div>
    </div>
    <div class="footer">
        <p>Version: Willem Albeda 2020.</p>
    </div>
</body>
</html>
