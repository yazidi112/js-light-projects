<?php

$content = file_get_contents("data.txt");   
if(isset($_POST['player'])){
    $player = $_POST['player'];
    $xo     = $_POST['xo'];
    $i      = $_POST["i"];
    $j      = $_POST["j"];
    
    $content.= "$player;$xo;$i;$j\n";
    file_put_contents("data.txt",$content);
}elseif(isset($_POST['reset'])){
    file_put_contents("data.txt","");
}else{
    $tours = explode("\n",$content);
    $array = [];
    foreach($tours as $tour){
        $items = explode(";",$tour);
        $tourarr = [];
        foreach($items as $item){
            $tourarr[] =  $item;
        }
        $array[] = $tourarr;
    }
    array_pop($array);
    echo json_encode($array);
}
