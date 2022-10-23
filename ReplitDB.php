<?php

namespace Dannsbass;

use Exception;

final class ReplitDB
{
    /**
     * @var string $REPLIT_DB_URL
     * variable to store $REPLIT_DB_URL
     */
    public static $REPLIT_DB_URL = '';

    /**
     * @var string $REPLIT_DB_URL
     */
    public function __construct(string $REPLIT_DB_URL = '')
    {
        if(empty($REPLIT_DB_URL)){
            self::$REPLIT_DB_URL = getenv('REPLIT_DB_URL');
        }else{
            self::$REPLIT_DB_URL = $REPLIT_DB_URL;
        }
    }
    /**
     * 
     */
    public static function getURL()
    {
        return self::$REPLIT_DB_URL;
    }
    /**
     * 
     */
    public function http_request(array $content = [], string $method = 'POST', $path = '')
    {
        if (count($content) > 1) {
            throw new Exception('Content array must contain ONLY one key and one value');
        }
        
        if (empty($path)) {
            $url = self::$REPLIT_DB_URL;
        } else {
            $url = self::$REPLIT_DB_URL . $path;
        }
        
        $stream = [
            'http' => [
                'method' => $method,
                'content' => http_build_query($content)
            ]
        ];
        return file_get_contents($url, false, stream_context_create($stream));
    }
    /**
     * 
     */
    public function set_data($key, $value)
    {
        return $this->http_request([$key => $value], 'POST');
    }
    /**
     * @var string | array $key
     * key of data to be deleted
     */
    public function delete_data($key)
    {
        if(is_array($key)){
            foreach ($key as $value) {
                $this->http_request([], 'DELETE', '/' . $value);
            }
            return;
        }
        return $this->http_request([], 'DELETE', '/' . $key);
    }
    /**
     * @var string $prefix
     * prefix of data key
     */
    public function get_keys(string $prefix = '')
    {
        return file_get_contents(self::$REPLIT_DB_URL . '?prefix=' . $prefix) . PHP_EOL;
    }
    /**
     * @var string $key
     * data key
     */
    public function get_data(string $key)
    {
        return file_get_contents(self::$REPLIT_DB_URL . '/' . $key);
    }
}
