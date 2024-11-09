<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeocodeController extends Controller
{
    public function geocode(Request $request): array
    {
        // dd('geocode');
        $address = $request->address;
        $accessToken = env('MAPBOX_API_KEY');

        // dd($accessToken);

        $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json?access_token={$accessToken}";

        $response = Http::get($url);

        return $response->json();
    }
}
