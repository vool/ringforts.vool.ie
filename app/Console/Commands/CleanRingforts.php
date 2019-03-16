<?php

namespace App\Console\Commands;

use App\Models\Ringfort;
use Illuminate\Console\Command;

class CleanRingforts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ringforts:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete (soft) bad locations';

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
      /*
      org_long 	COUNT(`org_lat`)
      46.4881814 	-15.8173143 	345
      52.8006598 	-8.4256476 	2
      52.8078457 	-6.5671058 	2
      52.9991431 	-9.1848613 	2
      53.1652172 	-8.3956723 	2
      53.2187936 	-8.2299310 	2
      53.3951882 	-8.3731892 	2
      53.6021313 	-9.0002634 	2
      54.0018176 	-7.2525840 	2

      */

        $atlantic =[46.4881814, 	-15.8173143];

        $irishsea =[53.5622279, 	-5.1633238];

        $dups = [[52.8006598, -8.4256476],
            [52.8078457, 	-6.5671058],
            [52.9991431, 	-9.1848613],
            [53.1652172, 	-8.3956723],
            [53.2187936, 	-8.2299310],
            [53.3951882, 	-8.3731892],
            [53.6021313, 	-9.0002634],
            [54.0018176, 	-7.2525840]];

        // Do Atlantic

        echo "Deleting entries from the atlantic ... ";

        $del = Ringfort::where('org_lat', '=', $atlantic[0])
                      ->where('org_long', '=', $atlantic[1])
                      ->delete();

        echo "deleted $del entries \r\n";


        // Do Irish secure

        echo "Deleting entries from the Irish Sea ... ";

        $del = Ringfort::where('org_lat', '=', $irishsea[0])
                      ->where('org_long', '=', $irishsea[1])
                      ->delete();

        echo "deleted $del entries \r\n";

        // Do Duplicates

        echo "Deleting duplicate entries ... ";

        $del = (int)0;

        foreach ($dups as $dup) {
            $foo = Ringfort::where('org_lat', '=', $dup[0])
                               ->where('org_long', '=', $dup[1]);

            if ($foo->count() > 1) {
                $foo->skip(1)->delete();

                $del ++;
            }
        }

        echo "updated $del entries \r\nAll dún !\r\n ";
    }
}
