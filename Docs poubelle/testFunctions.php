<?php

$text   = "\t\tThese are a few words :) ...  ";
$binary = "\x09Example string\x0A";
$hello  = "Hello World";

$trimmed = rtrim($hello, "Hdle");
var_dump($trimmed);
