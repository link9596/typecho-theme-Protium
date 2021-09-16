<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
 
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>
 
<div id="li-<?php $comments->theId(); ?>" class="line comment-box comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div id="<?php $comments->theId(); ?>">
        <div class="comment-author">
            <?php $comments->gravatar('80', ''); ?>
            <span style="color:#888;position: absolute;" class="fn"><?php $comments->author(); ?></span>
        
        <span class="comment-meta">
            <span style="color:#aaa;font-size:12px;" href="<?php $comments->permalink(); ?>"><?php $comments->date('M d , Y H:i'); ?></span>

            <span style="font-size:13px;float:right" class="comment-reply"><?php $comments->reply(); ?></span>
        </span></div>
        <div class="cimg" style="margin:0px 0px 20px 43px"><?php
                    $pcomments = get_comment($comments->parent);
                    if ($pcomments) echo '<span style="color:#aaa;background-color:#eee;border-radius:5px;padding:4px 8px;font-size:12px;">@' . $pcomments['author'] . '</span>';
                    ?><?php $comments->content(); ?></div>
    </div>
<?php if ($comments->children) { ?>
    <div style="margin-left:0px" class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</div>
<?php } ?>

<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/owo/OwO.min.css'); ?>">
<script src="<?php $this->options->themeUrl('/assets/owo/OwO.js'); ?>"></script>
<script type="text/javascript">  
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
        create : function (tag, attr) {
            var el = document.createElement(tag);
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
            return el;
        },
        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<?php echo $this->respondId(); ?>'),
                input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];
            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });
                form.appendChild(input);
            }
            input.setAttribute('value', coid);
            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });
                response.parentNode.insertBefore(holder, response);
            }
            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';
            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }
            return false;
        },
        cancelReply : function () {
            var response = this.dom('<?php echo $this->respondId(); ?>'),
            holder = this.dom('comment-form-place-holder'),
            input = this.dom('comment-parent');
            if (null != input) {
                input.parentNode.removeChild(input);
            }
            if (null == holder) {
                return true;
            }
            this.dom('cancel-comment-reply-link').style.display = 'none';           holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();




</script>

<hr>
<span id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
	<h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>

<?php $comments->listComments(); ?>
    
<?php endif; ?>

<div style="margin-left:-40px" class="page-pagination">
                <?php
                $comments->pageNav(
                    '<span style="color:#E91E63;height:18px;margin-bottom:-4px"><</span>',
                    '<span style="color:#E91E63;height:18px;margin-bottom:-4px">></span>',
                    0, '…', array(
                    'wrapTag' => 'ul',
                    'wrapClass' => 'comment-pagination',
                    'itemTag' => 'li',
                    'itemClass' => 'page-item',
                    'linkClass' => 'page-link',
                    'currentClass' => 'activepage'
                ));
                ?>


            </div>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply"><?php $comments->cancelReply('<button style="background-color:#E57373;color:#fff" class="md-btn ripple">取消回复</button>'); ?>
        
        </div>
    
    	<h3 id="response"><?php _e('添加新评论'); ?></h3>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
    		<p><?php _e('登录身份: '); ?><span class="hy-chip"><a class="hy-chip-title" href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a><span style="color:#fff">|</span><a class="hy-chip-title" href="<?php $this->options->logoutUrl(); ?>" title="Logout">退出</a></span></p>
            <?php else: ?>
    		<div class="reply-box"><p>
                <label for="author" class="required"></label>
    			<input placeholder="称呼" style="margin-bottom:10px" class="comment-input" type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
    		
    		
                <label class="comment-input" for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>></label>
    			<input placeholder="E-mail" style="margin-bottom:10px" class="comment-input" type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
    		

                <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>></label>
    			<input placeholder="网址(http://)" class="comment-input" type="url" name="url" id="url" class="text" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
    		</p>
            <?php endif; ?>
<?php if($this->user->hasLogin()): ?>
<div class="comment-panel"><?php endif; ?>
    		<p>
                <label for="textarea" class="required">
</label>
                <textarea hidefocus="true" placeholder="<?php if ($this->options->ctext): ?><?php $this->options->ctext() ?><?php else: ?>快来留下你可爱的评论吧owo<?php endif; ?>" class="OwO-textarea comment-input" style="width:100%;padding:20px 15px;" rows="8" cols="50" name="text" id="textarea" class="textare" required ><?php $this->remember('text'); ?></textarea>
            </p>
    		<p>
                
<button style="color:#fff;background-color:#66BB6A" type="submit" class="submit md-btn ripple"><?php _e('提交评论'); ?></button>
<div class="OwO"></div>
<script type="text/javascript">  
 var OwO_demo = new OwO({
            logo: 'OωO',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementsByClassName('OwO-textarea')[0],
            api: '<?php $this->options->themeUrl('/assets/owo/OwO.json'); ?>',
            position: 'down',
            width: '100%',
            maxHeight: '250px'
        });
</script> 
            </p></div>
    	</form>
    </div>

<?php if (!empty($this->options->pjax) && in_array('InstantClick', $this->options->pjax)): ?>
        <script type="text/javascript" data-no-instant>
            (function () {
                var event = document.addEventListener ? {
                    add: 'addEventListener',
                    focus: 'focus',
                    load: 'DOMContentLoaded'
                } : {
                    add: 'attachEvent',
                    focus: 'onfocus',
                    load: 'onload'
                };
                document[event.add](event.load, function () {
                    var r = document.getElementById('<?php echo $this->respondId(); ?>');
                    if (null != r) {
                        var forms = r.getElementsByTagName('form');
                        if (forms.length > 0) {
                            var f = forms[0],
                                textarea = f.getElementsByTagName('textarea')[0],
                                added = false;
                            if (null != textarea && 'text' == textarea.name) {
                                textarea[event.add](event.focus, function () {
                                    if (!added) {
                                        var input = document.createElement('input');
                                        input.type = 'hidden';
                                        input.name = '_';
                                        input.value = (function () {
                                            var _a8C5A = //'xr'
                                                    '8d0' + //'vI'
                                                    'vI' + /* 'mj'//'mj' */ '' + //'P'
                                                    '06' + 'd' //'chS'
                                                    + //'wo'
                                                    '0ef' + '41' //'9G'
                                                    + '8c8' //'R'
                                                    + //'p1'
                                                    'd0' + //'mi'
                                                    'mi' + 'baf' //'lu'
                                                    + 'c' //'dm'
                                                    + //'ED'
                                                    '1a9' + //'Lh'
                                                    'd9' + '6' //'luM'
                                                    + //'xH'
                                                    'f1' + //'W'
                                                    '2c7' + 'f' //'f'
                                                    + //'9'
                                                    '9' + //'Nd'
                                                    'Nd' + /* '8ys'//'8ys' */ '' + '' ///*'6Yc'*/'6Yc'
                                                    + //'H'
                                                    '0',
                                                _LceE8M = [
                                                    [3, 5],
                                                    [16, 18],
                                                    [31, 32],
                                                    [31, 32],
                                                    [31, 33]
                                                ];
                                            for (var i = 0; i < _LceE8M.length; i++) {
                                                _a8C5A = _a8C5A.substring(0, _LceE8M[i][0]) + _a8C5A.substring(_LceE8M[i][1]);
                                            }
                                            return _a8C5A;
                                        })();
                                        f.appendChild(input);
                                        added = true;
                                    }
                                });
                            }
                        }
                    }
                });
            })();
        </script>
      <?php else : ?>
      <?php endif; ?>

    <?php else: ?>
    <div class="abort"><?php _e('评论已关闭'); ?></div>
    <?php endif; ?>
</span>