<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixBeritaSequence extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:berita-sequence';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix the tbl_berita sequence to match the current max id';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Get the current max id from tbl_berita
            $maxId = DB::table('tbl_berita')->max('id_berita');
            
            if ($maxId === null) {
                $this->info('Table tbl_berita is empty. Setting sequence to 1.');
                DB::statement("SELECT setval('tbl_berita_id_berita_seq', 1, false);");
            } else {
                $this->info("Current max id_berita: {$maxId}");
                // Reset the sequence to the max id
                DB::statement("SELECT setval('tbl_berita_id_berita_seq', {$maxId});");
                $this->info("Sequence tbl_berita_id_berita_seq has been reset to {$maxId}");
            }
            
            // Verify the sequence
            $result = DB::select("SELECT last_value FROM tbl_berita_id_berita_seq;");
            $this->info("Verified - Current sequence value: " . $result[0]->last_value);
            
            $this->info('✓ Berita sequence fixed successfully!');
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Error fixing sequence: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
