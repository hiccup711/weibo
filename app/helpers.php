<?php

    function get_db_config()
    {
        if(getenv('IS_IN_HEROKU'))
        {
            $url = parse_url(getenv('DATABASE_URL'));
            return $db_config = [
                'connection' => 'pgsql',
                'host' => $url['host'],
                'database' => substr($url['path'], 1),
                'username' => $url['user'],
                'password' => $url['pass']
            ];
        }else{
            return $db_config = [
                'connection' => getenv('DB_CONNECTION', 'mysql'),
                'host' => getenv('DB_HOST', 'localhost'),
                'database' => getenv('DB_DATABASE', 'forge'),
                'username' => getenv('DB_USERNAME', 'forge'),
                'password' => getenv('DB_PASSWORD', '')
            ];
        }
    }
