<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="<?php if ($this->options->navcolor): ?><?php $this->options->navcolor() ?><?php else: ?>#3F51B5<?php endif; ?>">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('styles.css'); ?>">

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?d630b59add775a31d2b046bbcc270d67";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>


    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header('commentReply='); ?>
</head>
<style>
.site-header {
   background-color: <?php if ($this->options->navcolor):  $this->options->navcolor() ?><?php else: ?>#3F51B5<?php endif; ?>;
   }
.page-header {
   background: url("<?php if ($this->options->siteimg): ?><?php $this->options->siteimg() ?><?php else: ?><?php $this->options->themeUrl('/img/bkg.png'); ?><?php endif; ?>") no-repeat center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size:cover; max-width:100%; margin: auto;text-align: center;margin-bottom:65px;
}
</style>

<body>

<header class="site-header" role="banner">

  <div class="wrapper">
<?php if($this->is('index')): ?><?php else: ?>
      <a style="<?php if ($this->options->navtone): ?>color:#222<?php else: ?><?php endif; ?>" class="site-title" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>
<?php endif; ?>
      <nav class="site-nav line">
        <input type="checkbox" id="nav-trigger" class="nav-trigger" />
        <label class="ripple" for="nav-trigger">
          <span class="menu-icon">
            <svg viewBox="0 0 18 15" width="18px" height="15px">
              <path fill="<?php if ($this->options->navtone): ?>#222<?php else: ?>#fff<?php endif; ?>" d="M18,1.484c0,0.82-0.665,1.484-1.484,1.484H1.484C0.665,2.969,0,2.304,0,1.484l0,0C0,0.665,0.665,0,1.484,0 h15.031C17.335,0,18,0.665,18,1.484L18,1.484z"/>
              <path fill="<?php if ($this->options->navtone): ?>#222<?php else: ?>#fff<?php endif; ?>" d="M18,7.516C18,8.335,17.335,9,16.516,9H1.484C0.665,9,0,8.335,0,7.516l0,0c0-0.82,0.665-1.484,1.484-1.484 h15.031C17.335,6.031,18,6.696,18,7.516L18,7.516z"/>
              <path fill="<?php if ($this->options->navtone): ?>#222<?php else: ?>#fff<?php endif; ?>" d="M18,13.516C18,14.335,17.335,15,16.516,15H1.484C0.665,15,0,14.335,0,13.516l0,0 c0-0.82,0.665-1.484,1.484-1.484h15.031C17.335,12.031,18,12.696,18,13.516L18,13.516z"/>
            </svg>
          </span>
        </label>

        <div class="trigger">
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <a class="page-link" <?php if($this->is('page', $pages->slug)): ?> "<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                    <?php endwhile; ?>
        </div>
      </nav>
  </div>
</header>


    <section style="margin-bottom:30px" class="page-header">
      <h1 class="project-name">
             <?php if($this->is('index')): ?>
<?php $this->options->title() ?>
<?php else: ?>
<?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', '  '); ?>
<?php endif; ?>
       </h1>
      <?php if($this->is('index')): ?><h2 class="project-tagline">
<?php $this->options->description() ?></h2>
<?php else: ?><h2 class="project-date">
<time datetime="<?php $this->date('M d , Y');; ?>" itemprop="datePublished"><?php $this->date('M d , Y'); ?></time>
          • <span class="header-tags" itemprop="name"><?php $this->author(); ?> • <?php $this->category(','); ?></span></span>
        </h2>
<?php endif; ?>

      </section>

<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->
<section class="main-content fade">
<div id="body">
    <div class="container">
        <div class="row">

    
    
