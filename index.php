<?php

/*
*
*
* For this script to work, you will need to create a crontab.
* Check the cron.sh file in this repo for an example
*
*/
function search($q){
    $working = [];
    $instances = json_decode(file_get_contents("instances.json"), true);
    //print_r($instances);
    $n = 0;
    foreach($instances as $instance)
    {
        //print($instance["git_url"]);
        foreach($instance as $key => $value){
            if(str_starts_with($key, "https") && !str_ends_with($key, "onion/") && !str_ends_with($key, "i2p/")){
                if(!isset($instance[$key]["error"])){
                    array_push($working, $key);
                }
            }
        }
    }
    $number = count($working);
    $picked = $working[random_int(0,$number)];
    $locate = $picked . "search?q=" . $q;
    return $locate;
}



if($_GET["q"]){
    header("Location: " . search($_GET["q"]));
}else{
    echo file_get_contents("home.html");
}