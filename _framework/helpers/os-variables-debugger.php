<?php

/**
 * ##########################################################################################
 * ### Otavio Soria's Personal PHP Variables Debugger ###
 * ##########################################################################################
 *
 *  Version:
 *      2.5
 *  Last Update:
 *      2019/06/08 (YYYY/MM/DD)
 *
 *  Author:
 *      Otavio Bernardes Soria
 *  Email:
 *      otaviosoria@gmail.com
 *
 * ##########################################################################################
 */





/**
 * ##########################################################################################
 * ### Caller Path Display Format ###
 * ##########################################################################################
 *
 * When you call the debugger function to debug a variable's value, the caller file's path is displayed within the number of the line where the call has made;
 * You can choose to display the absolute path of the file, or a path relative to you project's root directory, or even don't show nothing at all;
 *
 * This is done using the 'substr' function and setting the 'start' with the value defined by this variable:
 *     $GLOBALS['variable_debugger_caller_path_display_format']
 *
 * Display Format Configuration:
 *     - Display Relative Path:
 *         - Modify this line to point to the root of your application (where the first index.php is at.);
 *         - Beginning from this folder where this file are placed, add one 'dirname' function involving '__FILE__' for each directory you have to step up until you reach the root directory of your application;
 *         - Optionally to improve your framework startup performance, you can set the value to the direct integer value returned by 'strlen(dirname(...(__FILE__)))';
 *
 *     - Display Absolute Path:
 *         - Set the value to zero (0)(integer);
 *
 *     - Hide Path:
 *         - Set the value to false (boolean);
 */
$GLOBALS['variable_debugger_caller_path_display_format'] = strlen(dirname(dirname(dirname(__FILE__))));
//$GLOBALS['variable_debugger_caller_path_display_format'] = 0;
//$GLOBALS['variable_debugger_caller_path_display_format'] = false;





/**
 * ##########################################################################################
 * ### Variable Debugger and Die ###
 * ##########################################################################################
 *
 * Debugs an variable's content and stop the scripts execution at the end.
 *
 * @param mixed $mixed
 *      Any variable you want to debug.
 */
function VDD($mixed)
{
    $GLOBALS['variable_debugger_caller_distance'] = 1;
    VD($mixed, 1);
    die;
}





/**
 * ##########################################################################################
 * ### Variable Debugger ###
 * ##########################################################################################
 *
 * Debugs an variable's content.
 *
 * @param mixed $mixed
 *      Any variable you want to debug.
 *
 * @param int $callerDistance
 *      Internally used to find the right caller.
 *      - Default value is 0. The caller is 0 function calls distance from this functions, in other words its is called directly;
 *      - When value is 1 it will jump one function call and print information about the next function in the call stack;
 *      - When -1 it will ignore the call stack and don't display any info;
 */
function VD($mixed, $callerDistance=0)
{
    //Caller Distance
    if(!isset($GLOBALS['variable_debugger_caller_distance']))
        $GLOBALS['variable_debugger_caller_distance'] = 0;

    //HTTP Header
    if($callerDistance===0)
        @header("Content-Type: text/html; charset=utf-8");

    //Container
    print
        "<div class='variable-debug' style='padding:10px;border:1px solid rgba(0,0,0,0.2);'>";

    //Caller File and Line
    if($callerDistance>=0){
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $callerDistance+2);
        $caller1 = $trace[$callerDistance];
        $caller2 = @$trace[$callerDistance+1];
        print "<div style='font-size:12px;color:rgba(0,0,0,0.25);margin-bottom:8px;'><small><u>".substr($caller1['file'], $GLOBALS['variable_debugger_caller_path_display_format'], -4)."</u></small>:<b>".$caller1['line']."</b> &nbsp; - &nbsp; <small>".@$caller2['class'].@$caller2['type'].@$caller2['function']."()</small></div>";
    }

    //Variable Dump
    {
        //Type
        {
            print
                "<div style='font-size:18px';>";
            //Type Name
            print"<b>".gettype($mixed)."</b>";

            //String Length
            if(is_string($mixed)) print
                " : <b>".strlen($mixed)."</b> <small><small>char(s)</small></small>";
            //Array Size
            else if(is_array($mixed)) print
                " : <b>".count($mixed)."</b> <small><small>element(s)</small></small>";
            //Object Attributes and Methods
            else if(is_object($mixed))
            {
                $attributes=[];
                $methods=[];


                //Reflection Method Extraction
                try
                {
                    $reflectionClass = new ReflectionClass($mixed);

                    //Attributes
                    $reflectionClassAttributes = $reflectionClass->getProperties();
                    foreach($reflectionClassAttributes as $row){
                        $attributes[$row->name] = [
                            "static" => $row->isStatic(),
                            "private" => $row->isPrivate(),
                            "protected" => $row->isProtected(),
                            "public" => $row->isPublic(),
                            "value" => "",
                        ];
                        $row->setAccessible(true);
                        $attributes[$row->name]["value"] = $row->getValue($mixed);
                    }
                    unset($reflectionClassAttributes, $row);

                    //Methods
                    $reflectionClassMethods = $reflectionClass->getMethods();
                    foreach($reflectionClassMethods as $row){
                        $methods[$row->name] = [
                            "abstract" => $row->isAbstract(),
                            "final" => $row->isFinal(),
                            "static" => $row->isStatic(),
                            "private" => $row->isPrivate(),
                            "protected" => $row->isProtected(),
                            "public" => $row->isPublic(),
                        ];
                    }
                    unset($reflectionClassMethods, $row);

                    unset($reflectionClass);
                }
                catch (Exception $e)
                {
                    $attributes['ERROR'] = "Reflection Exception: $e";
                }


                //Default Method Extraction
                {
                    $classAttributes = get_object_vars($mixed);
                    foreach($classAttributes as $key => $value){
                        if(isset($attributes[$key]))
                            continue;
                        $attributes[$key] = [
                            "static" => false,
                            "private" => false,
                            "protected" => false,
                            "public" => true,
                            "value" => $value,
                        ];
                    }
                    unset($classAttributes, $key, $value);
                }


                print
                    " : <b>".count($attributes)."</b> <small><small>attribute(s)</small></small> &nbsp; &nbsp; <b>".count($methods)."</b> <small><small>methods(s)</small></small>";
            }
            print
                "</div>";
        }


        //Value
        if(!is_null($mixed)){
            print
                "<div style='font-size:16px;padding:10px 18px;margin:2px 10px 0;background-color:rgba(0,0,0,0.1);border-radius:10px;'>";
            //Bool
            if(is_bool($mixed)) print
                ($mixed===true?"<b style='color:#0A0;'>TRUE</b>":"<b style='color:#A00;'>FALSE</b>");
            //Integer | Long | Float | Double
            else if(is_int($mixed) || is_float($mixed)) print
                "<b style='color:#0A0;'>$mixed</b>";
            //String
            else if(is_string($mixed)) print
                ($mixed===""?'""':$mixed);
            //Array
            else if(is_array($mixed)) {
                print"<table style='width:100%;border-collapse:collapse;'>";
                foreach ($mixed as $index => $value)
                {
                    //GLOBALS Loop Avoid
                    if($index==="GLOBALS")
                        continue;
                    //Elements
                    print
                        "<tr>".
                        //Index
                        "<th style='text-align:right;vertical-align:top;padding:15px 10px;width:10px;'>[$index]</th>".
                        //Value
                        "<td>"; VD($value, -1); print"</td>".
                    "</tr>";
                }
                print"</table>";
            }
            //Object
            else if(is_object($mixed)) {
                print"<table style='width:100%;border-collapse:collapse;'>";

                //Attributes
                foreach ($attributes as $key => $row)
                {
                    print
                        "<tr>".
                        //Key
                        "<th style='text-align:right;vertical-align:top;padding:15px 10px;width:10px;'>".
                        "<small>".
                        ($row['static']?"<b style='color:#00A;'>static</b> ":"").
                        ($row['private']?"<b style='color:#A00;'>private</b>":"").
                        ($row['protected']?"<b style='color:#AA0;'>protected</b>":"").
                        ($row['public']?"<b style='color:#0A0;'>public</b>":"").
                        "</small><br>".
                        "$key:".
                        "</th>";

                    //Value
                    print
                        "<td>"; VD($row['value'], -1); print"</td>".
                    "</tr>";
                }

                //Methods
                foreach ($methods as $key => $row)
                {
                    print
                        "<tr>".
                        //Key
                        "<th style='text-align:right;vertical-align:top;padding:15px 10px;width:10px;'>".
                        "<small>".
                        ($row['abstract']?"<b style='color:#A0A;'>abstract</b> ":"").
                        ($row['final']?"<b style='color:#A0A;'>final</b> ":"").
                        ($row['static']?"<b style='color:#00A;'>static</b> ":"").
                        ($row['private']?"<b style='color:#A00;'>private</b>":"").
                        ($row['protected']?"<b style='color:#AA0;'>protected</b>":"").
                        ($row['public']?"<b style='color:#0A0;'>public</b>":"").
                        "</small><br>".
                        "$key();".
                        "</th>";

                    //Value
                    print
                        "<td>&nbsp;</td>".
                        "</tr>";
                }

                print"</table>";
            }
            //Unknown
            else print
                "<b style='color:#A00;'>?????</b>";

            print
                "</div>";
        }
    }

    //Container
    print
        "</div>";
}







