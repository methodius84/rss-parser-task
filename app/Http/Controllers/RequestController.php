<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Image;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\TransferStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    private float $totaltime;
    public function getTotalTime(){
        return $this->totaltime;
    }
    public function setTotalTime(float $time){
        $this->totaltime = $time;
    }
    public function getRSS(){
        ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:16.0) Gecko/20100101 Firefox/16.0');
        $link = config('services.rbc.test');
        $client = new Client();
        try {
            $response = $client->get($link, [
                'on_stats' => function(TransferStats $stats){
                    $this->setTotalTime($stats->getTransferTime());
                }
            ]);
            Log::channel('db')->debug('success',[
                'timestamp' => Carbon::now(),
                'method' => 'GET',
                'url' => $link,
                'code' => $response->getStatusCode(),
                'body' => json_encode($response->getBody()->getContents()),
                'time' => $this->getTotalTime(),
            ]);
        }
        catch (GuzzleException $exception){
            Log::channel('db')->log('failed',[
                'method' => 'GET',
                'url' => $link,
                'code' => $exception->getCode(),
                'body' => json_encode($exception->getMessage()),
                'time' => $this->getTotalTime(),
            ]);
        }
        $xml = simplexml_load_string($response->getBody());
        //print_r($xml);


        foreach ($xml->channel->item as $item){
            $guid = explode('::', (string)$item->guid)[1];
            $title = (string)$item->title;
            $pubDate = Carbon::parse((string)$item->pubDate)->toDateTimeString();
            $description = (string)$item->description;

            $author = (string)$item->author ?? null;

            $imagesCount = 0;

            $article = new Article();
            $article->updateOrCreate(
                [
                    'guid' => $guid,
                ],
                [
                    'title' => $title,
                    'publish_date' => $pubDate,
                    'text' => $description,
                    'author' => $author,
                ]
            );
            foreach ($item->enclosure as $enclosure){

                if((string)$enclosure->attributes()->type === 'image/jpeg'){
                    //print_r($guid."\n".(string)$enclosure->attributes()->url."\n");
                    $path = 'storage/app/'.$guid.$imagesCount.'.jpeg';
                    $response = $client->request('GET', (string)$enclosure->attributes()->url, [
                        'sink' => $path,
                        'on_stats' => function(TransferStats $stats){
                            $this->setTotalTime($stats->getTransferTime());
                        }
                    ]);
                    Log::channel('db')->info('', [
                        'method' => 'GET',
                        'url' => (string)$enclosure->attributes()->url,
                        'code' => $response->getStatusCode(),
                        'body' => json_encode(base64_encode($response->getBody()->getContents())),
                        'time' => $this->getTotalTime(),
                    ]);

                    Image::updateOrCreate(
                        [
                            'image_path' => $path,
                        ],
                        [
                            'article_id' => Article::whereGuid($guid)->first()->guid,
                        ]
                    );
                }
            }
        }
    }
}
