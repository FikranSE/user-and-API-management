<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiKeyMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $apiKey = $request->getHeaderLine('X-API-Key');
        if (!$this->isValidApiKey($apiKey)) {
            return service('response')->setStatusCode(401)->setJSON(['error' => 'Invalid API Key']);
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }

    private function isValidApiKey($apiKey)
    {
        return ($apiKey === 'api123');
    }
}