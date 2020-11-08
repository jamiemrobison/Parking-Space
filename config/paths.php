<?php
/*--------------------------------------- PATHS ---------------------------------------*/
    /* Parsing the location of the root directory from the dir.ini file */
    $directories = getDirectories();

    /* Change this when necessary */
    defined("ROOT")
        or define("ROOT", $directories['root']);

    /* Website Root */
    defined("WEB_ROOT")
        or define("WEB_ROOT", $directories['root'] . $directories['web_root']);

    /* Header Root */
    defined("HEADER_ROOT")
        or define("HEADER_ROOT", $directories['header_root']);

    /* Paths for heavily used files and locations */
    defined("CLASSES")
        or define("CLASSES", ROOT . '/src/classes/');
     
    defined("SCRIPTS")
        or define("SCRIPTS", ROOT . '/src/scripts/');
        
    defined("COMPOSER")
        or define("COMPOSER", ROOT . '/src/composer/vendor/autoload.php');

    defined("INI")
            or define("INI", ROOT . '/config/ini/');
    /*-------------------------------------------------------------------------------------*/

    function getDirectories()
    {
        /* Getting directories from dir.ini file */
        if (file_exists(__DIR__ . "/ini/dir.ini"))
        {
            $directories = parse_ini_file(__DIR__ . "/ini/dir.ini");
        }
        else
        {
            /* 
                Checkinng whether current document root is in public 
                or in the main folder 
            */
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/login.php"))
            {
                /* Document Root is in Public */
                $directories = array(
                    "root" => $_SERVER['DOCUMENT_ROOT'] . "/../",
                    "web_root" => "/public",
                    "header_root" => "",
                );
            }
            else
            {
                /* Document Root is in Root Folder */
                $directories = array(
                    "root" => __DIR__ . "/..",
                    "web_root" => "/public",
                    "header_root" => "/public",
                );
            }
        }
        return $directories;
    }
?>