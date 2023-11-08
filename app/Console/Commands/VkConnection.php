<?php

namespace App\Console\Commands;

use App\Http\Service\VkApiClient;
use App\Models\City;
use Illuminate\Console\Command;

class VkConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'conn:vk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $client = new VkApiClient();
//
//        $queryParams = [
//            'v' => '5.199',
//            'need_all' => 1,
//            'access_token' => env('VK_API_KEY'),
//            'q' => 'Ниж'
//        ];

//        $query = http_build_query($queryParams);
//
//        $res = $client->apiClient->request('GET', '/method/database.getCities?' . $query);
//
//        $cities = json_decode($res->getBody()->getContents(), true);


//        foreach ($cities['response']['items'] as $city) {
//            if (!isset($city['area'])) {
//                City::firstOrcreate([
//                    'title' => $city['title'],
//                    'region' => $city['region'],
//                ], ['title' => $city['title'], 'region' => $city['region']]);
//            } else {
//                City::firstOrcreate([
//                    'title' => $city['title'],
//                    'area' => $city['area'],
//                    'region' => $city['region'],
//                ], ['title' => $city['title'], 'region' => $city['region']]);
//            }
//            var_dump();


    }
}
