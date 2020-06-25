<!DOCTYPE html>
<!--Open code made by: Willem Albeda and Jappie313.-->
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/png" href="treefav.png">
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
        $birthDate = explode("/", $birthDate);
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
            <form method="post">
                <p class="indexVragen">Wat  is je voornaam?</p>
                <input class="inputIndexVragen" type="text" name="firstName" placeholder="voornaam" required>
                <p class="indexVragen">Wat  is je achternaam?</p>
                <input class="inputIndexVragen" type="text" name="surName" placeholder="achternaam" required>
                <p class="indexVragen">Wat is je e-mail adres?</p>
                <input class="inputIndexVragen" type="text" name="email" placeholder="e-mail">
                <p class="indexVragen">Wat is je geboortedatum?</p>
                <div class="birthdateDiv">
                    <div class="birthdateLabelAlign"><label class="birthdateLabel">dag:</label></div>
                    <select class="birthdateSelect" name="day">
                        <?php
                        for ($i=1; $i<=31; $i++)
                        {
                            ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="birthdateDiv">
                    <div class="birthdateLabelAlign"><label class="birthdateLabel">maand:</label></div>
                    <select class="birthdateSelect" name="month">
                        <?php
                        for ($i=1; $i<=12; $i++)
                        {
                            ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="birthdateDiv">
                    <div class="birthdateLabelAlign"><label class="birthdateLabel">jaar:</label></div>
                    <select class="birthdateSelect" name="year">
                        <?php
                        for ($i=1900; $i<=2020; $i++)
                        {
                            ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="agreeRules">
                    <input type="checkbox" required><label>Ik ga akkoord met dat mijn gegevens gebruikt mogen worden om deze website te verbeteren.</label>
                </div>
                <input class="submitCatbot" type="submit" name="submit" value="Naar de chatbot!">
            </form>
        </div>
    </div>
    <div class="footer">
        <p>Version: Willem Albeda 2020.</p>
        <a href="https://github.com/WAlbeda/PHP-school_ChatBot"><img class="githubLink" src="Github.png" alt="GitHub" title="GitHub WAlbeda/PHP-school_ChatBot"></a>
    </div>
</body>
</html>
