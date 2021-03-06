<?php

namespace App\Http\Controllers;

use App\Service\ApiService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class VoteController extends Controller
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
     *
     * @return string
     */
    public function execute(Request $request)
    {
        $imdbId = $request->imdbID;
        $score = $request->score;

        $data = $this->apiService->get([
            'i'      => $imdbId,
            'apikey' => $this->apiKey
        ]);

        $body = json_decode($data);

        return $body->imdbRating;
    }
}
