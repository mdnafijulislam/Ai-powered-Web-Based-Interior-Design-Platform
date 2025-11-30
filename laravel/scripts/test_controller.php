<?php
require __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../app/Http/Controllers/WorkerController.php';
var_dump(class_exists('App\\Http\\Controllers\\WorkerController'));
var_dump(array_filter(get_declared_classes(), function($c){return str_starts_with($c,'App\\Http\\Controllers');}));
