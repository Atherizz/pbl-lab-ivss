<?php

namespace App\Http\Services;

use App\Models\UserModel;

class AIService
{
    private string $endpoint;
    public $userModel;

    public function __construct()
    {
        $this->endpoint = $_ENV['IVSS_AI_BASE_URL'];
        $this->userModel = new UserModel();
    }

    private function callAIService(string $path, string $method = 'GET', ?array $data = null)
    {
        $url = $this->endpoint . '/' . $path;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        if ($method === 'POST' && $data !== null) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($data))
            ]);
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['error' => "cURL Error: $error"];
        }

        if ($httpCode !== 200) {
            return ['error' => "HTTP Error: $httpCode", 'response' => $response];
        }

        return json_decode($response, true);
    }

    public function upsertVector(array $publications): array
    {
        if (empty($publications)) {
            return [
                'success' => false,
                'error' => 'No publications provided'
            ];
        }

        $requestData = [
            'publications' => $publications
        ];

        $result = $this->callAIService('upsert-publication', 'POST', $requestData);

        if (isset($result['error'])) {
            return [
                'success' => false,
                'error' => $result['error']
            ];
        }

        if (!isset($result['success']) || $result['success'] !== true) {
            return [
                'success' => false,
                'error' => $result['message'] ?? 'Unknown error from AI service'
            ];
        }
        return [
            'success' => true,
            'message' => $result['message'] ?? 'Successfully upserted publications',
            'count' => $result['count'] ?? 0
        ];
    }

    public function getRecommendation(string $title) {
        if ($title === '' || empty($title)) {
            return [
                'success' => false,
                'error' => 'No title provided'
            ];
        }

        $requestData = [
            'title' => $title
        ];

        $result = $this->callAIService('get-recommendation', 'POST', $requestData);

        if (isset($result['error'])) {
            return [
                'success' => false,
                'error' => $result['error']
            ];
        }

        if (!isset($result['success']) || $result['success'] !== true) {
            return [
                'success' => false,
                'error' => $result['message'] ?? 'Unknown error from AI service'
            ];
        }

        $recommendations = $result['data'] ?? [];
        
        if (!empty($recommendations)) {
            foreach ($recommendations as &$lecturer) {
                $nidn = $lecturer['nidn'] ?? null;
                
                if ($nidn) {
                    $user = $this->userModel->getByRegNumber($nidn);
                    $lecturer['lecturer_name'] = $user['name'] ?? 'Unknown';
                }
            }
            unset($lecturer); 
        }

        return [
            'success' => true,
            'data' => $recommendations
        ];
    }

}
