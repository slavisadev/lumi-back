<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\SearchTerm;
use App\Models\User;
use App\Service\ApiService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use ApiResponser;

    private $apiService;
    private $apiKey = '81801d5b';

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @param Request $request
     * @param $term
     *
     * @return array
     */
    public function execute(Request $request, $term)
    {
        $user = User::create([
            'name' => $request->username
        ]);

        $data = $this->apiService->get([
            's'      => $term,
            'apikey' => $this->apiKey
        ]);

        $body = json_decode($data);

        $searchTerm = SearchTerm::create([
            'value'   => $term,
            'results' => json_encode($body->Search),
            'user_id' => $user->id
        ]);

        $results = [];

        if (count($body->Search) > 0) {
            $results = array_slice($body->Search, 0, 5);
        }

        return [
            'results'    => $results,
            'user'       => $user,
            'searchTerm' => $searchTerm
        ];
    }
}
