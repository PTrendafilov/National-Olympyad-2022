<?php
include "crud_problems_config.php";
$id = $_POST['id'];
$sql = "SELECT * FROM problems WHERE id='$id'";
$result = $con->query($sql);
$row = $result->fetch_assoc();

$input = explode(",", $row["input"]);
?>
<?php

$code = $_POST['code'];

$regex = '/(?P<before_for>(.*\n)*)(?P<for>(?P<condition>for (?P<variable>.*) in .*:)(?P<code>(.*\n\s\s\s\s.*)*))(?P<after_for>(.*\n)*)/';
//print("preg_match = " . preg_match($regex, $code) . "\n");

if (preg_match($regex, $code)) {
    preg_match($regex, $code, $matches);

    if (preg_match($regex, $matches['for'])) {
        //print($matches['for']);
        $temp_for_code = $matches['for'];
        // '.$matches['variable'].'

        $regex_var = '/(?<=\[|\(|\s|=)' . $matches['variable'] . '(?=\]|\)|\s|[^a-zA-Z0-9])/';
        $matches['code'] = preg_replace($regex_var, '{' . $matches['variable'] . '}', $matches['code']);

        //$code="";
        /*
    $code.=$matches['condition'];
    $code = preg_replace($regex, $matches['code'], $matches['condition']."print(".$matches['code'].")",1);
    */

        $matches['code'] = preg_replace('/\s\s+/', '\n', $matches['code']);
        $temp_for_code = $matches['before_for'].$matches['condition'] . "print(f'" . $matches['code'] . "')".$matches['after_for'];

        $random = substr(md5(mt_rand()), 0, 7);
        $filePath = "temp/" . $random . "." . "py";
        $programFile = fopen($filePath, "w");
        fwrite($programFile, $temp_for_code);
        fclose($programFile);
        $temp_for_code = shell_exec("C:\Users\Rumyana\AppData\Local\Programs\Python\Python39\python.exe $filePath 2>&1");
        $temp_for_re = preg_replace("/\(/", "\(", $matches['for']);
        $temp_for_re = preg_replace("/\)/", "\)", $temp_for_re);
        $temp_for_re = preg_replace("/\+/", "\+", $temp_for_re);
        $temp_for_re = preg_replace("/\-/", "\-", $temp_for_re);
        $temp_for_re = preg_replace("/\*/", "\*", $temp_for_re);
        $temp_for_re = preg_replace("/\//", "\/", $temp_for_re);
        $temp_for_re = preg_replace("/\?/", "\?", $temp_for_re);
        $temp_for_re = preg_replace("/\[/", "\[", $temp_for_re);
        $temp_for_re = preg_replace("/\]/", "\]", $temp_for_re);
        $temp_for_re = preg_replace("/\{/", "\{", $temp_for_re);
        $temp_for_re = preg_replace("/\}/", "\}", $temp_for_re);
        //print("\n" . $temp_for_re . "\n");
        $code = preg_replace("/" . $temp_for_re . "/", $temp_for_code, $code);
        //print($temp_for_code . "\n");

        $matches['for'] = $temp_for_code;
    }
}
//print($code . "\n");
/*
while(true){
    $code = preg_replace($regex, $replacement, $code,1);
}
*/
for ($i = 0; $i < sizeof($input); $i++) {
    //echo $input[$i] . "\n";
    $pattern = "input\(\)";
    $replacement = $input[$i];
    $code = preg_replace("/$pattern/", "'".$replacement."'", $code, 1);
}
$random = substr(md5(mt_rand()), 0, 7);
$filePath = "temp/" . $random . "." . "py";
$programFile = fopen($filePath, "w");
fwrite($programFile, $code);
fclose($programFile);
$output = shell_exec("C:\Users\Rumyana\AppData\Local\Programs\Python\Python39\python.exe $filePath 2>&1");


if ($output == $row['output']) {
    echo "Решението е вярно!\n";
}else{
    echo "Решението е грешно!\n";
    echo "Вашият изход\n".$output;
    echo "При вход\n";
    for ($i = 0; $i < sizeof($input); $i++) {
        echo $input[$i] . "\n";
    }
}
