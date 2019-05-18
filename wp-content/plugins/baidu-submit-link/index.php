<?php
/*
Plugin Name: 百度搜索推送管理
Plugin URI: http://wordpress.org/plugins/baidu-submit-link/
Description: 百度搜索推送管理插件是基于百度站长平台对站长开放的链接提交接口开发的，支持站长通过主动推送，自动推送和sitemap推送三种方式，向百度搜索引擎推送链接，提升百度搜索引擎对网站的收录效率。
Author: wbolt team
Version: 1.1.1
Author URI: http://www.wbolt.com/
Requires PHP: 5.3.3
*/
define('BSL_PATH',dirname(__FILE__));
define('BSL_BASE_FILE',__FILE__);
define('BSL_VERSION','1.1.1');
require_once BSL_PATH.'/classes/admin.class.php';

new BSL_Admin();

