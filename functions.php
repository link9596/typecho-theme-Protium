<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $ctext = new Typecho_Widget_Helper_Form_Element_Text('ctext', NULL, NULL, _t('评论框提示文字'), _t('在评论框显示评论提示文字'));
    $form->addInput($ctext);

    $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL,NULL, _t('文章置顶'), _t('输入置顶文章的cid，cid可在文章链接中找到<br>多条置顶请按排序输入, 以英文逗号或空格分隔'));
    $form->addInput($sticky);

    $sitetime = new Typecho_Widget_Helper_Form_Element_Text('sitetime', NULL, NULL, _t('站点建立时间戳'), _t('输入后计算时间显示在博客底部'));
    $form->addInput($sitetime);

    $siteimg = new Typecho_Widget_Helper_Form_Element_Text('siteimg', null, null, _t('站点主题图片'), _t('各页面上显示的主题图片'));
    $form->addInput($siteimg);

    $navcolor = new Typecho_Widget_Helper_Form_Element_Text('navcolor', null, null, _t('导航栏颜色'), _t('顶部导航栏的颜色，默认为靛蓝，可填十六进制颜色代码或者rgba代码。<br>导航栏默认有高斯模糊，设置为<strong>透明或半透明</strong>即可生效<br>建议值：<code>rgba(0,0,0, .5)</code>'));
    $form->addInput($navcolor);

    $navtone = new Typecho_Widget_Helper_Form_Element_Select('navtone', array(
        '0' => '浅色',
        '1' => '深色'
    ), '0', _t('导航栏色调'), '导航栏文字以及图标的基础色调');
    $form->addInput($navtone);

$pjax = new Typecho_Widget_Helper_Form_Element_Checkbox('pjax',
    array(
      'InstantClick' => _t('启用Instantclick预加载'),
      ),
    array('InstantClick') ,
    _t('Instantclick预加载'),
    _t('Instantclick利用无刷新和预加载技术，提高网页加载速度，为了兼容性，主题已默认强制关闭反垃圾保护'));
    $form->addInput($pjax->multiMode()); 


    $Links = new Typecho_Widget_Helper_Form_Element_Textarea('Links', NULL, NULL, _t('友链列表'), _t('输入格式：<br><strong>友链名称,地址,描述,头像</strong><br>一行一个，用英文逗号隔开，所有信息必须填写<br>在创建页面时选择自定义模板：友情链接'));
	$form->addInput($Links);

/*    
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项')),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));
    
    $form->addInput($sidebarBlock->multiMode());
*/
}

    //友链解析
function Links($sorts = NULL) {
    $options = Typecho_Widget::widget('Widget_Options');
    $link = NULL;
    if ($options->Links) {
        $list = explode("\r\n", $options->Links);
        foreach ($list as $val) {
            list($name, $url, $description, $headimg) = explode(",", $val);
            $link .= $url ? '<div class="link-chip" style="margin-bottom:15px;"><img src="'.$headimg.'" class="link-chip-icon"><a title="'.$description.'" href="'.$url.'" target="_blank" class="link-chip-title">'.$name.'</a></div>' : ''.$description.''.$name.'';
           
        }
    }
    echo $link ? $link : '暂无链接';
}
    //获取评论数据，用于@用户
function get_comment($coid){
    $db = Typecho_Db::get();
    return $db->fetchRow($db->select()
            ->from('table.comments')
            ->where('coid = ?', $coid)
            ->limit(1));
}

function themeInit($archive){
    //破解回复最高楼层
    Helper::options()->commentsMaxNestingLevels = 999;
    //强制关闭反垃圾评论
    Helper::options()->commentsAntiSpam = false;
    //将最新的评论展示在前
    Helper::options()->commentsOrder = 'DESC';
    //关闭检查评论来源URL与文章链接是否一致判断
    Helper::options()->commentsCheckReferer = false;
    //允许图像标签，用于表情
    Helper::options()->commentsHTMLTagAllowed .= '<img class src alt>';
}

    //输出标签
function printTag($that) { ?>
            <div style="color: #B0BEC5">标签: <?php if (count($that->tags) > 0): ?>
            <?php foreach( $that->tags as $tags): ?><a style="font-weight:bold;color: #E91E63" href="<?php print($tags['permalink']) ?>"><span>#<?php print($tags['name']) ?></span></a>
            <?php endforeach;?>
        <?php else: ?>
            <a><span style="color: #B0BEC5">无标签</span></a>
        <?php endif;?>
<?php } ?>