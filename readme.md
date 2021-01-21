# F4LK0N - PHP Var Debugger
A dev tool in your hand.
Personal Otavio Soria's PHP variables debugger.

## About

I initially made this debuggers functions as an easy var_dump alternative, to when you can't use var_dump for any reason or when you can format the result in a more human readable way because of servers limitations or any other reason;
It's strong points are:

- Accepts variables containing nulls, booleans, integers, floats, strings, arrays, objects and resources.
- Display all object instance and static attributes and methods.
- Display object attributes and methods modifiers (public, protected, private, abstract, final).
- HTML structured results.
- Customizable layout colored and spaced, focused on improve reading.
- Small and easy to type function names (VD and VDD).
- No external dependencies.

## Installation

Get the source file located at '_framework/helpers/fkn-variables-debugger.php'; Put the file inside your project logical structure; Require the file at your project initialization; You are ready to go!
Usage

## Usage
You just need to call the VD or VDD function passing the variable you want to debug as parameter.
Example:

    VD($foo);   //Will display de var
    VD($foo2);  //Will display de var
    VDD($foo3); //Will display de var and call die();


