<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PerformanceTest
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getPerformanceScore(string $url, string $platform): ?float
    {
        $platformQuery = strtolower($platform) === 'mobile' ? 'mobile' : 'desktop';
        $apiUrl = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$url}&strategy={$platformQuery}";

        try {
            $response = $this->client->get($apiUrl);
            $data = json_decode($response->getBody(), true);
            return $data['lighthouseResult']['categories']['performance']['score'] ?? null;
        } catch (\Exception $e) {
            // Log the error or handle it appropriately
            Log::error('Performance Test Error: ' . $e->getMessage());
            return null;
        }
    }
}
