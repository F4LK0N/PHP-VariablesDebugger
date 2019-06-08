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
        <li>Display object instance public, protected and private attributes and methods.</li>
        <li>Display object static public, protected and private attributes and methods.</li>
        <li>HTML structured results.</li>
        <li>Customizable layout focused on improved reading.</li>
        <li>Small and easy to type functions names (VD and VDD).</li>
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
        <?php
            //Null
            VD(null);


            //Booleans
            VD(true);
            VD(false);


            //Integers
            VD(1);
            VD(0);
            VD(-1);


            //Floats
            VD(1.234);
            VD(1.2e3);
            VD(7E-10);


            //Strings
            VD("");
            VD("Lorem Ipsum");
            VD("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porttitor pulvinar turpis at condimentum. Suspendisse nec magna euismod nisi volutpat vestibulum. Phasellus commodo augue nec nibh tristique, molestie placerat felis vehicula. Cras in eros venenatis, varius libero quis, varius risus. Phasellus eu faucibus tellus, ac tristique est. Ut non eleifend nibh. In lobortis neque vel est cursus maximus. Praesent sodales odio felis, mattis convallis turpis imperdiet id. Ut tempus, turpis at venenatis gravida, lacus enim tincidunt nisl, a ornare enim ante at ex. Donec efficitur dignissim neque, posuere ornare risus bibendum eget. Nunc sed finibus felis. Vivamus sed eleifend urna. Mauris vestibulum ultricies eros, et vehicula tortor vehicula nec.");


            //Arrays
            VD([]);
            VD(['a', 'b', 'c']);
            VD([['a', 'b', 'c'],['a', 'b', 'c'],['a', 'b', 'c']]);


            //Objects
            $temp = new stdClass();
            VD($temp);

            $temp = new stdClass();
            $temp->attributeA = "Aaa";
            $temp->attributeB = "bBb";
            $temp->attributeC = "ccC";
            VD($temp);

            class Temp
            {
                static public $staticPublicAttributeA = "static public A";
                static protected $staticProtectedAttributeA = "static protected A";
                static private $staticPrivateAttributeA = "static private A";

                public $publicAttributeA = "public A";
                public $publicAttributeB = "public B";
                public $publicAttributeC = "public C";
                protected $protectedAttributeA = "protected A";
                protected $protectedAttributeB = "protected B";
                protected $protectedAttributeC = "protected C";
                private $privateAttributeA = "private A";
                private $privateAttributeB = "private B";
                private $privateAttributeC = "private C";



                static public function staticPublicMethodA (){}
                static protected function staticProtectedMethodA (){}
                static private function staticPrivateMethodA (){}

                public function publicMethodA (){}
                public function publicMethodB (){}
                protected function protectedMethodA (){}
                protected function protectedMethodB (){}
                private function privateMethodA (){}
                private function privateMethodB (){}

                final public function finalMethodA (){}
                final protected function finalMethodB (){}
                final private function finalMethodC (){}
            }

            $temp = new Temp();
            VD($temp);

            $temp = new Temp();
            $temp->customA = "custom A";
            $temp->customB = "custom B";
            $temp->customC = "custom C";
            VD($temp);


            //Resources

        ?>
    </p>
</body>
</html>