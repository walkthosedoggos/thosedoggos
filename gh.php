<?php
require "config.php";
$gh_url = "github.com/";
$repo = "thosedoggos.git";
$branch = "master";

$push = "git push https://" . $gh_user . ":" . $gh_pass . "@" . $gh_url . $gh_user . "/" . $repo . " " . $branch;
// exec("git add -u");
// exec("git commit -m \"commit through command\"");
// echo $push . "\r\n";
echo "---done";

 ?>
