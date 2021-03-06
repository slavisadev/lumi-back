<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /**
     * Search For Movies Example
     *
     * @return void
     */
    public function testSearchForMovieTitles()
    {
        $fakerName = $this->faker->name(50);
        $searchTerm = 'test';

        $response = $this->json("POST", "/api/search/" . $searchTerm, ['username' => $fakerName]);

        $response->assertStatus(200);

        $response->assertJsonStructure(['results', 'user']);

        $this->assertDatabaseHas('users', [
            'name' => $fakerName,
        ]);

        $this->assertDatabaseHas('search_terms', [
            'value' => $searchTerm,
        ]);
    }

    /**
     *
     */
    public function testVoteForMovieGrade()
    {
        $imdbID = 'tt2407380';

        $response = $this->json("POST", "/api/vote/", [
            'imdbID' => $imdbID,
            'score'  => rand(1, 9)
        ]);

        $response->assertStatus(200);
    }
}
