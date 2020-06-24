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
    //TODO add more questions and answers!
    //TODO add css for new forms
    session_start();
    $urlKook = "https://www.leukerecepten.nl/";
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
       if(preg_match("/help/i",$input))return nl2br("als je je verveelt kunnen wij je helpen. Type: 'ik verveel me' voor ideeën om te doen\n");
       else if ($input === "ERROR: No message was send!")return nl2br("ERROR: No message was send!\n");
       else if (preg_match("/verveel/i",$input))return nl2br("Ga een stukje wandelen of ga sporten.\n Maak je email inbox op orde. Meld je of voor reclame en spam.\n Bel of stuur een bericht naar iemand die je al een tijdje niet meer hebt gesproken.\n Maak eindelijk die kamer van je een schoon. Al dat stof is niet gezond voor je.\n Ga lekker een spanned boek lezen of begin aan een nieuwe netflix serie.");
       else if (preg_match("/doen/i",$input)) return nl2br("Ga eten koken voor de komende dagen. Dan heb je dat alvast gedaan.\n Maak een buckit list.\n Als je nog geen vakantie hebt voor de vakantie. Ga opzoek naar een leuke locatie en plan een vakantie daar heen,\n Ga met een paar vrienden of familie naar een museum of de bioscoop.\n Ga mensen op een forum helpen met hun problemen.\n of nodig een paar vrienden uit of te gaan chillen.");
       else if (preg_match("/kook/i",$input)) return nl2br("Dit is een goed site meet veel ideeën om wat lekkers te koken: ".$GLOBALS["urlKook"]);
       else if (preg_match("/vakantie/i",$input)) return "Je kan hier goede vakantie ideeën opdoen: https://www.skyscanner.nl/nieuws/inspiratie/10-ideeen-voor-een-super-zonnige-vakantie";
       else if (preg_match("/boek/i",$input)) return "Je kan heel veel leuke boeken op deze site vinden: https://www.bruna.nl/boekentop100";
       else {
           return "Ik weet niet hoe ik niet op moet antwoorden.<br> Jouw vraag was \"$input\".<br>".
                  '<form method="post" class="form">
                  <p>Wil je een nieuwe vraag met antwoord toevoegen?</p>
                  <input type="radio" id="yes" name="add" value="yes">
                  <label for="yes">ja</label><br>
                  <input type="radio" id="no" name="add" value="no">
                  <label for="no">nee</label><br>
                  <input type="radio" id="maybe" name="add" value="maybe">
                  <label for="maybe">mischien later</label><br>
                  <input class="submit" type="submit" name="confirm"/>';
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
                    <p>Wat is uw vraag?</p>
                    <input type="text" name="question" placeholder="Your Message">
                    <p>Wat is uw antwoord op uw vraag?</p>
                    <input type="text" name="answer" placeholder="Your Message">
                    <input type="submit" name="addSubmit">
                    </form>';
            } else if ($_POST["add"] == "maybe") echo "Vraag de zelfde vraag als je het later wil toevoegen";
            else echo "Jammer D:";
        }
    }
    function writeQ_A(){
            if(isset($_POST["addSubmit"]) && !empty($_POST["question"]) && !empty($_POST["answer"])){
                $question = "Q: ".$_POST["question"]."\n";
                $answer = "A: ".$_POST["answer"]."\n";
                file_put_contents("data.txt",$question,FILE_APPEND);
                file_put_contents("data.txt",$answer,FILE_APPEND);
                echo "Bedankt voor je hulp met het verbeter van deze chatbbot :D!";
            }
            else if (isset($_POST["addSubmit"])) echo "Vul beide tekst velden in.";
    }

    ?>
    <div id="aboveChatbot">
        <h1 class="title">Dit is geen ROBOCHAT.</h1>
        <p class="intro">Deze chatbot is geïnspireerd op codepanta.<br>Typ "help" voor alle mogelijkheden.</p>
    </div>
    <div class="chatbot">
        <div class="chatdiv"><p class="output"><?php echo nl2br("Hallo ".$_SESSION["name"]."(".$_SESSION["age"].")\n"); echo echoInput(); addQuestion(); writeQ_A();?><?php if (isset($_POST["submit"])) sendSResponse(findSResponse(getCMessage()));?></p></div>
            <form id="chatbotForm" method="post">
                <input class="input" name="cMessage" type="text" placeholder="Your Message">
                <input class="submit" type="submit" name="submit"/>
            </form>
    </div>

</body>
</html>