<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$columns = Illuminate\Support\Facades\DB::select('DESCRIBE users');
foreach ($columns as $column) {
    if ($column->Field === 'rol') {
        echo "✅ El campo 'rol' está en la base de datos!\n";
        echo "Tipo: " . $column->Type . "\n";
        echo "Predeterminado: " . $column->Default . "\n";
    }
}
