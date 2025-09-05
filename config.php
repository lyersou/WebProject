<?php


if(!isset($_SESSION))

{
    session_start();
}
$conn = mysqli_connect($servername='localhost:3307', 'root', $password='',$db='pharmaa');


?>