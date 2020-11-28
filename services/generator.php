<?php

    function gerar(){
        $all_str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $cd = "";
        for($i=0;$i<10;$i++) {
            $cd .= $all_str[mt_rand(0, 61)];
        }
        return $cd;
    }
?>