<!DOCTYPE html>
<!--Open code made by: Willem Albeda and Jappie313.-->
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/png" href="treefav.png">
    <title>ChatBot</title>
</head>
<body>
    <?php
    //Open code made by: Willem Albeda and Jappie313.
    session_start();
    //base functions
    function getCMessage(){
        if(isset($_POST["submit"])) {
            if (!empty($_POST["cMessage"])) {
                return $_POST["cMessage"];
            } else {
                return "ERROR: No message was send!";
            }
        }
    }
    function sendSResponse($response){
        echo $response;
    }
    function findSResponse($input){
       if(preg_match("/help/i",$input))return nl2br("Probeer eens iets in te vragen als: \"Wie is Meindert Jorna, Wat is codepanta of hoe zijn school pc's.\"<br>Voor nog meer opties typ je \"Geef alle mogelijkheden.\"");
       else if ($input === "ERROR: No message was send!")return nl2br("ERROR: Je hebt geen bericht ingevuld!\n");
       else if (preg_match("/Meindert Jorna/",$input))return nl2br("Meindert Jorna is informatica docent op het Pantarijn, ontdekker van de sjiggle diggle en keizer van het rijk der Codepanta.");
       else if (preg_match("/meindert jorna/",$input)) return nl2br("Namen schrijf je met een hoofdletter Sjiggle Diggle... Probeer maar \"Wie is Meindert Jorna.\"");
       else if (preg_match("/Meindert JC/i",$input)) return nl2br("Meindert J(C)or(o)na is hoe Meindert Jorna zich noemde aan het begin van de corona lockdown.");
       else if (preg_match("/school pc/i",$input)) return nl2br("School pc's zijn kut, niks meer niks minder.");
       else if (preg_match("/codepanta/i",$input)) return nl2br("Codepanta is de website waarop leerlingen van Meindert Jorna hun lesstof krijgen, de website is inmiddels onder sommige leerlingen een meme geworden.");
       else if (preg_match("/codepnata/i",$input)) return nl2br("Codepnata is de door Willem Albeda bedachte concurrent van Codepanta, ooit zal Codepnata de wereld veroveren.");
       else if (preg_match("/corona/i",$input)) return nl2br("Het Corona virus is een redelijk gevaarlijk virus voor risico groepen. Wat je moet doen tegen corona kan je vinden op <a href=\"https://www.rijksoverheid.nl/onderwerpen/coronavirus-covid-19/nederlandse-maatregelen-tegen-het-coronavirus\">de website van de rijksoverheid</a>.");
       else if (preg_match("/covid/i",$input)) return nl2br("Covid-19 is de nieuwe, fancy en interresante naam voor het corona virus, mensen die interresant of intelligent willen klinken gebruiken deze naam.<br>\"Covid-19\" betekend precies hetzelfde als \"het Corona virus\"");
       else if (preg_match("/5g/i",$input)) return nl2br("5G is de nieuwste en snelste techniek (op het moment van schrijven) om data vanaf je smartphone met het mobile netwerk te verzenden.<br>5G is niet gevaarlijk, er is hier genoeg onderzoek voor gedaan en als je die nog steeds niet geloofd moet je zelf maar opnieuw je natuurkunde lessen volgen.<br>5G heeft ook niks te maken met het Corona virus.");
       else if (preg_match("/banaan/i",$input)) return '<img src="banaan.png" alt="banaan">';
       else if (preg_match("/mogelijkheden/i",$input)) return nl2br("Alle mogelijkheden zijn: \"Meindert Jorna\", \"meindert jorna\", \"Meindert JC\", \"school pc\", \"codepanta\", \"codepnata\", \"corona\", \"covid\", \"5g\", \"banaan\", \"mogelijkheden\", \"help\".");
       else {
           return "Ik weet niet hoe ik hier op moet antwoorden.<br> Jouw vraag was \"$input\".<br>Vraag anders straks \"mogelijkheden\" om alle mogelijke vragen te zien.<br>".
                  '<form method="post" class="form">
                  <p>Wil je bij de maker een verzoek indienen om een nieuwe vraag met antwoord toe te voegen?</p>
                  <input type="radio" id="yes" name="add" value="yes" required>
                  <label for="yes">ja</label><br>
                  <input type="radio" id="no" name="add" value="no">
                  <label for="no">nee</label><br>
                  <input type="radio" id="maybe" name="add" value="maybe">
                  <label for="maybe">mischien later</label><br>
                  <input class="submit" type="submit" name="confirm" value="Verzend"/>';
       }
    }
    function echoInput(){
        if (!empty($_POST["cMessage"]) && $_POST["cMessage"] !== "Ik weet niet hoe ik hier op moet antwoorden.\n Jouw vraag was \"\".") {
            $output = $_POST["cMessage"];
            $output .= nl2br("\n");
            echo $output;
        }
    }
    function addQuestion(){
        if (isset($_POST["confirm"])) {
            if ($_POST["add"] == "yes") {
                echo '<form method="post" class="form" id="addQA">
                    <p>Wat is de vraag die je wil toevoegen?</p>
                    <input class="vraagAntwoordToevoegen" type="text" name="question" placeholder="Vraag" required>
                    <p>Wat is het antwoord op die vraag?</p>
                    <input class="vraagAntwoordToevoegen" type="text" name="answer" placeholder="Antwoord" required>
                    <input class="vraagAntwoordSubmit" type="submit" name="addSubmit" value="Verzend">
                    </form>';
            } else if ($_POST["add"] == "maybe") echo "Vraag dezelfde vraag die je net vroeg als je later nog een vraag wil toevoegen.<br>Je kan nu weer een nieuwe vraag stellen.";
            else echo "Oke dan kan je nu weer een andere vraag invullen.";
        }
    }
    function writeQ_A(){
            if(isset($_POST["addSubmit"]) && !empty($_POST["question"]) && !empty($_POST["answer"])){
                $question = "Q: ".$_POST["question"]."\n";
                $answer = "A: ".$_POST["answer"]."\n";
                file_put_contents("data.txt",$question,FILE_APPEND);
                file_put_contents("data.txt",$answer,FILE_APPEND);
                echo "Bedankt voor je hulp met het verbeteren van deze chatbot.<br>Je kan nu weer een nieuwe vraag stellen.";
            }
            else if (isset($_POST["addSubmit"])) echo "ERROR, je moet een vraag en antwoord invullen.";
    }

    ?>
    <div id="aboveChatbot">
        <a class="indexLink" href="index.php"><h1 class="title">Dit is geen ROBOCHAT.</h1></a>
        <p class="intro">Deze chatbot is een wiki geïnspireerd op codepanta.<br>Hij beantwoord vragen over codepanta en school gerelateerde dingen.<br>Vraag "help" voor alle mogelijkheden.</p>
    </div>
    <div class="chatbot">
        <div class="chatdiv">
            <p class="name"><?php echo nl2br("Welkom ".$_SESSION["name"]." (".$_SESSION["age"]." jaar)\n");?></p>
            <p class="output"><?php echo echoInput(); addQuestion(); writeQ_A();?><?php if (isset($_POST["submit"])) sendSResponse(findSResponse(getCMessage()));?></p>
        </div>
        <form id="chatbotForm" method="post">
            <input class="input" name="cMessage" type="text" placeholder="Typ hier je vraag.">
            <input class="submit" type="submit" name="submit" value="Verzend je vraag">
        </form>
    </div>
    <div class="footer">
        <p>Version: Willem Albeda 2020.</p>
        <a href="https://github.com/WAlbeda/PHP-school_ChatBot"><img class="githubLink" src="Github.png" alt="GitHub" title="GitHub WAlbeda/PHP-school_ChatBot"></a>
    </div>
</body>
</html>