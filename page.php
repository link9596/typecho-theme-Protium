<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="col-mb-12 col-8" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        
        <div class="post-content line" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    </article>

    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->

    </div><!-- end #content-->

<?php $this->need('footer.php'); ?>
