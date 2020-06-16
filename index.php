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
    $jFile = "jData.ini";
    $jData = parse_ini_file($jFile,true);
    $wFile = "wData.ini";
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
       if(preg_match("/help/i",$input)){
            return nl2br("test 1 2 3\n");
       }
       else if ($input === "ERROR: No message was send!"){
           return nl2br("ERROR: No message was send!\n");
       }
       else {
           return nl2br("Ik weet niet hoe ik niet op moet antwoorden.\n Jouw vraag was \"$input\".\n");
       }
    }
    function echoInput(){
        if (!empty($_POST["cMessage"]) && $_POST["cMessage"] !== "Ik weet niet hoe ik niet op moet antwoorden.\n Jouw vraag was \"\".") {
            $output = $_POST["cMessage"];
            $output .= nl2br("\n");
            echo $output;
        }
    }

    ?>
    <div id="aboveChatbot">
        <h1 class="title">Welkom bij de "een ChatBot is geen ChatRobot en al helemaal geen RobotChat" chatbot.</h1>
    </div>
    <div class="chatbot">
        <div class="chatdiv"><p class="output"><?php echo echoInput();?><?php if (isset($_POST["submit"])) sendSResponse(findSResponse(getCMessage()));?></p></div>
            <form id="chatbotForm" method="post">
                <input class="input" name="cMessage" type="text" placeholder="Your Message">
                <input class="submit" type="submit" name="submit"/>
            </form>
    </div>
</body>
</html>
