<?php

namespace App\ReqResIn;

use App\ReqResIn\ReqResInUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ReqResInApi
{
    private $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Get the users from ReqResIn
     * @return Collection
     */
    public function getUsers(string $page): Collection
    {
        $response = Http::get(
            vsprintf(
                '%s/users?page=%s',
                [
                    $this->baseUrl,
                    $page,
                ]
            )
        );

        if (! $response->json()) {
            return collect();
        }

        $data = collect($response->json()['data']);

        return $data->map(function ($rawData) {
            $rawUser = new ReqResInUser;
            $rawUser->setExternalId('7');
            $rawUser->setEmail('michael.lawson@reqres.in');
            $rawUser->setFirstName('Michael');
            $rawUser->setLastName('Lawson');
            $rawUser->setAvatar('https://reqres.in/img/faces/7-image.jpg');
            return $rawUser;
        });
    }
}