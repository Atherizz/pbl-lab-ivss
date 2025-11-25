<?php

namespace App\Http\Services;

use App\Exception\SiakadException;


class SiakadService
{
    private string $siakadUrl;

    public function __construct()
    {
        $this->siakadUrl = $_ENV['SIAKAD_URL'] ?? 'https://siakad.polinema.ac.id';
    }


    public function login(string $nimNip, string $password): bool
    {
        $payload = http_build_query([
            'username' => $nimNip,
            'password' => $password
        ]);

        $headers = [
            'X-Requested-With: XMLHttpRequest',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'Origin: ' . $this->siakadUrl,
            'Referer: ' . $this->siakadUrl . '/',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36',
        ];

        $ch = curl_init($this->siakadUrl . '/login');

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 10, 
        ]);

        $response = curl_exec($ch);
        
        if ($response === false) {
            error_log('SIAKAD cURL Error: ' . curl_error($ch));
            curl_close($ch);
            return false;
        }   

        curl_close($ch);

        if (strpos($response, 'Salah') !== false) {
            return false;
        }

        return true;
    }
}