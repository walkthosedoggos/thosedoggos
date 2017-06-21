<?php
require "config.php";


function push($gh_user, $gh_pass) {
  $gh_url = "github.com/";
  $repo = "thosedoggos.git";
  $branch = "master";
  $push = "git push https://" . $gh_user . ":" . $gh_pass . "@" . $gh_url . $gh_user . "/" . $repo . " " . $branch;

  try {
    exec($push, $output);
    return $output;
  }
  catch(Exception $e) {
    return $e->getMessage();
  }
}

function add() {
  $add = "git add -u";
  try {
    exec($add, $output);
    return $output;
  }
  catch(Exception $e) {
    return $e->getMessage();
  }
}

function commit($ts) {
  $commit = 'git commit -m "Added post ' . $ts . '"';
  try {
    exec($commit, $output);
    return $output;
  }
  catch(Exception $e) {
    return $e->getMessage();
  }
}


function status () {
  try {
    exec("git status", $output);
    return $output;
  }
  catch(Exception $e) {
    return $e->getMessage();
  }
}
// exec("git add -u");
// exec("git commit -m \"commit through command\"");
// echo $push . "\r\n";
 ?>
