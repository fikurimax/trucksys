<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteFileCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:downloaded-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all csv files after downloaded';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fullPath = public_path();
        array_map('unlink', glob("$fullPath/*.csv"));

        return 0;
    }
}
