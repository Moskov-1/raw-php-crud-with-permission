<?php

if(!function_exists('env')){
    function env($key, $default = null){
        static $envCache = null;

        if($envCache == null){
            $envCache = [];
            $envPath = __DIR__ . '/../.env';
            if(file_exists($envPath)){
                $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach($lines as $line){
                    if(strpos(trim($line), '#') === 0) continue; // Skip comments
                    $parts = explode('=', $line, 2);
                    if(count($parts) === 2){
                        list($k, $v) = $parts;
                        $envCache[trim($k)] = trim($v);
                    }
                }
            }
        }

        return array_key_exists($key, $envCache) ? $envCache[$key] : $default; // better cuz it doesn't crash if key doesn't exist
    }
}