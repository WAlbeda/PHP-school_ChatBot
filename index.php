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
    //base variables
   /* $jFile = "jData.txt";
    $jData = parse_ini_file($jFile,true);
    $wFile = "wData.ini";*/
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
       if(preg_match("/help/i",$input))return nl2br("test 1 2 3\n");
       else if ($input === "ERROR: No message was send!")return nl2br("ERROR: No message was send!\n");
       else if (preg_match("/verveel/i",$input))return nl2br("Ga een stukje wandelen of ga sporten.\n Maak je email inbox op orde. Meld je of voor reclame en spam.\n Bel of stuur een bericht naar iemand die je al een tijdje niet meer hebt gesproken.\n Maak eindelijk die kamer van je een schoon. Al dat stof is niet gezond voor je.\n Ga lekker een spanned boek lezen of begin aan een nieuwe netflix serie.");
       else if (preg_match("/doen/i",$input)) return "Ga eten kooken voor de komende dagen. Dan heb je dat alvast gedaan.\n Maak een buckit list.\n Als je nog geen vakantie hebt voor de vakantie. Ga opzoek naar een leuke locatie en plan een vakantie daar heen,\n Ga met een paar vrienden of familie naar een museum of de bioscoop.\n Ga mensen op een forum helpen met hun problemen.\n of nodig een paar vrienden uit of te gaan chillen.";
       else {
           return "Ik weet niet hoe ik niet op moet antwoorden.<br> Jouw vraag was \"$input\".<br>".
                  '<form method="post">
                  <p>Wil je een nieuwe vraag met antwoord toevoegen?</p>
                  <input type="radio" id="ja" name="add" value="ja">
                  <label for="ja">ja</label><br>
                  <input type="radio" id="nee" name="add" value="nee">
                  <label for="nee">nee</label><br>
                  <input type="radio" id="mischien" name="add" value="mischien">
                  <label for="mischien">mischien later</label><br>
                  <input class="submit" type="submit" name="confirm"/>';
       }
    }
    function echoInput(){
        if (!empty($_POST["cMessage"]) && $_POST["cMessage"] !== "Ik weet niet hoe ik niet op moet antwoorden.\n Jouw vraag was \"\".") {
            $output = $_POST["cMessage"];
            $output .= nl2br("\n");
            echo $output;
        }
    }
    function addQuestion(){
        if (isset($_POST["confirm"])) {
            if ($_POST["add"] == "ja") {
                echo '<form method="post"
                    <p>Wat is uw vraag?</p>
                    <input type="text" name="question" placeholder="Your Message">
                    <p>Wat is uw antwoord op uw vraag?</p>
                    <input type="text" name="answer" placeholder="Your Message">
                    <input type="submit" name="addSubmit">
                    </form>';
            } else if ($_POST["add"] == "mischien") echo "Vraag de zelfde vraag als je het later wil toevoegen";
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
        <h1 class="title">Welkom bij de "een ChatBot is geen ChatRobot en al helemaal geen RobotChat" chatbot.</h1>
    </div>
    <div class="chatbot">
        <div class="chatdiv"><p class="output"><?php echo echoInput(); addQuestion(); writeQ_A();?><?php if (isset($_POST["submit"])) sendSResponse(findSResponse(getCMessage()));?></p></div>
            <form id="chatbotForm" method="post">
                <input class="input" name="cMessage" type="text" placeholder="Your Message">
                <input class="submit" type="submit" name="submit"/>
            </form>
    </div>

</body>
</html>