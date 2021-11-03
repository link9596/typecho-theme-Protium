<?php
/**
 * 一款基于Material Design的极简主题
 * 
 * @package Protium for Typecho
 * @author Link
 * @version 1.2.0
 * @link https://atlinker.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 $this->need('/include/sticky.php');
 ?>

	<?php while($this->next()): ?>
         <ul style="" class="post-list">
    
      <li>

        <span class="post-meta"><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('M d , Y'); ?></time> <?php $this->sticky() ?></span>

        <h2>
          <a style="font-weight:300;" class="post-link" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
        </h2>

        <span><?php $this->excerpt(100, '...'); ?></span>

      </li>

  </ul>	<?php endwhile; ?>

<div style="margin-bottom:-35px" class="pagination">

      <?php if ($this->_currentPage>1){ ?>
					<?php $this->pageLink('<span class="cm-l"><img src="<?php $this->options->themeUrl('/assets/icon/left.svg'); ?>" style="height:28px;margin-left:12px"></span>'); ?>
				<?php } else { ?>
					<span class="cm-l"><img src="<?php $this->options->themeUrl('/assets/icon/leftdis.svg'); ?>" style="height:28px;margin-left:12px"></span>
				<?php } ?>
				<?php $totalpage=ceil($this->getTotal()/$this->parameter->pageSize); ?>
				<?php if ($this->_currentPage<$totalpage){ ?>
					<?php $this->pageLink('<span class="cm-r"><img src="<?php $this->options->themeUrl('/assets/icon/right.svg'); ?>" style="height:28px;margin-right:14px"></span>','next'); ?>
				<?php } else { ?>
					<span class="cm-r"><img src="<?php $this->options->themeUrl('/assets/icon/rightdis.svg'); ?>" style="height:28px;margin-right:14px"></span>
				<?php } ?>
			<div class="cm-c"><?php if($this->_currentPage>1) echo $this->_currentPage; else echo 1;?>/<?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?></div>
</div>
<!-- end #main-->

<?php $this->need('footer.php'); ?>
