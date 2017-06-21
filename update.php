<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
date_default_timezone_set('America/Denver');

require "config.php";
require "get.php";
require "gh.php";

function getWebsite($str) {
    $res = $str;
    switch ($res) {
        case 'Longmont':
            $res = "https://www.longmonthumane.org/?q=animals";
            break;
        default:
            $res = "https://walkthosedoggos.github.io/thosedoggos/";
    }
    return $res;
}

function searchArr($arr, $needle) {
    foreach($arr as $k => $v) {
        if (strpos($v, $needle) !== false){
            return $v;
        } else {
            continue;
        }
    }
    return null;
}

//https://stackoverflow.com/questions/1760525/need-to-write-at-beginning-of-file-with-php
function prependStr($string, $orig_filename) {
    $context = stream_context_create();
    $orig_file = fopen($orig_filename, 'r', 1, $context);

    $temp_filename = tempnam(sys_get_temp_dir(), 'php_prepend_');
    file_put_contents($temp_filename, $string);
    file_put_contents($temp_filename, $orig_file, FILE_APPEND);

    fclose($orig_file);
    unlink($orig_filename);
    rename($temp_filename, $orig_filename);
}
// $a = add();
$c = commit('test ts');
// var_dump($a);
// $br = "\r\n";
// echo $br;
// var_dump($a);
// $s = status();
var_dump($c);
exit();

//write the curl operations to get the result (sample below)
$b = "\r\n";
echo "---hello, getting the data" . $b;
$json = getIgData($token);

echo "---starting to parse the data" . $b;
$data = $json["data"]; //data array
$ig_0 = $data[0]; //first obj in data

$ig_ts = (int) $ig_0["created_time"];

echo $ig_ts . $b;

//make sure file and path is correct, this is a test file
$file = 'index.md';

//get first line, know file exists
$line = fgets(fopen($file, 'r'));

//get the id
$line = str_replace(" ", "", $line);
$line = str_replace("---", "", $line);
$line = str_replace("<!", "", $line);
$line = str_replace(">", "", $line);
$unix_ts = (int) $line;
$t_arr = array(
    "yr" => date("Y", $unix_ts),
    "dy" => date("m", $unix_ts),
    "mo" => date("d", $unix_ts)
);

//change to not equal
if ($ig_ts != $unix_ts) {
    echo "---times do not match, starting to write" . $b;
    //name from caption
    //$caption = explode(" ", $ig_0["caption"]["text"]);
    //$name = $caption[0];
    $caption = $ig_0["caption"]["text"];
    $name = '';
    //regex match up until !, assumes the caption will start with Name! format.
    preg_match('/.+?(?=!)/', $caption, $match);
    if (count($match) > 0) {
        $name = $match[0] . "!";
    }
    else {
        $name = "Doggo!";
    }
    echo $name . $b;

    // location from tag
    $tags = $ig_0["tags"];
    $needle = "humanesociety";
    $loc = searchArr($tags, $needle);
    $loc = ucfirst(str_replace($needle, "", $loc));
    echo $loc . $b;

    $site = getWebsite($loc);
    echo $site . $b;

    //ig image link
    $ig_img = $ig_0["images"]["low_resolution"]["url"];

    //md prepend vars
    $write = array_fill_keys(array("ts", "title", "desc", "image"), "");
    $write["ts"] = "<!--- " . $ig_ts . " --->";
    $write["title"] = "## " . $name;
    $write["desc"] = "[Adopt at " . $loc . " Humane Society](" . $site . ")" . $b;
    $write["image"] = "![Picture of " . $name . "](" . $ig_img . ")" . $b;
    $write_str = implode($b, $write);

    prependStr($write_str, $file);
    echo "---done writing" . $b;

    //write the code to update git

}



exit();
