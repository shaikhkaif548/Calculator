<?php

$connection = mysqli_connect('localhost', 'root', '', 'calculator');

 if($connection) {

  // echo "we are connect";

 } else {

  die("not connected");

 }