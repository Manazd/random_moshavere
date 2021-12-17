<?php


$famousPeople = file_get_contents('people.json');
$json_famousPeople = json_decode($famousPeople, true);

$messages = file_get_contents('messages.txt');
$Messages = explode("\n", $messages);

$question = $_POST['question'];

if(isset($_POST['person']))
{
    $en_name = $_POST['person'];
    $fa_name = $json_famousPeople[$en_name];
}
else
{
    $en_name = array_rand($json_famousPeople);
    $fa_name = $json_famousPeople[$en_name];
}

if(isset($question))
{
    $msg = $Messages[hexdec(substr(md5($question . $en_name),0,15)) % count($Messages)];
}
else
{
    $msg = 'سوال خود را بپرس!';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>
<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
    <div id="title">
        <span id="label">پرسش:</span>
        <span id="question"><?php echo $question ?></span>
    </div>
    <div id="container">
        <div id="message">
            <p><?php echo $msg ?></p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
            <select name="person">
                <?php


                foreach ($json_famousPeople as $key => $value) 
                {
                    echo '<option value = "'.$key.'" '.($en_name == $key ? 'selected':''). '>'.$value.'</option>';
                }
                

                ?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>