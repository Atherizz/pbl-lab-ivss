<?php 
namespace App\Http\Services;

class ScholarService {
    private $apiKey;
    
    public function __construct() {
        $this->apiKey = $_ENV['SERPAPI_KEY'];
    }

    private function callSerpAPI($params) {
        $params['api_key'] = $this->apiKey;
        $url = 'https://serpapi.com/search.json?' . http_build_query($params);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode !== 200) {
            return ['error' => "HTTP Error: $httpCode"];
        }
        
        return json_decode($response, true);
    }

    public function getAuthorPublications($authorId, $getAllPages = false) {
        $allArticles = [];
        $start = 0;
        $hasNextPage = true;
        $pageCount = 0;
        $maxPages = 10;
        
        while ($hasNextPage && $pageCount < $maxPages) {
            $params = [
                'engine' => 'google_scholar_author',
                'author_id' => $authorId,
            ];
            
            if ($start > 0) {
                $params['start'] = $start;
            }
            
            $result = $this->callSerpAPI($params);
            
            if (isset($result['error'])) {
                return [
                    'error' => $result['error'],
                    'articles' => $allArticles,
                    'total_articles' => count($allArticles)
                ];
            }
            
            if (isset($result['articles']) && is_array($result['articles'])) {
                $allArticles = array_merge($allArticles, $result['articles']);
            }
            
            $pageCount++;
            
            if ($getAllPages && 
                isset($result['serpapi_pagination']['next']) && 
                !empty($result['serpapi_pagination']['next'])) {
                $start += 20;
                sleep(1);
            } else {
                $hasNextPage = false;
            }
        }
        
        return [
            'author' => $result['author'] ?? null,
            'articles' => $allArticles,
            'cited_by' => $result['cited_by'] ?? null,
            'total_articles' => count($allArticles),
            'pages_loaded' => $pageCount
        ];
    }

    public function extractAuthorId($scholarUrl) {
        preg_match('/user=([a-zA-Z0-9_-]+)/', $scholarUrl, $matches);
        return $matches[1] ?? null;
    }
}