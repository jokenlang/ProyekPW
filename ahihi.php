<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:https://www.youtube.com/watch?v=d1YBv2mWll0');
    exit;
}
