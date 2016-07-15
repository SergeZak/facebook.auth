<?php
session_start();

require_once 'core/configs.php';
require_once 'services/curl_service.php';
require_once 'services/facebook_service.php';
require_once 'core/db.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';

Route::start();