<?php
$path = __DIR__ . '/../app/Http/Controllers/WorkerController.php';
$content = <<<'PHP'
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('worker.dashboard', compact('user'));
    }

    public function portfolio()
    {
        return view('worker.portfolio');
    }
}
PHP;
file_put_contents($path, $content);
echo "Wrote $path\n";
