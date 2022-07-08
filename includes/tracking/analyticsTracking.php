<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false){ // Do not serve GS to Page Speed Insights ?>
<<script async src="https://www.googletagmanager.com/gtag/js?id=G-T9JZJQ00X8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-T9JZJQ00X8');
</script>
<?php } ?>
