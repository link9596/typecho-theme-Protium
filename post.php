<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div style="padding:0px 0px">
<article class="line" itemscope itemtype="">

<script>
  document.getElementsByTagName("img").className="bbb";
  </script>
  
  <div itemprop="articleBody">
    <?php $this->content(); ?>
  </div>
        
<?php printTag($this); ?>

  </article>


    <?php $this->need('comments.php'); ?>
</div>
    <!--<ul class="post-near">
        <li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
        <li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
    </ul>-->
<!-- end #main-->

<?php $this->need('footer.php'); ?>