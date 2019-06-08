<?php

//Profiling
$profiling = [
    //Timing
    "timing" => microtime(true),
    //Memory
    "memory" => memory_get_usage(false),
    "memory_real" => memory_get_usage(true),
    //Memory Peak
    "memory_peak" => memory_get_usage(false),
    "memory_peak_real" => memory_get_usage(true),
];



//Sources
{
    //require "helpers/0-some-helper.php";
    //require "helpers/1-another-helper.php";
    //require "helpers/2-one_more_helper.php";
    require "helpers/os-variables-debugger.php";

    //require "your_framework_files/0-some_code.php";
    //require "your_framework_files/1-another_code.php";
    //require "your_framework_files/2-more_code.php";
}



//Profiling
$profiling = [
    //Timing
    "timing" => (int)((microtime(true) - $profiling['timing'])*1000),
    //Memory
    "memory" => memory_get_usage(false) - $profiling['memory'],
    "memory_real" => memory_get_usage(true) - $profiling['memory_real'],
    //Memory Peak
    "memory_peak" => memory_get_peak_usage(false) - $profiling['memory_peak'],
    "memory_peak_real" => memory_get_peak_usage(true) - $profiling['memory_peak'],
];

