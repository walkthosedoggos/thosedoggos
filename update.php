<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
date_default_timezone_set('America/Denver');

require "config.php";
require "get.php";
require "gh.php";

$json = getIgData($token);

// print_r($data);
// exit();

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

//write the curl operations to get the result (sample below)
$b = "\r\n";
echo "---hello" . $b;
// $result = '{"pagination": {}, "data": [{"id": "1536621939416693670_5530629355", "user": {"id": "5530629355", "full_name": "walkthosedoggos", "profile_picture": "https://scontent.cdninstagram.com/t51.2885-19/s150x150/18947452_795972017230920_8438306814633705472_n.jpg", "username": "walkthosedoggos"}, "images": {"thumbnail": {"width": 150, "height": 150, "url": "https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/19051539_1695266877449465_5195314972363587584_n.jpg"}, "low_resolution": {"width": 320, "height": 320, "url": "https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19051539_1695266877449465_5195314972363587584_n.jpg"}, "standard_resolution": {"width": 640, "height": 640, "url": "https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/19051539_1695266877449465_5195314972363587584_n.jpg"}}, "created_time": "1497399631", "caption": {"id": "17861486260131016", "text": "Bud! Not sure what is spooking Bud, giving him a concern. He\u2019s a trooper, keeping calm and marking on. Adopt at Longmont Humane Society, shortlink in profile.\n\n#adoptdontshop #rescueisthenewblack #doggos #walkthosedoggos #dogsofinstagram #pibbles #shelterdoggos #oneluckypup #adoptme #shelterdogsrock #longmonthumanesociety #tuesdayface", "created_time": "1497399631", "from": {"id": "5530629355", "full_name": "walkthosedoggos", "profile_picture": "https://scontent.cdninstagram.com/t51.2885-19/s150x150/18947452_795972017230920_8438306814633705472_n.jpg", "username": "walkthosedoggos"}}, "user_has_liked": false, "likes": {"count": 11}, "tags": ["shelterdogsrock", "shelterdoggos", "dogsofinstagram", "adoptdontshop", "rescueisthenewblack", "tuesdayface", "longmonthumanesociety", "oneluckypup", "walkthosedoggos", "doggos", "adoptme", "pibbles"], "filter": "Normal", "comments": {"count": 1}, "type": "carousel", "link": "https://www.instagram.com/p/BVTLYM1APum/", "location": null, "attribution": null, "users_in_photo": [], "carousel_media": [{"images": {"thumbnail": {"width": 150, "height": 150, "url": "https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/19051539_1695266877449465_5195314972363587584_n.jpg"}, "low_resolution": {"width": 320, "height": 320, "url": "https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19051539_1695266877449465_5195314972363587584_n.jpg"}, "standard_resolution": {"width": 640, "height": 640, "url": "https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/19051539_1695266877449465_5195314972363587584_n.jpg"}}, "users_in_photo": [], "type": "image"}, {"images": {"thumbnail": {"width": 150, "height": 150, "url": "https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/19120235_1935934869953597_1323932353415872512_n.jpg"}, "low_resolution": {"width": 320, "height": 320, "url": "https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19120235_1935934869953597_1323932353415872512_n.jpg"}, "standard_resolution": {"width": 640, "height": 640, "url": "https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/19120235_1935934869953597_1323932353415872512_n.jpg"}}, "users_in_photo": [], "type": "image"}, {"images": {"thumbnail": {"width": 150, "height": 150, "url": "https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/19050177_1845200395741087_6463237417481535488_n.jpg"}, "low_resolution": {"width": 320, "height": 320, "url": "https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19050177_1845200395741087_6463237417481535488_n.jpg"}, "standard_resolution": {"width": 640, "height": 640, "url": "https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/19050177_1845200395741087_6463237417481535488_n.jpg"}}, "users_in_photo": [], "type": "image"}, {"images": {"thumbnail": {"width": 150, "height": 150, "url": "https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/19120660_686169311566471_4772788248835522560_n.jpg"}, "low_resolution": {"width": 320, "height": 320, "url": "https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19120660_686169311566471_4772788248835522560_n.jpg"}, "standard_resolution": {"width": 640, "height": 640, "url": "https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/19120660_686169311566471_4772788248835522560_n.jpg"}}, "users_in_photo": [], "type": "image"}]}]}';
// $json = json_decode($result, true);

$data = $json["data"]; //data array
$ig_0 = $data[0]; //first obj in data

var_dump($ig_0["created_time"]);
echo $b;

$ig_ts = (int) $ig_0["created_time"];

echo $b . $ig_ts . $b;

//make sure file and path is correct, this is a test file
$file = 'item.html';

//get first line, know file exists
$line = fgets(fopen($file, 'r'));

//get the id
$line = str_replace(" ", "", $line);
$line = str_replace("---", "", $line);
$line = str_replace("<!", "", $line);
$line = str_replace(">", "", $line);
$unix_ts = (int) $line;
var_dump($unix_ts);
$t_arr = array(
    "yr" => date("Y", $unix_ts),
    "dy" => date("m", $unix_ts),
    "mo" => date("d", $unix_ts)
);

//change to not equal
if ($ig_ts == $unix_ts) {
    echo "---match" . $b;
    //name from caption
    $caption = explode(" ", $ig_0["caption"]["text"]);
    $name = $caption[0];
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
    $ig_img = $ig_0["images"]["thumbnail"]["url"];

    //md prepend vars
    $write = array_fill_keys(array("ts", "title", "desc", "image"), "");
    $write["ts"] = "<!--- " . $ig_ts . " --->";
    $write["title"] = "## " . $name;
    $write["desc"] = "[Adopt at " . $loc . " Humane Society](" . $site . ")";
    $write["image"] = "![Picture of " . $name . "](" . $ig_img . ")";

    var_dump($write);
    $write_str = implode($b, $write);

    var_dump($write_str);

    prependStr($write_str, $file);
    echo "---done" . $b;

    //write the code to update git

}



exit();
