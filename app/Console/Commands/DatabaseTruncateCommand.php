<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class DatabaseTruncateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate database tables.';
    /**
     * @var DatabaseManager
     */
    private $db;
    private $exclude = [];
    private $truncatedCount = 0;

    /**
     * @param DatabaseManager $db
     */
    public function __construct(DatabaseManager $db)
    {
        parent::__construct();
        $this->db = $db;
        $this->exclude = [];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->confirm('Are you sure you want to truncate all your tables? [yes|no]')) {
            $this->initializeTruncate();
        } else {
            $this->info('Command aborted.');
        }
    }

    private function initializeTruncate()
    {
        $schema = $this->db->getDoctrineSchemaManager();
        $tables = $schema->listTableNames();
        $this->truncateTables($tables);
    }

    /**
     * @param $tables
     */
    private function truncateTables($tables)
    {
        $this->truncatedCount = 0;
        foreach ($tables as $table) {
            if (!in_array($table, $this->exclude)) {
                $this->truncatedCount++;
                $this->db->statement('SET FOREIGN_KEY_CHECKS=0;');
                $this->db->statement("TRUNCATE TABLE $table");
                $this->db->statement('SET FOREIGN_KEY_CHECKS=1;');
                $this->info("Table $table successfully truncated.");
            }
        }
        $this->info("Total table(s) truncated: {$this->truncatedCount}");
    }
}
