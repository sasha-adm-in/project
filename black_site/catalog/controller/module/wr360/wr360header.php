<?php
function addWR360Headers($controller, $__output, $__db)
{
    if (defined('webrotate360_headers'))
        return $__output;
    if (!isset($GLOBALS['request']))
        return $__output;
    if (!isset($GLOBALS['request']->get['route']))
        return $__output;
    if (!preg_match("/product/is", $GLOBALS['request']->get['route']))
        return $__output;
    if (!isset($GLOBALS['request']->get['product_id']))
        return $__output;
    if ($controller->config->get('webrotate360_status') == null)
        return $__output;
    if ($controller->config->get('webrotate360_status') == 0)
        return $__output;
        
    $productId = $GLOBALS['request']->get['product_id'];
    $rootPath = null;
    $productConfigFileURL = null;
    $selected = false;

    $tableName = DB_PREFIX . "wr360product";
    $sqlCreateTable = <<<SQL
CREATE TABLE IF NOT EXISTS `$tableName` (
  `product_id` INT NOT NULL ,
  `root_path` VARCHAR(255) NOT NULL DEFAULT '' ,
  `config_file_url` VARCHAR(255) NOT NULL DEFAULT '' ,
  `wr360_enabled` TINYINT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`product_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;
SQL;

    // this is to avoid exception if the table didn't exist:
    $__db->query($sqlCreateTable);
        
    $query = $__db->query("SELECT * FROM `$tableName` WHERE product_id = '" . $productId . "'");
    foreach ($query->rows as $result) {
        $rootPath = $result['root_path'];
        $productConfigFileURL = $result['config_file_url'];
        $wr360_enabled = $result['wr360_enabled'];
        $selected = true;
    }
    
    if (!$selected || !$wr360_enabled)
        return $__output;
    
    $__wr360Path = 'catalog';
    if(defined('DIR_APPLICATION'))
        $__wr360Path = preg_replace('/.*\/([^\/].*)\//is', '$1', DIR_APPLICATION);

    $skinCSS = $controller->config->get('skinCSS');
    if (empty($skinCSS))
        $skinCSS = "basic.css";

    $__scriptsPath = $__wr360Path . '/controller/module/wr360';
    $__headersArray = array();
    $__headersArray[] = '<!-- Rotate360 -->';
    $__headersArray[] = '<link type="text/css" href="' . $__scriptsPath . '/html/css/' . $skinCSS . '" rel="stylesheet"/>';
    $__headersArray[] = '<script type="text/javascript" src="' . $__scriptsPath . '/html/js/imagerotator.js"></script>';
    $__headersArray[] = '<script type="text/javascript" src="' . $__scriptsPath . '/wr360hook.js"></script>';

    $graphicsPath   = $controller->config->get('graphicsPath');
    $configFileURL  = $controller->config->get('configFileURL');
    $divID          = $controller->config->get('divID');
    $viewerWidth    = $controller->config->get('viewerWidth');
    $viewerHeight   = $controller->config->get('viewerHeight');
    $baseWidth      = $controller->config->get('baseWidth');

    if (!empty($baseWidth))
        $baseWidth = preg_replace("/[^0-9]/", "", $baseWidth);
    else
        $baseWidth = 0;

    $rootPathValue = "";
    if ($rootPath && strlen($rootPath) > 0)
        $rootPathValue = $rootPath;

    if ($productConfigFileURL && strlen($productConfigFileURL) > 0)
        $configFileURL = $productConfigFileURL;

    $__headersArray[] = <<<HTML
<style type="text/css">
    $divID{visibility: hidden;}
</style>	
<script type="text/javascript">
jQuery(document).ready(
    function(){
        WR360Initialize("$graphicsPath", "$__scriptsPath", "$configFileURL", "$divID", "$viewerWidth", "$viewerHeight", "$rootPathValue", "$baseWidth");
    });    
</script>
HTML;

    $__headers = "\r\n" . implode("\r\n", $__headersArray) . "\r\n";
    if (strpos($__output, '</head>')) {
        $__output = preg_replace('/\<\/head\>/is', $__headers . "</head>", $__output, 1, $__replacedCount);
        if ($__replacedCount > 0)
            define('webrotate360_headers', true);
    } else {
        $__output = $__output . $__headers;
        define('webrotate360_headers', true);
    }
    
    return $__output;
}  
?>
