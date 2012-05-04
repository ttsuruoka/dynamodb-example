<?php
// アプリケーション
require_once APP_DIR.'app_controller.php';
require_once APP_DIR.'app_model.php';
require_once APP_DIR.'app_layout_view.php';
require_once APP_DIR.'app_exception.php';
require_once APP_DIR.'app_validation.php';

require_once HELPERS_DIR.'html_helper.php';

require_once VENDOR_DIR.'SimpleAmazonDynamoDB/SimpleAmazonDynamoDB.php';

require_once CONFIG_DIR.'router.php';
require_once CONFIG_DIR.'time.php';
require_once CONFIG_DIR.'dynamo.php';

// autoload
spl_autoload_register(function($name) {
    $filename = Inflector::underscore($name) . '.php';
    if (strpos($name, 'Controller') !== false) {
        require CONTROLLERS_DIR . $filename;
    } elseif (strpos($name, 'Master') !== false) {
        require MASTER_DIR . $filename;
    } else {
        if (file_exists(MODELS_DIR . $filename)) {
            require MODELS_DIR . $filename;
        }
    }
});
