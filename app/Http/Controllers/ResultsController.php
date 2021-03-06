<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\SearchTerm;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Store result to DB
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        return Result::create([
            'score'          => $request->score,
            'search_term_id' => $request->searchTermId
        ]);
    }

    /**
     * Get all result entities
     *
     * @return Result[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $results = SearchTerm
            ::join('results', 'results.search_term_id', '=', 'search_terms.id')
            ->join('users', 'users.id', '=', 'search_terms.user_id')
            ->selectRaw('search_terms.value as term,
            users.name,
            results.score as score,
            results.created_at as created_at')
            ->orderBy('score', 'DESC')
            ->get()
            ->groupBy('term', 'users.name');

        $payload = [];
        foreach ($results as $resultKey => $terms) {
            foreach ($terms as $singleTerm) {
                $payload[] = $singleTerm;
            }
        }
        return $payload;
    }
}
