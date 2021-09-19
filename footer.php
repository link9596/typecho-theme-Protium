<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->
<?php if (!empty($this->options->pjax) && in_array('InstantClick', $this->options->pjax)): ?>
<script src="<?php $this->options->themeUrl('/assets/js/click.js'); ?>" data-no-instant></script>
    <script data-no-instant>
        InstantClick.on('change', function (isInitialLoad) {
            document.getElementById('fold').style.height='0px';//初始化
            if (isInitialLoad === false) {
                if (typeof Prism !== 'undefined') Prism.highlightAll(true, null);
            if (typeof _hmt !== 'undefined') 
   _hmt.push(['_trackPageview', location.pathname + location.search]);//统计
            }
        });
        InstantClick.init();
    </script>
    <?php else : ?>
    <?php endif; ?>
</section>
 <section class="main-content fade">

      <footer class="site-footer">
        <span class="site-footer-owner">Theme <a href="https://github.com/link9596">Protium</a>.</span>
        <span class="site-footer-credits">Powered by<a href="https://github.com/link9596/tehydrogen/"> Link</a>.</span><br>
        <span class="site-footer-credits" style="font-size:12px">Already <span id="sitetime"></span> days.</span>

      </footer>
    </section>
      <script>
          ajax()
  function ajax(option){
    var xhr = null;
    if(window.XMLHttpRequest){
      xhr = new window.XMLHttpRequest();
    }else{ // ie
      xhr = new ActiveObject("Microsoft")
    }
    xhr.open("get","");
    xhr.send(null);
    xhr.onreadystatechange = function(){
      var time = null,
          curDate = null;
      if(xhr.readyState===2){
        // Get time
        time = xhr.getResponseHeader("Date");
        console.log(xhr.getAllResponseHeaders())
        curDate = new Date(time);
        document.getElementById("sitetime").innerHTML = (parseInt((((curDate.getTime() / 1000) - <?php $this->options->sitetime() ?> ) / 86400 )));
      }
    }
  }

    window.onload=function(){
      document.getElementById('fold').style.height='0px';//初始化
}
    function clean(){
      document.getElementById('fold').style.height='0px';
}
    function checkit(isChecked){
     if(isChecked)
       document.getElementById('fold').style.height='auto';
     else
       window.setTimeout(clean, 500);
}
      </script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?d630b59add775a31d2b046bbcc270d67";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>


</body>
</html>
