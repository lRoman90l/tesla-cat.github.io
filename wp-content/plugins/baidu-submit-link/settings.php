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

$pd_title = '百度推送管理';
$pd_version = BSL_VERSION;
$pd_code = 'bsl-setting';
$pd_index_url = 'https://www.wbolt.com/plugins/bsl';
$pd_doc_url = 'https://www.wbolt.com/bsl-plugin-documentation.html';

?>

<div style=" display:none;">
    <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
            <symbol id="sico-upload" viewBox="0 0 16 13">
                <path d="M9 8v3H7V8H4l4-4 4 4H9zm4-2.9V5a5 5 0 0 0-5-5 4.9 4.9 0 0 0-4.9 4.3A4.4 4.4 0 0 0 0 8.5C0 11 2 13 4.5 13H12a4 4 0 0 0 1-7.9z" fill="#666" fill-rule="evenodd"/>
            </symbol>
            <symbol id="sico-wb-logo" viewBox="0 0 18 18">
                <title>sico-wb-logo</title>
                <path d="M7.264 10.8l-2.764-0.964c-0.101-0.036-0.172-0.131-0.172-0.243 0-0.053 0.016-0.103 0.044-0.144l-0.001 0.001 6.686-8.55c0.129-0.129 0-0.321-0.129-0.386-0.631-0.163-1.355-0.256-2.102-0.256-2.451 0-4.666 1.009-6.254 2.633l-0.002 0.002c-0.791 0.774-1.439 1.691-1.905 2.708l-0.023 0.057c-0.407 0.95-0.644 2.056-0.644 3.217 0 0.044 0 0.089 0.001 0.133l-0-0.007c0 1.221 0.257 2.314 0.643 3.407 0.872 1.906 2.324 3.42 4.128 4.348l0.051 0.024c0.129 0.064 0.257 0 0.321-0.129l2.25-5.593c0.064-0.129 0-0.257-0.129-0.321z"></path>
                <path d="M16.714 5.914c-0.841-1.851-2.249-3.322-4.001-4.22l-0.049-0.023c-0.040-0.027-0.090-0.043-0.143-0.043-0.112 0-0.206 0.071-0.242 0.17l-0.001 0.002-2.507 5.914c0 0.129 0 0.257 0.129 0.321l2.571 1.286c0.129 0.064 0.129 0.257 0 0.386l-5.979 7.264c-0.129 0.129 0 0.321 0.129 0.386 0.618 0.15 1.327 0.236 2.056 0.236 2.418 0 4.615-0.947 6.24-2.49l-0.004 0.004c0.771-0.771 1.414-1.671 1.929-2.7 0.45-1.029 0.643-2.121 0.643-3.279s-0.193-2.314-0.643-3.279z"></path>
            </symbol>
            <symbol id="sico-more" viewBox="0 0 16 16">
                <path d="M6 0H1C.4 0 0 .4 0 1v5c0 .6.4 1 1 1h5c.6 0 1-.4 1-1V1c0-.6-.4-1-1-1M15 0h-5c-.6 0-1 .4-1 1v5c0 .6.4 1 1 1h5c.6 0 1-.4 1-1V1c0-.6-.4-1-1-1M6 9H1c-.6 0-1 .4-1 1v5c0 .6.4 1 1 1h5c.6 0 1-.4 1-1v-5c0-.6-.4-1-1-1M15 9h-5c-.6 0-1 .4-1 1v5c0 .6.4 1 1 1h5c.6 0 1-.4 1-1v-5c0-.6-.4-1-1-1"/>
            </symbol>
            <symbol id="sico-plugins" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M16 3h-2V0h-2v3H8V0H6v3H4v2h1v2a5 5 0 0 0 4 4.9V14H2v-4H0v5c0 .6.4 1 1 1h9c.6 0 1-.4 1-1v-3.1A5 5 0 0 0 15 7V5h1V3z"/>
            </symbol>
            <symbol id="sico-doc" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 0H1C.4 0 0 .4 0 1v14c0 .6.4 1 1 1h14c.6 0 1-.4 1-1V1c0-.6-.4-1-1-1zm-1 2v9h-3c-.6 0-1 .4-1 1v1H6v-1c0-.6-.4-1-1-1H2V2h12z"/><path d="M4 4h8v2H4zM4 7h8v2H4z"/>
            </symbol>
        </defs>
    </svg>
</div>

<div id="optionsframework-wrap" class="wbs-wrap wbps-wrap" data-wba-source="<?php echo $pd_code; ?>">
    <div class="wbs-header">
        <svg class="wb-icon sico-wb-logo"><use xlink:href="#sico-wb-logo"></use></svg>
        <span>WBOLT</span>
        <strong><?php echo $pd_title; ?></strong>

        <div class="links">
            <a class="wb-btn" href="<?php echo $pd_index_url; ?>" data-wba-campaign="title-bar" target="_blank">
                <svg class="wb-icon sico-plugins"><use xlink:href="#sico-plugins"></use></svg>
                <span>插件主页</span>
            </a>
            <a class="wb-btn" href="<?php echo $pd_doc_url; ?>" data-wba-campaign="title-bar" target="_blank">
                <svg class="wb-icon sico-doc"><use xlink:href="#sico-doc"></use></svg>
                <span>说明文档</span>
            </a>
        </div>
    </div>

    <div class="wbs-main">

        <form class="wbs-content option-form" id="optionsframework" action="options.php" method="post">
	        <?php
	        settings_fields($setting_field);
	        ?>
            <h3 class="sc-header">
                <strong>百度推送管理设置</strong>
            </h3>
            <div class="sc-body">
                <script>
                    function checkBaiduToken(obj,type) {
                        if(type==1 && obj.value==obj.defaultValue){
                            return;
                        }
                        var token = '';
                        if(type==2){
                            token = jQuery(obj).parent().prev('input').val();
                        }else{
                            token = obj.value;
                        }
                        jQuery('#check_baidu_resp').html('');
                        jQuery.post(ajaxurl,{'action':'wb_baidu_push_url','do':'check_token','token':token},function(ret){
                            //console.log(ret);
                            if(ret.code){
                                jQuery('#check_baidu_resp').html(ret.desc);
                            }else{
                                jQuery('#check_baidu_resp').html('验证成功');
                            }
                        },'json');
                    }
                </script>
                <table class="wbs-form-table">
                    <tbody>
                    <tr>
                        <th class="row w8em">主动推送</th>
                        <td>
                            <input id="wb_bdsl_bdkey" class="wbs-input" data-max="80" name="<?php echo $setting_field;?>[token]" onblur="return checkBaiduToken(this,1);" type="text" value="<?php echo isset($op_sets['token']) ?  $op_sets['token'] : '' ;?>" placeholder="">
                            <p class="pt default-hidden-box<?php echo isset($op_sets['token']) ?  ' active' : '' ;?>" id="J_checkToken"><a href="javascript:void(0);" onclick="return checkBaiduToken(this,2)">[验证密钥]</a> <span class="hl ml" id="check_baidu_resp"></span></p>
                            <p class="description">请输入百度推送准入密钥，访问<a class="link" target="_blank" href="https://ziyuan.baidu.com/">百度站长平台</a>获取准入密钥，<a class="link" target="_blank" data-wba-campaign="Setting-Des-txt"  href="https://www.wbolt.com/how-to-get-baidu-tokenid.html">查看教程</a>。
                            </p>

                            <div id="J_displayBaiduData">
                                <p class="description mt">温馨提示：推送数据仅作为自动推送和SITEMAP提交链接补充，不代表推送数据一定被百度站长记录</p>
                                <div class="charts-box" id="J_bdtsCharts"></div>
                                <div class="hl">
							        <?php
							        $last_err = get_option('baidu_push_url_last_error',array());
							        if($last_err){
								        echo $last_err['desc'];
							        }
							        ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="row">自动推送</th>
                        <td>
                            <input class="wb-switch" type="checkbox" data-target="#J_bdAutoSetMsg" name="<?php echo $setting_field;?>[bdauto]" <?php echo  isset($op_sets['bdauto']) && $op_sets['bdauto']?' checked':'';?> value="1" id="seo_bdauto">
					        <?php if(isset($op_sets['bdauto']) && $op_sets['bdauto']): ?>
                                <span class="description" id="J_bdAutoSetMsg">已启用百度链接自动推送，切莫重复添加推送工具代码。</span>
                            <?php else: ?>
                                <span class="description"> 自动推送开关开启后，主题会添加自动推送工具代码，提高百度搜索引擎对站点新增网页发现速度。</span>
					        <?php endif; ?>

					        <?php /* the code:
                         <script>
                        (function(){
                            var bp = document.createElement('script');
                            var curProtocol = window.location.protocol.split(':')[0];
                            if (curProtocol === 'https') {
                                bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
                            }
                            else {
                                bp.src = 'http://push.zhanzhang.baidu.com/push.js';
                            }
                            var s = document.getElementsByTagName("script")[0];
                            s.parentNode.insertBefore(bp, s);
                        })();
                        </script>
                    */ ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="row">Sitemap推送</th>
                        <td>



                            <div id="sitemap-check">检测中......</div>
                            <!--检测是否开启sitemap 若未有：-->
                            <div id="sitemap-404" style="display: none;">
                                <p>未检测到有效站点Sitemap，请依据下方说明安装插件生成站点sitemap</p>
                                <p>(1)Sitemap生成-下载并启动Sitemap生成插件，建议安装 Google XML Sitemaps。<a lass="link" target="_blank" data-wba-campaign="Setting-Des-txt" href="https://www.wbolt.com/how-to-set-google-xml-sitemaps.html">查看教程</a><br>
                                    (2)Sitemap提交-访问并登陆<a class="link" target="_blank" href="https://ziyuan.baidu.com/">百度站长平台</a>，找到链接提交-自动提交-sitemap，填入sitemap 地址，最后提交。<a class="link" target="_blank" data-wba-campaign="Setting-Des-txt" href="https://www.wbolt.com/how-to-set-a-sitemap-linksubmit.html">查看教程</a></p>
                            </div>


                            <!--若有：-->
                            <div id="sitemap-200" style="display: none;">
                                <p>
                                    Sitemap地址：<a class="sitemap" href="<?php echo $site_map_exists;?>" target="_blank"><?php echo $site_map_exists;?></a>
                                </p>
                                <p>(1)Sitemap生成-下载并启动Sitemap生成插件，建议安装 Google XML Sitemaps。<a lass="link" target="_blank" data-wba-campaign="Setting-Des-txt" href="https://www.wbolt.com/how-to-set-google-xml-sitemaps.html">查看教程</a><br>
                                    (2)Sitemap提交-访问并登陆<a class="link" target="_blank" href="https://ziyuan.baidu.com/">百度站长平台</a>，找到链接提交-自动提交-sitemap，填入sitemap 地址，最后提交。<a lass="link" target="_blank" data-wba-campaign="Setting-Des-txt" href="https://www.wbolt.com/how-to-set-a-sitemap-linksubmit.html">查看教程</a></p>
                            </div>




                            <script>
                                jQuery(function(){
                                    jQuery.post(ajaxurl,{'action':'wb_baidu_push_url','do':'check_sitemap'},function(ret){
                                        //console.log(ret);
                                        var o = '#sitemap-' + ret['desc'];
                                        jQuery(o).show();

                                        jQuery('#sitemap-check').hide();
                                        if(!ret.code){
                                            var a = jQuery(o).find('a.sitemap');
                                            a.attr('href',ret.data);
                                            a.html(ret.data);
                                        }


                                    },'json');

                                })
                            </script>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <script type="text/javascript" src="https://www.wbolt.com/wb-api/v1/news/lastest"></script>

            <div class="wb-copyright-bar">
                <div class="wbcb-inner">
                    <a class="wb-logo" href="https://www.wbolt.com" data-wba-campaign="footer" title="WBOLT" target="_blank"><svg class="wb-icon sico-wb-logo"><use xlink:href="#sico-wb-logo"></use></svg></a>
                    <div class="wb-desc">
                        Made By <a href="https://www.wbolt.com" data-wba-campaign="footer" target="_blank">闪电博</a>
                        <span class="wb-version">版本：<?php echo $pd_version;?></span>
                    </div>
                    <div class="ft-links">
                        <a href="https://www.wbolt.com/plugins" data-wba-campaign="footer" target="_blank">免费插件</a>
                        <a href="https://www.wbolt.com/knowledgebase" data-wba-campaign="footer" target="_blank">插件支持</a>
                        <a href="<?php echo $pd_doc_url; ?>" data-wba-campaign="footer" target="_blank">说明文档</a>
                        <a href="https://www.wbolt.com/terms-conditions" data-wba-campaign="footer" target="_blank">服务协议</a>
                        <a href="https://www.wbolt.com/privacy-policy" data-wba-campaign="footer" target="_blank">隐私条例</a>
                    </div>
                </div>
            </div>

            <div class="wbs-footer" id="optionsframework-submit">
                <div class="wbsf-inner">
                    <button class="wbs-btn-primary" type="submit" name="update">保存设置</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php wp_enqueue_script('eccharts-js', plugin_dir_url(BSL_BASE_FILE ) . '/assets/echarts.min.js', array()); ?>
<script>
    var WB = window.WB || {};
    WB.BDSL = {
        bdChart: function($){
            var myChart;
            var option = {
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    type: 'scroll',
                    bottom: 10,
                    data:['推送数据','更新数据','删除数据']
                },
                grid:{
                    left:40,
                    top:20
                },
                xAxis: {
                    type: 'category',
                    data: lastMoth(),
                    axisTick: {
                        show: false
                    }
                },
                yAxis: {
                    type: 'value',
                    splitLine: {
                        lineStyle: {
                            type: 'dashed',
                            color: '#ddd'
                        }
                    },
                    axisLine: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    }
                },
                series: [
                    {
                        name: '推送数据',
                        data: [],
                        type: 'line',
                        smooth: true
                    },
                    {
                        name: '更新数据',
                        data: [],
                        type: 'line',
                        smooth: true
                    },
                    {
                        name: '删除数据',
                        data: [],
                        type: 'line',
                        smooth: true
                    }
                ],
                color: [ '#6832bd', '#bd9632','#3288bd', '#bd3288', '#33bd67']
            };

            $.post(ajaxurl,{action:'wb_baidu_push_url','do':'push_stat'},function(ret){

                if(!ret || ret.code)return;
                //console.log(ret);
                option.series[0].data = ret.data[1];
                option.series[1].data = ret.data[2];
                option.series[2].data = ret.data[3];

                myChart= echarts.init($('#J_bdtsCharts')[0]);
                myChart.setOption(option);
            });

            function lastMoth() {
                var lastMonth = [];
                for(var i = 0;i<30;i++){
                    lastMonth.unshift(new Date(new Date()
                        .setDate(new Date().getDate()-i))
                        .toLocaleDateString())
                }

                return lastMonth;
            }
        },

        analytics: function ($) {
            var _source = $('[data-wba-source]').length && $('[data-wba-source]').data('wba-source') || window.wbaSource || document.domain;
            $('a[data-wba-campaign]').each(function () {
                var me = $(this),
                    _campaign = me.data('wba-campaign'),
                    _media = me.data('wba-media') || 'link',
                    _url = me.attr('href');

                _url += _url.match("[\?]") ? '&' : '?';
                _url += 'utm_source=' + _source;
                _url += '&utm_media=' + _media;
                _url += '&utm_campaign=' + _campaign;

                me.attr('href',_url);
            })
        }
    };

    jQuery(function ($) {
        WB.BDSL.bdChart($);
        WB.BDSL.analytics($);

        $('#wb_bdsl_bdkey').on('input change',function () {
            if($(this).val() != '') {
                $('#J_checkToken').addClass('active');
            }
        });

        $('#optionsframework-wrap').find('input,textarea').on('change',function () {
            $(window).on('beforeunload',function(){
                return confirm("您修改的设置尚未保存，确定离开此页面吗？");
            });

            $('#optionsframework-submit').addClass('sticky-bottom');
        });

        $('#optionsframework-submit .wbs-btn-primary').on('click',function () {
            $(window).unbind('beforeunload');
        });
    })
</script>
