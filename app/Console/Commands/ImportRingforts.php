<?php

namespace App\Console\Commands;

use App\Models\Ringfort;
use Illuminate\Console\Command;

class ImportRingforts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ringforts:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        //set the path for the csv files
        //$path = base_path("resources/csv/Archaeology25112016.csv");
        $path = base_path("resources/csv/ASI_08032018.csv");

        //run 2 loops at a time
        foreach (array_slice(glob($path), 0, 2) as $file) {

            //read the data into an array
            $data = array_map('str_getcsv', file($file));

            //loop over the data
            foreach ($data as $row) {
                $keys = array('RATH', 'CASH', 'RIFO');

                if (in_array($row[1], $keys)) {
                    $this->info("Inserting ".$row[0].' - '.$row[1]);

                    //insert the record
                    Ringfort::create(
                        ['entity_id' => $row[0],
                        'classcode' => $row[1],
                        'classdesc' => $row[6],
                        'smrs' => $row[7],
                        'tland_names' => $row[8],
                        'org_lat' => $row[9],
                        'org_long' => $row[10],
                        'link' => $row[11]
                        ]
                    );
                }
            }
        }
    }
}
