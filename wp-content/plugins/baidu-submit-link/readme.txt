=== 百度搜索推送管理 ===
Contributors: wbolt,mrkwong
Donate link: https://www.wbolt.com/
Tags: Baidu, URL, 百度, 百度站长平台, SEO, 提交链接, 百度推送, 百度搜索推送, 百度搜索, SEO优化
Requires at least: 4.8
Tested up to: 5.1.1
Stable tag: 1.1.1
License: GNU General Public License v2.0 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

百度搜索推送管理插件是基于百度站长平台对站长开放的链接提交接口开发的，支持站长通过主动推送，自动推送和sitemap推送三种方式，向百度搜索引擎推送链接，提升百度搜索引擎对网站的收录效率。

== Description ==

百度搜索推送管理插件是基于百度站长平台对站长开放的链接提交接口开发的，支持站长通过主动推送，自动推送和sitemap推送三种方式，向百度搜索引擎推送链接，提升百度搜索引擎对网站的收录效率。

百度搜索推送管理是一款适用于站长管理WordPress博客内容URL的百度推送管理，其中包括：
（1）主动推送
支持博主通过配置百度主动推送准入密钥，主动向Baidu提交网站新增、更新和删除内容URL。并且可查看最近三十天的推送数据及推送错误日志。
（2）自动推送
支持博主直接开关按钮来配置百度主动推送功能。自动推送是百度搜索资源平台为提高站点新增网页发现速度推出的工具，安装自动推送JS代码的网页，在页面被访问时，页面URL将立即被推送给百度。
（3）Sitemap推送
Sitemap推送功能也是百度站长URL提交功能之一，本插件只实现读取WordPress博客sitemap生成状态，方便博主快速复制Sitemap地址，到百度站长平台提交sitemap地址。

该插件的主要目的在于，大大提升原创内容网站数据被百度搜索引擎收录的效率，对网站内容起到一定的保护作用。


== Installation ==

FTP安装
1. 解压插件压缩包baidu-submit-link.zip，将解压获得文件夹上传至wordpress安装目录下的 `/wp-content/plugins/`目录.
2. 访问WordPress仪表盘，进入“插件”-“已安装插件”，在插件列表中找到“百度搜索推送管理”，点击“启用”.
3. 通过“设置”->“百度搜索推送管理” 进入插件设置界面.
4. 至此，该插件安装完毕，次日即可访问百度站长后台查看百度搜索推送数据。

仪表盘安装
1. 进入WordPress仪表盘，点击“插件-安装插件”：
* 关键词搜索“百度搜索推送管理”，找搜索结果中找到“百度搜索推送管理”插件，点击“现在安装”；
* 或者点击“上传插件”-选择“百度搜索推送管理”插件压缩包baidu-submit-link.zip，点击“现在安装”。
2. 安装完毕后，启用 `百度搜索推送管理` 插件.
3. 通过“设置”->“百度搜索推送管理” 进入插件设置界面.
4. 至此，该插件安装完毕，次日即可访问百度站长后台查看百度搜索推送数据。

关于本插件，你可以通过阅读<a href="https://www.wbolt.com/bsl-plugin-documentation.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="插件教程">百度搜索推送管理插件教程</a>学习了解插件安装、设置等详细内容。

== Frequently Asked Questions ==

= 百度搜索推送插件推送设置推送提示超额 =
百度搜索资源平台目前URL更新/删除接口均无效，提示超额。如果你的百度搜索推送插件出现超额提示，请更新到插件最新版本，已经临时将URL更新和删除接口改为URL新增接口推送。

= 百度搜索推送管理插件是否可以生成网站Sitemap? =
不会。使用插件的Sitemap推送功能，需依赖第三方Sitemap插件，推荐<a href="https://wordpress.org/plugins/google-sitemap-generator/" rel="friend" title="插件教程">Google XML Sitemaps</a>

= Wbolt开发的WordPress主题是否兼容该插件? =

不兼容。Wbolt开发的WordPress主题内置了百度搜索推送功能，且提供更完整的SEO优化功能。

= 是否使用了百度搜索推送管理插件，即可保证百度搜索正常收录页面? =

不是的。百度搜索推送管理插件仅是帮助站长将WordPress博客更新的内容快速推送给百度搜索，以便于百度搜索快速地发现URL。但百度搜索是否收录及收录时效，由百度决定。但可以肯定的是，该插件是有利于做百度搜索优化的。

= 为什么百度搜索推送管理插件显示的主动推送数据与百度搜索资源平台后台显示的数据不一致? =

两者的数据肯定不一致。首先，百度搜索推送管理插件显示的主动推送数据指的是插件向百度搜索推送过去的数据；而百度搜索资源平台显示的主动推送数据是基于主动推送，自动推送和Sitemap推送三种数据来显示的，也就是说百度站长会依据三种推送进行去重显示数据。同时，使用三种方式向百度搜索推送数据，目的是为了做到相互补充，保证百度搜索获得更完整的URL数据。

== Notes ==

百度搜索推送管理插件是目前WordPress插件市场中功能最完善和最强大的<a href="https://www.wbolt.com/plugins/bsl?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="最好用的百度推送管理插件">百度推送管理插件</a>. 插件同时提供三种推送方式，且简单易用，超轻量代码设计，无论是老站还是新站，使用该插件都对百度搜索引擎优化有较大的作用。

闪电博（<a href="https://www.wbolt.com/?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="闪电博官网">wbolt.com</a>）专注于WordPress主题和插件开发,为中文博客提供更多优质和符合国内需求的主题和插件。此外我们也会分享WordPress相关技巧和教程。

除了百度搜索推送管理插件外，目前我们还开发了以下WordPress插件：

- [Smart SEO Tool](https://wordpress.org/plugins/smart-seo-tool/)
- [WP资源下载管理](https://wordpress.org/plugins/download-info-page/)
- [打赏/点赞/分享组件](https://wordpress.org/plugins/donate-with-qrcode/)
- 更多主题和插件，请访问<a href="https://www.wbolt.com/?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="闪电博官网">wbolt.com</a>!

如果你在WordPress主题和插件上有更多的需求，也希望您可以向我们提出意见建议，我们将会记录下来并根据实际情况，推出更多符合大家需求的主题和插件。

致谢！

闪电博团队

== Screenshots ==

1. 插件设置界面截图.
2. 百度搜索主动推送统计表截图.
3. 百度站长后台推送统计截图
4. 百度站长后台Sitemap推送设置截图

== Changelog ==
= 1.1.1 =
* 优化URL更新/删除推送改用URL推送接口（百度搜索资源平台目前URL更新/删除接口均无效，提示超出限额）

= 1.1.0 =
* 增加插件教程/插件支持等链接入口
* 优化插件设置UI界面

= 1.0.1 =
* 修复推送结果类型
* 修复php低版本无法工作的问题

= 1.0.0 =
* 新增百度搜索自动推送功能
* 新增百度搜索sitemap推送功能
* 升级百度搜索主动推送功能，实现推送数据记录及报错日志提示
* 插件设置界面UI采用更规范统一的设计

= 0.1.1 =
* 新增百度站长链接提交准入密钥配置