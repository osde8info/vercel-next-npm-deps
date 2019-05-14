<?php

// now hosted on zeit now

include 'src/npm.php';

list($separator,$pack,$ver) = explode('/',$_SERVER['REQUEST_URI']);

if ($pack=='') {
  $pack='chai';
  $ver='latest';
}

$npm = new Npm;

$tree = [];
$npm->npmdeps($pack,$ver,$tree);
header('Content-Type: application/json');
echo json_encode($tree,JSON_PRETTY_PRINT);
