<?php

use App\Models\Survey;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$questions = Survey::orderBy('urutan')->get();

echo "SURVEY_QUESTIONS_START\n";
foreach ($questions as $q) {
    echo "Q{$q->urutan}: {$q->soal}\n";
}
echo "SURVEY_QUESTIONS_END\n";
