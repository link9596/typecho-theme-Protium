<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div style="margin:-28px 0px 20px 0px" class="form-group">
                 <form id="search" role="search" method="post" action="<?php $this->options->siteUrl(); ?>" >
                 <input type="text" name="s" class="form-control" id="s" required="required" onkeydown=KeyDown()/>
                 <label for="s" class="form-label">Search</label>
                 
               </div>

    <div class="col-mb-12 col-8" id="main" role="main">
        <h3 class="archive-title"><?php $this->archiveTitle(array(
            'category'  =>  _t('<span style="color:#607D8B">分类<span style="color:#E91E63"> # %s </span>下的文章</span>'),
            'search'    =>  _t('<span style="color:#607D8B">包含关键字<span style="color:#E91E63"> # %s </span>的文章</span>'),
            'tag'       =>  _t('<span style="color:#607D8B">标签<span style="color:#E91E63"> # %s </span>下的文章</span>'),
            'author'    =>  _t('<span style="color:#607D8B"><span style="color:#E91E63"># %s </span>发布的文章</span>')
        ), '', ''); ?></h3>
        <?php if ($this->have()): ?>
    	<?php while($this->next()): ?>

            <article class="comment-panel post" itemscope itemtype="http://schema.org/BlogPosting">
    			<h2 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
    			<div class="post-meta">
    				<span itemprop="author" itemscope itemtype="http://schema.org/Person"><i style="margin:0px 2px -1px 0px" class="icon-edit"></i><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
    				<span><i style="margin:0px 2px -1px 0px" class="icon-tags"></i><?php $this->category(','); ?></span>
                    <span itemprop="interactionCount"><a href="<?php $this->permalink() ?>#comments"><i style="margin:0px 2px -1px 0px" class="icon-comment"></i><?php $this->commentsNum('评论', '1 条评论', '%d 条评论'); ?></a></span>
                    <span><i style="margin:0px 2px -1px 0px" class="icon-time"></i><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></span>
    			</div>
                <div class="post-content" itemprop="articleBody">
                </div>
    		</article>
    	<?php endwhile; ?>
        <?php else: ?>
            <article class="post">
                <h2 style="color:#607D8B;text-align:center" class="post-title"><?php _e('没有找到内容'); ?></h2>
            </article>
        <?php endif; ?>

        <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    </div><!-- end #main -->

	<?php $this->need('footer.php'); ?>
