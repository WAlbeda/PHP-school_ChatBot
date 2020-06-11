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
    function findSResponse($pattern){
       // $pattern .= "/".$pattern."/i";
        preg_match($pattern, file_get_contents($GLOBALS["jFile"]), $matches, PREG_OFFSET_CAPTURE);
        return $matches;
    }

    echo getCMessage();
    print_r(findSResponse("/two/i",file_get_contents($jFile)));


    ?>
    <div id="aboveChatbot">
        <h1 class="title">Welkom bij de "een ChatBot is geen ChatRobot en al helemaal geen RobotChat" chatbot.</h1>
    </div>
    <div class="chatdiv"></div>
        <form id="chatbot" method="post">
            <p class="output"><?php echo getCMessage(); ?></p>
            <input class="input" name="cMessage" type="text" placeholder="Your Message">
            <input class="submit" type="submit" name="submit"/>
        </form>
    </div>
</body>
</html>
