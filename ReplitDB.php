<?php

namespace Dannsbass;

use Exception;

final class ReplitDB
{
    /**
     * @var string $URL
     * variable to store $REPLIT_DB_URL
     */
    public static $URL = '';
    
    /**
     * @var string $file
     * file to store $REPLIT_DB_URL
     */
     public static $file = 'REPLIT_DB_URL';
    
     /**
     * @var string $replit_db_url
     */
    public function __construct(string $replit_db_url = '')
    {
        if(empty(trim($replit_db_url))){
            if(!file_exists(self::$file)) {
                system('touch ' . self::$file . ' && echo $REPLIT_DB_URL > ' . self::$file);
            }elseif(empty(trim(file_get_contents(self::$file)))){
                 throw new Exception('$REPLIT_DB_URL doesn\'t exist');
            }else{
                self::$URL = file_get_contents(self::$file);
            }
        }else{
            self::$URL = $replit_db_url;
        }
    }
    /**
     * 
     */
    public static function getURL(){
        return self::$URL;
    }
    /**
     * 
     */
    public function http_request(array $content = [], string $method = 'POST', $path = '')
    {
        if (count($content) > 1) {
            throw new Exception('content array must contain ONLY one key and one value');
        }
        $stream = [
            'http' => [
                'method' => $method,
                'content' => http_build_query($content)
            ]
        ];
        if (!empty($path)) {
            $url = self::$URL . $path;
        } else {
            $url = self::$URL;
        }
        return file_get_contents($url, false, stream_context_create($stream));
    }
    /**
     * 
     */
    function set_data($key, $value)
    {
        return $this->http_request([$key => $value], 'POST');
    }
    /**
     * @var string $key
     * key of data to be deleted
     */
    public function delete_data(string $key)
    {
        return $this->http_request([], 'DELETE', '/' . $key);
    }
    /**
     * @var string $prefix
     * prefix of data key
     */
    public function get_keys(string $prefix = '')
    {
        return file_get_contents(self::$URL . '?prefix=' . $prefix) . PHP_EOL;
    }
    /**
     * @var string $key
     * data key
     */
    public function get_data(string $key)
    {
        return file_get_contents(self::$URL . '/' . $key);
    }
}
