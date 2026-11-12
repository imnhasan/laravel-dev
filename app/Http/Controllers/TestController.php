<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Feature;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
    //    $apikey = '19903b94-f6b-6963-9988-71904e358955';

        // $response = Http::withHeaders([
        //     'Api-Key' => '19903b94-f6b-6963-9988-71904e358955',
        //     'Accept' => 'application/json'
        // ])
        //     ->withoutVerifying()  // Disable SSL verification for self-signed certificate (similar to `-k` in cURL)
        //     ->get('https://electronicfirst.test/supply/najmul-test');
        // dd($response->json());



        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, "https://electronicfirst.test/supply/najmul-test");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Get the response as a string
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  // Follow redirects

      // Disable SSL verification (equivalent to 'withoutVerifying' in Laravel)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // Disable host verification (optional)


        // Add headers if needed
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Api-Key: 19903b94-f6b-6963-9988-71904e3589550',
            'Accept: application/json',
            'X-API-Key: 19903b94-f6b-6963-9988-71904e358955',  // Replace {{token}} with your actual token
        ]);

        // Execute cURL request and get the response
        $response = curl_exec($ch);

        // Check if there was an error with the cURL request
        if (curl_errno($ch)) {
            // If error, return it
            return response()->json(['error' => curl_error($ch)], 500);
        }

        // Close cURL session
        curl_close($ch);

        // Optionally, decode the JSON response
        $data = json_decode($response, true);

        // Return the response as JSON
        return response()->json($data);

    }
}
