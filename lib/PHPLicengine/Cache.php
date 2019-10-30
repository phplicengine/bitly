


switch ($cache['type']) {
            case 'apc':
                      $cache = new Doctrine\Common\Cache\ApcCache();
                      break;
            case 'file':
                      $cache = new Doctrine\Common\Cache\FilesystemCache($path);
                      break;
            case 'sqlite3':
                     $db = new SQLite3('bitly.db');
                     $cache = new SQLite3Cache($db, 'bitly_table');
                      break;
            case 'xcache':
                      $cacheObj = new Doctrine\Common\Cache\XcacheCache();
                      break;
            default:
                      throw new Exception('Invalid cache system');
                      break;
} 
