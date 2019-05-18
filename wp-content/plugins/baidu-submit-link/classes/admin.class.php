<?php
/**
 * This was contained in an addon until version 1.0.0 when it was rolled into
 * core.
 *
 * @package    WBOLT
 * @author     WBOLT
 * @since      1.1.1
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WBOLT
 */

class BSL_Admin
{
    public static $name = 'bsl_pack';
    public static $optionName = 'bsl_option';
    public $token = '';


    public static function cnf($key,$default=null){
        static $_push_cnf = array();
        if(!$_push_cnf){

            $_push_cnf = get_option(self::$optionName,array());
        }
        if(isset($_push_cnf[$key])){
            return $_push_cnf[$key];
        }

        return $default;

    }

	public function __construct(){

        $token = self::cnf('token');



        if($token){
            $this->token = $token;
            $token_valid = get_option('bpu-token-check',0);
            if(!$token_valid){
                $token_valid = $this->testToken();
            }

            if($token_valid){
                wp_clear_scheduled_hook('bsl_cron_action');
                add_action('baidu_push_url_cron_action', array($this,'baidu_push_url_cron_action'));
                //设置定时任务
                if(!wp_next_scheduled('baidu_push_url_cron_action')){
                    wp_schedule_event(strtotime(current_time('Y-m-d 01:00:00')), 'daily', 'baidu_push_url_cron_action');
                }
            }

        }


        if(is_admin()){

            //ajax request
            add_action('wp_ajax_wb_baidu_push_url',array($this,'wp_ajax_wb_baidu_push_url'));



            //插件设置连接
            add_filter( 'plugin_action_links', array($this,'actionLinks'), 10, 2 );

            add_action( 'admin_menu', array($this,'admin_menu') );

            add_action( 'admin_init', array($this,'admin_init') );

	        add_action('admin_enqueue_scripts',array($this,'admin_enqueue_scripts'),1);

            add_filter('plugin_row_meta', array(__CLASS__, 'plugin_row_meta'), 10, 2);

        }


        //百度自动抓取

        if(self::cnf('bdauto')){
            add_action('wp_footer',array($this,'baidu_auto_code'),500);
        }
	}

	function baidu_auto_code(){
        echo '<script>
                        (function(){
                            var bp = document.createElement(\'script\');
                            var curProtocol = window.location.protocol.split(\':\')[0];
                            if (curProtocol === \'https\') {
                                bp.src = \'https://zz.bdstatic.com/linksubmit/push.js\';
                            }
                            else {
                                bp.src = \'http://push.zhanzhang.baidu.com/push.js\';
                            }
                            var s = document.getElementsByTagName("script")[0];
                            s.parentNode.insertBefore(bp, s);
                        })();
                        </script>';
    }


    public function admin_enqueue_scripts($hook){
        global $wb_settings_page_hook_bdsl;
        if($wb_settings_page_hook_bdsl != $hook) return;

        wp_enqueue_style('wbs-style-bdsl', plugin_dir_url(BSL_BASE_FILE) . 'assets/wb_plugins_bdsl.css', array(),BSL_VERSION);
    }


    public static function plugin_row_meta($links,$file){

        $base = plugin_basename(BSL_BASE_FILE);
        if($file == $base) {
            $links[] = '<a href="https://www.wbolt.com/plugins/bsl?utm_source=bsl_setting&utm_medium=link&utm_campaign=plugins_list" target="_blank">插件主页</a>';
            $links[] = '<a href="https://www.wbolt.com/bsl-plugin-documentation.html?utm_source=bsl_setting&utm_medium=link&utm_campaign=plugins_list" target="_blank">FAQ</a>';
            $links[] = '<a href="https://wordpress.org/support/plugin/baidu-submit-link/" target="_blank">反馈</a>';
        }
        return $links;
    }
    function actionLinks( $links, $file ) {

        if ( $file != plugin_basename(BSL_BASE_FILE) )
            return $links;

        $settings_link = '<a href="'.menu_page_url( self::$name, false ).'">设置</a>';

        array_unshift( $links, $settings_link );

        return $links;
    }

    function admin_menu(){
	    global $wb_settings_page_hook_bdsl;
	    $wb_settings_page_hook_bdsl = add_options_page(
            '百度搜索推送管理设置',
            '百度搜索推送管理',
            'manage_options',
            self::$name,
            array($this,'admin_settings')
        );
    }
    function admin_settings(){
        $setting_field = self::$optionName;
	    $opt_name = self::$optionName;
        $op_sets = get_option( $opt_name );
        include_once( BSL_PATH.'/settings.php' );
    }


    function admin_init(){
        register_setting(  self::$optionName,self::$optionName );
    }


    /**
     * 获取推送数据结果
     */
    public function wp_ajax_wb_baidu_push_url(){


        switch ($_REQUEST['do']){


            case 'check_sitemap':
                $ret = array('code'=>0,'desc'=>'success');

                $site_map = home_url('/sitemap.xml');
                $site_map_exists = '';
                $http = wp_remote_head($site_map);
                //print_r($http);
                if(!is_wp_error($http) && $http['response']['code'] === 200){
                    $site_map_exists = $site_map;
                }
                if(!$site_map_exists){
                    $site_map = home_url('/sitemaps.xml');
                    $http = wp_remote_head($site_map);
                    if(!is_wp_error($http) && $http['response']['code'] === 200){
                        $site_map_exists = $site_map;
                    }

                }
                if(!$site_map_exists){
                    $site_map = home_url('/sitemap_index.xml');
                    $http = wp_remote_head($site_map);
                    if(!is_wp_error($http) && $http['response']['code'] === 200){
                        $site_map_exists = $site_map;
                    }

                }
                if(!$site_map_exists){
                    $ret['code'] = 1;
                    $ret['desc'] = '404';
                }else{
                    $ret['desc'] = '200';
                    $ret['data'] = $site_map_exists;
                }

                header('content-type:json/text;');

                echo json_encode($ret);

                exit();

                break;
            case 'check_token':

                $ret = array('code'=>0,'desc'=>'success');


                do{
                    $this->token = trim($_POST['token']);
                    $resp = $this->baidu_api(array(home_url()),1);

                    if($resp['code']){
                        $ret['code'] = $resp['code'];
                        $ret['desc'] = $resp['desc'];
                        //update_option('bpu-token-check',0,false);
                        break;
                    }else{
                        //update_option('bpu-token-check',1,false);
                    }
                }while(false);



                header('content-type:json/text;');

                echo json_encode($ret);

                exit();

                break;


            case 'push_stat':


                $offset = get_option( 'gmt_offset' ) * HOUR_IN_SECONDS;


                //近30天


                $m_datas = array();
                $ret = array(1=>array(),2=>array(),3=>array());
                for($i=29;$i>-1;$i--){
                    if($i>0){

                        $day = date('Y-m-d',strtotime('-'.$i.' day') + $offset);
                    }else{
                        $day = date('Y-m-d',time()+$offset);
                    }
                    $days = explode('-',$day);

                    $m = $days[0].'-'.$days[1];

                    if(!isset($m_datas[$m])){
                        $m_datas[$m] = get_option('bpu_'.$m,array());
                    }


                    $d = $days[2];

                    $row = array(1=>0,2=>0,3=>0);
                    if(isset($m_datas[$m][$d])){
                        $row = $m_datas[$m][$d];
                    }

                    array_push($ret[1],$row[1]);
                    array_push($ret[2],$row[2]);
                    array_push($ret[3],$row[3]);

                    //array_push($ret,$row);
                }


                header('content-type:json/text;');

                echo json_encode(array('code'=>0,'data'=>$ret,'ex'=>$m_datas));

                exit();
                break;


        }
    }


    /**
     * 定时主动推送文章url到百度站长
     * @return bool
     */
    public function baidu_push_url_cron_action(){

        global $wpdb;

        update_option('baidu_push_url_last_error','',false);
        $token = $this->token;


        if(!$token){
            return false;
        }





        //新增的
        $meta_key = 'bpu';
        $sql = "SELECT * FROM $wpdb->posts p WHERE  (p.post_type = 'post' OR p.post_type = 'page') AND  p.post_status='publish' AND NOT EXISTS (SELECT m.post_id FROM $wpdb->postmeta m WHERE m.meta_key='$meta_key' AND m.post_id=p.ID)";

        $this->baidu_push($sql,1,$meta_key);



        //删除
        $sql = "SELECT * FROM $wpdb->posts p WHERE  (p.post_type = 'post' OR p.post_type = 'page') AND  p.post_status<>'publish' AND EXISTS (SELECT m.post_id FROM $wpdb->postmeta m WHERE m.meta_key = '$meta_key' AND m.post_id=p.ID)";
        $this->baidu_push($sql,3,$meta_key);


        //更新
        //昨天
        $update_ymd = date('Ymd',strtotime('-1 day'));
        $sql = "SELECT * FROM $wpdb->posts p WHERE  (p.post_type = 'post' OR p.post_type = 'page') AND  p.post_status='publish' and DATE_FORMAT(p.post_modified_gmt,'%Y%m%d')>'$update_ymd' AND EXISTS (SELECT m.post_id FROM $wpdb->postmeta m WHERE m.meta_key = '$meta_key' AND m.post_id=p.ID)";

        $this->baidu_push($sql,2,$meta_key);

        $iday = strtotime(current_time('mysql'));// - 86400;

        $ymd = date('Ymd',$iday);

        //当前月数据
        $month = date('Y-m',$iday);//current_time('Y-m');
        $day = date('d',$iday);//current_time('d');
        $month_data = get_option('bpu_'.$month,array());

        $month_data[$day] = array(1=>0,2=>0,3=>0);

        foreach($month_data[$day] as $type=>$num){
            $meta_value = $type.'|'.$ymd;
            $_num = $wpdb->get_var("SELECT COUNT(1) num FROM $wpdb->postmeta m WHERE m.meta_key='$meta_key' AND meta_value='$meta_value'");
            if($_num){
                $month_data[$day][$type] = $_num;
            }
        }

        update_option('bpu_'.$month,$month_data,false);

    }


    /**
     * @param $sql
     * @param $type
     * @param $meta_key
     */
    private function baidu_push($sql,$type,$meta_key){

        global $wpdb;

        $page = -1;
        $num = 100;

        $ymd = date('Ymd',strtotime(current_time('mysql')));

        do{
            $page ++;

            $offset = $page * $num;

            $list = $wpdb->get_results($sql.' LIMIT '.$offset.','.$num);

            if(!$list){
                break;
            }

            $url = array();
            $post_ids = array();
            foreach($list as $r){

                $post_ids[] = $r->ID;

                $_post = new WP_Post( $r );

                $url[] = get_permalink($_post);

            }

            $ret = $this->baidu_api($url,$type);
            if(!$ret['code']){
                //
                foreach($post_ids as $post_id){

                    $this->update_meta_row($post_id,$meta_key,$type.'|'.$ymd);
                }
                update_option('baidu_push_url_last_error','',false);
            }else{
                update_option('baidu_push_url_last_error',$ret,false);
            }

        }while(true);

    }

    /**
     * 更新post meta
     * @param $post_id
     * @param $key
     * @param $value
     */
    public function update_meta_row($post_id,$key,$value){
        global $wpdb;

        $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE meta_key=%s AND post_id=%d LIMIT 1",$key,$post_id));
        if($row){
            $wpdb->query($wpdb->prepare("UPDATE $wpdb->postmeta SET meta_value=%s WHERE meta_id=%d",$value,$row->meta_id));
        }else{
            $wpdb->query($wpdb->prepare("INSERT INTO $wpdb->postmeta(`post_id`, `meta_key`, `meta_value`) VALUES(%d,%s,%s)",$post_id,$key,$value));
        }
    }


    /**
     * token检验
     * @return int
     */
    public function testToken(){

        $resp = $this->baidu_api(array(home_url()),1);

        if($resp['code']){
            update_option('baidu_push_url_last_error',$resp,false);
            update_option('bpu-token-check',0,false);
            return 0;
        }else{
            update_option('bpu-token-check',1,false);
            return 1;
        }
    }


    /**
     * 百度站长连接主动推送接口
     *
     * @param $urls
     * @param $type
     * @return array
     */
    function baidu_api($urls,$type){

        $apis = array(
            1=>'http://data.zz.baidu.com/urls',
            2=>'http://data.zz.baidu.com/urls',
            3=>'http://data.zz.baidu.com/urls',
            //2=>'http://data.zz.baidu.com/update',//百度接口返回超额
            //3=>'http://data.zz.baidu.com/del'//百度接口返回超额
        );


        $token = $this->token;

        $siteurl = get_option('siteurl');
        $parse = parse_url($siteurl);
        $site = $parse['host'];

        $ret = array(
            'code'=>1,
            'desc'=>'error',
            'data'=>null,
        );


        if(!$site || !$token){
            $ret['code'] = 10;
            $ret['desc'] = '未设置百度推送token';
            return $ret;
        }
        //
        $api = $apis[$type].'?site='.$site.'&token='.$token;
        $args = array(
            'method'=>'POST',
            'body'=>implode("\n",$urls)
        );
        $http = wp_remote_post($api,$args);
        if(is_wp_error($http)){
            $ret['code'] = 20;
            $ret['desc'] = '接口请求错误,'.$http->get_error_message();
            return $ret;
        }
        if(200 === $http ['response'] ['code']){

            $body = $http ['body'];

            /*
            {"remain":4999998,"success":2,"not_same_site":[],"not_valid":[]}
            */
            $data = json_decode($body,true);
            if(!$data){
                $ret['code'] = 11;
                $ret['desc'] = '接口响应解析出错,响应内容【'.$body.'】';
                return $ret;
            }
            $ret['code'] = 0;
            $ret['desc'] = 'success';
            $ret['data'] = $data;
            return $ret;
        }else{

            if($http['body']){
                /*
                {"error":int,"message":string}
                {"error":400,"message":"site error"} 站点未在站长平台验证
                {"error":400,"message":"empty content"} post内容为空
                {"error":400,"message":"only 2000 urls are allowed once"} 每次最多只能提交2000条链接
                {"error":400,"message":"over quota"} 超过每日配额了，超配额后再提交都是无效的
                {"error":401,"message":"token is not valid"} token错误
                {"error":404,"message":"not found"} 接口地址填写错误
                {"error":500,"message":"internal error, please try later"} 服务器偶然异常，通常重试就会成功
                */
                $lan = array(
                    'site error'=>'站点未在站长平台验证',
                    'empty content'=>'未提交何url',
                    'only 2000 urls are allowed once'=>'每次最多只能提交2000条链接',
                    'over quota'=>'超过每日配额了，超配额后再提交都是无效的',
                    'token is not valid'=>'token错误',
                    'not found'=>'接口地址填写错误',
                    'internal error, please try later'=>'服务器偶然异常，通常重试就会成功',
                );
                $data = json_decode($http['body'],true);
                if(!$data){
                    $ret['code'] = 11;
                    $ret['desc'] = '接口响应解析出错,响应内容【'.$http['body'].'】';
                    return $ret;
                }

                $ret['code'] = 30;
                $ret['desc'] = isset($lan[$data['message']])?$lan[$data['message']]:$data['message'];
                $ret['data'] = $data;
                return $ret;
            }
            $ret['code'] = 12;
            $ret['desc'] = '接口请求出错,响应码【'.$http ['response'] ['code'].'】';
            return $ret;
        }

    }


	

	
}