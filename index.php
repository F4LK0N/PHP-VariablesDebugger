<?php

header('Content-Type: text/html; charset=utf-8');

require "_framework/loader.php";

?><html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>Otavio Soria PHP Variables Debugger</title>
</head>
<body>
    <h1>Otavio Soria's Personal PHP Variables Debugger</h1>
    <p>
        A dev tool in your hand.
    </p>


    <h2>About</h2>
    <p>
        I initially made this debuggers functions as an easy var_dump alternative, to when you can't use var_dump for any reason or when you can format the result in a more human readable way because of servers limitations or any other reason;<br>
        It's strong points are:
    </p>
    <ul>
        <li>Accepts variables containing <b>nulls</b>, <b>booleans</b>, <b>integers</b>, <b>floats</b>, <b>strings</b>, <b>arrays</b>, <b>objects</b> and <b>resources</b>.</li>
        <li>HTML structured results.</li>
        <li>Customizable layout focused in improve reading.</li>
        <li>Small and easy to type functions name's.</li>
        <li>No external dependencies.</li>
    </ul>


    <h2>Installation</h2>
    <p>

    </p>


    <h2>Usage</h2>
    <p>

    </p>


    <h2>Profiling</h2>
    <p>
        The script profiling are:
    </p>
    <table>
        <tr>
            <td><?= $profiling['timing']; ?></td>
            <td>milliseconds to load.</td>
        </tr>
        <tr>
            <td><?= $profiling['memory']; ?></td>
            <td>bytes of memory used.</td>
        </tr>
        <tr>
            <td><?= $profiling['memory_real']; ?></td>
            <td>bytes of real memory used.</td>
        </tr>
        <tr>
            <td><?= $profiling['memory_peak']; ?></td>
            <td>bytes of memory used on peak.</td>
        </tr>
        <tr>
            <td><?= $profiling['memory_peak_real']; ?></td>
            <td>bytes of real memory used on peak.</td>
        </tr>
    </table>


    <h2>Examples</h2>
    <p>

    </p>
</body>
</html>