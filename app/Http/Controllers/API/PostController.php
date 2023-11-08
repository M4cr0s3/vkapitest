<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Service\VkApiClient;
use App\Models\City;
use App\Models\Post;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function __invoke()
    {
        $posts = Cache::remember('posts:all', 60 * 60, function () {
            return Post::query()
                ->get();
        });
        dd($posts);
    }

    /**
     * @throws GuzzleException
     */
    public function findCity(Request $request): JsonResponse
    {
        $cityName = $request->get('city_name');

        if (empty($cityName)) {
            return response()->json(['error' => 'City name is required.'], 400);
        }

        $queryParams = [
            'v' => env('VK_VERSION'),
            'access_token' => env('VK_API_KEY'),
            'q' => $cityName,
        ];

        $client = new VkApiClient();

        try {

            $result = $client->apiClient->get('method/database.getCities?' . http_build_query($queryParams));

            $jsonData = json_decode($result->getBody()->getContents(), true);

            if (isset($jsonData['response']['items'])) {
                $items = $jsonData['response']['items'];

                foreach ($items as $item) {

                    $cacheKey = 'city:' . $item['id'];
                    if (!Cache::has($cacheKey)) {
                        $data = [
                            'title' => $item['title'],
                            'region' => $item['region'] ?? null,
                            'area' => $item['area'] ?? null,
                            'country' => $item['country'] ?? null,
                        ];

                        City::updateOrInsert(['id' => $item['id']], $data);

                        Cache::put($cacheKey, $data, 60 * 60);
                    }
                }

                return response()->json([
                    'cities' => array_slice($items, 0, 5)
                ]);
            } else {
                return response()->json(['error' => 'No cities found.'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching data from VK API.'], 500);
        }
    }
}
