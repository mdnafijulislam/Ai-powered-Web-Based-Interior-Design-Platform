<?php
$path = __DIR__ . '/../app/Http/Controllers/WorkerController.php';
$contents = file_get_contents($path);
$len = strlen($contents);
echo "File length: $len\n";
$first = substr($contents,0,16);
$hex = strtoupper(bin2hex($first));
$hex_pairs = implode(' ', str_split($hex,2));
echo "First 16 bytes hex: $hex_pairs\n";
$snippet = substr($contents,0,200);
echo "Snippet (visible):\n" . $snippet . "\n---\n";
$pos_php = strpos($contents,'<?php');
echo "Position of '<?php': " . ($pos_php===false?'-1':$pos_php) . "\n";
$occ = substr_count($contents,'<?php');
echo "Count of '<?php' occurrences: $occ\n";
