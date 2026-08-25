<?php
$functions = get_defined_functions();
echo count($functions['internal']);

$intFuncs = $functions['internal'];
foreach ($intFuncs as $funcs){
    echo $funcs . "<br>";
}