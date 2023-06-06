<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    // you can use this function if you want to get weather data of multiple countries at once
    public function index()
    {
        $apiKey = '54bd7c34d72f43d6a6850947230606';
        $countries = ['Estonia','New+York', 'London', 'Paris', 'Tokyo']; // Add more country names as needed

        $weatherData = [];

        foreach ($countries as $country) {
            $url = 'https://api.weatherapi.com/v1/current.json?key=' . $apiKey . '&q=' . $country;
            $response = Http::get($url);
            
            if ($response->ok()) {
                $weatherData[] = $response->json();
            } else {
                // Handle error for individual country
                $weatherData[] = ['error' => 'Failed to fetch weather data for ' . $country];
            }
        }
        
        return response()->json($weatherData);
    }

    public function getWeather()
    {
        $apiKey = '54bd7c34d72f43d6a6850947230606';
        $url = 'https://api.weatherapi.com/v1/current.json?key=' . $apiKey . '&q=New+York';
        
        $response = Http::get($url);
        
        if ($response->ok()) {
            $weatherData = $response->json();
            return response()->json($weatherData);
        } else {
            return response()->json(['error' => 'Failed to fetch weather data'], 500);
        }
    }
}
