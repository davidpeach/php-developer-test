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
            $rawUser->setExternalId($rawData['id']);
            $rawUser->setEmail($rawData['email']);
            $rawUser->setFirstName($rawData['first_name']);
            $rawUser->setLastName($rawData['last_name']);
            $rawUser->setAvatar($rawData['avatar']);
            return $rawUser;
        });
    }
}