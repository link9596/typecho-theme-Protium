<?php 
/**
* 友情链接
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>


<div class="col-mb-12 col-8" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
            <?php Links(); ?>
        </div>
    </article>





<?php $this->need('footer.php'); ?>