<?php
require __DIR__ . '/../vendor/autoload.php';
$class = 'App\\Http\\Controllers\\WorkerController';
echo "class_exists: "; var_export(class_exists($class)); echo PHP_EOL;
if (!class_exists($class)) {
    echo "Declared classes snippet:\n";
    foreach (get_declared_classes() as $c) {
        if (str_starts_with($c, 'App\\Http\\Controllers')) {
            echo " - $c\n";
        }
    }
    exit(0);
}
$rc = new ReflectionClass($class);
echo "File: " . $rc->getFileName() . PHP_EOL;
echo "Methods:\n";
foreach ($rc->getMethods(ReflectionMethod::IS_PUBLIC) as $m) {
    if ($m->getDeclaringClass()->getName() === $class) {
        echo " - " . $m->getName() . PHP_EOL;
    }
}
