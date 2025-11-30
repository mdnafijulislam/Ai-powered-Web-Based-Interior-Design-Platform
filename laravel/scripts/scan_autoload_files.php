<?php
require __DIR__ . '/../vendor/composer/autoload_static.php';
$ref = new ReflectionClass('Composer\\Autoload\\ComposerStaticInitc514d8f7b9fc5970bdd94287905ef584');
$filesProp = $ref->getProperty('files');
$filesProp->setAccessible(true);
$files = $filesProp->getValue();
foreach ($files as $id => $file) {
    if (!file_exists($file)) continue;
    $s = file_get_contents($file);
    if ($s !== false && (strpos($s, "namespace App\\Http\\Controllers") !== false || strpos($s, "return view('worker.portfolio')") !== false)) {
        echo "MATCH: $file\n";
    }
}
