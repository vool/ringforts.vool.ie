<?php

namespace App\Console\Commands;

use Log;
use File;
use Config;
use Twitter;
use Storage;
use App\Models\Ringfort;
use Illuminate\Console\Command;
use \OpenCage\Geocoder\Geocoder;
use \InstagramAPI\Instagram;
use \InstagramAPI\Media\Photo\InstagramPhoto;

class PostRingfort extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ringforts:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post ringfort image/info to the social net !';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // Get the entries which have not been posted, or marked bad (status -1), ordered by status and priorty
        $this->ringfort = Ringfort::whereNull('posted')->where('status', '>=', '0')->orderBy('priority', 'desc')->orderBy('status', 'desc')->first();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->ringfort) {
            $url = "https://dev.virtualearth.net/REST/V1/Imagery/Map/Aerial/".$this->ringfort->lat."%2C".$this->ringfort->long."/18?mapSize=1000,1000&format=png&key=".Config::get('services.bing.maps_api_key');

            $contents = file_get_contents($url);

            $name = $this->ringfort->entity_id.".png";

            if (Storage::put('posted/'.$name, $contents)) {
                echo "Downloaded ".$url;


                $this->image = storage_path('app/posted/'.$name);

                $geocoder = new Geocoder(Config::get('services.opencage.key'));

                $oc_result = $geocoder->geocode($this->ringfort->lat.",".$this->ringfort->long);

                $this->status = $this->ringfort->classdesc."\r\n\r\n";

                if (isset($this->ringfort->tland_names)) {
                    $this->status .= $this->ringfort->tland_names.", \r\n";
                }


                if (isset($oc_result['results'][0]['components']['county'])) {
                    $this->status .= $oc_result['results'][0]['components']['county']."\r\n";
                }

                if (isset($oc_result['results'][0]['components']['state_district'])) {
                    $this->status .= $oc_result['results'][0]['components']['state_district']."\r\n";
                }


                $this->status .= "Ireland \r\n";

                $this->status .= "\r\n".$this->ringfort->entity_id."\r\n";
                $this->status .= "\r\n".$this->ringfort->smrs."\r\n\r\n";

                $this->status .= "\r\nhttps://maps.archaeology.ie/historicenvironment/?SMRS=".$this->ringfort->smrs."\r\n\r\n";

                // hash tags
                $this->status .= "#everyringfort \r\n";

                // extras
                //$this->status .= "";

                $this->doTwitter();

                $this->doInstagram();

                //some check ?
                $this->ringfort->posted = now();

                $this->ringfort->save();
            }
        }
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function dotwitter()
    {
        $loc = Twitter::getGeoSearch(['lat' =>$this->ringfort->lat, 'long' => $this->ringfort->long]);

        $loc_id = isset($loc->result) ? $loc->result->places[0]->id : NULL;

        $uploaded_media = Twitter::uploadMedia(['media' => File::get($this->image)]);//'/home/keith/projects/ringforts.vool.ie/public/be_soft.png')]);
        return Twitter::postTweet(['status' => $this->status,
  'media_ids' => $uploaded_media->media_id_string,
  'place_id' => $loc_id
]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function doInstagram()
    {
        set_time_limit(0);
        date_default_timezone_set('UTC');


        /* IG Confs */

        $debug = true;
        $truncatedDebug = true;

        $ig = new Instagram($debug, $truncatedDebug);

        try {
            $ig->login(Config::get('services.instagram.username'), Config::get('services.instagram.password'));
        } catch (\Exception $e) {
            Log::error("Instagram login error: ".$e->getMessage());
            echo 'Instagram login error: '.$e->getMessage()."\n";
        }

        try {
            $loc = $ig->location->search($this->ringfort->lat, $this->ringfort->long)->getVenues()[0];
            $photo = new InstagramPhoto($this->image);
            $ig->timeline->uploadPhoto($photo->getFile(), [
              'caption' => $this->status,
              'location' => $loc
      ]);
        } catch (\Exception $e) {
            Log::error("Instagram upload error: ".$e->getMessage());
            echo 'Instagram upload error: '.$e->getMessage()."\n";
        }
    }
}
