(function() {

  var s = document.getElementsByTagName('script')[0];

  // Google +1
  var po = document.createElement('script');
  po.type = 'text/javascript'; po.async = true; po.src = 'https://apis.google.com/js/plusone.js';
  s.parentNode.insertBefore(po, s);

  // Twitter
  var twitter = document.createElement('script');
  twitter.type = 'text/javascript'; twitter.src = 'https://platform.twitter.com/widgets.js';
  s.parentNode.insertBefore(twitter, s);

  // Facebook
  var fb = document.createElement('script');
  fb.type = 'text/javascript'; fb.src = 'https://connect.facebook.net/en_US/all.js#xfbml=1';
  s.parentNode.insertBefore(fb, s);

 })();