<?php
namespace Craft;

class SocialShareTwigExtension extends \Twig_Extension
{
  public function getName()
  {
    return 'SocialShare';
  }

  public function getFunctions()
  {
    return array(
      'SocialShareScripts' => new \Twig_Function_Method($this, 'getSocialShareScripts'),
      'SocialBtn' => new \Twig_Function_Method($this, 'getSocialBtn'),
      'SocialBtns' => new \Twig_Function_Method($this, 'getSocialBtns')
    );
  }

  public function getSocialShareScripts($opts = null)
  {
    switch ($opts) {
      case 'facebook':
        // Facebook Scripts
        $scripts = "<div id=\"fb-root\"></div><script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = \"//connect.facebook.net/en_US/all.js#xfbml=1&appId=543069402473732\"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>";
        break;

      case 'twitter':
        // Twitter scripts
        $scripts = "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"https://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>";
        break;

      case 'google':
        $scripts  = "<script type=\"text/javascript\">";
        $scripts .= "  (function() {";
        $scripts .= "    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;";
        $scripts .= "    po.src = 'https://apis.google.com/js/platform.js';";
        $scripts .= "    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);";
        $scripts .= "  })();";
        $scripts .= "</script>";
        break;
      
      default:
        $scripts = "<div id=\"fb-root\"></div><script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = \"//connect.facebook.net/en_US/all.js#xfbml=1&appId=543069402473732\"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>";
        $scripts .= "\r";
        $scripts .= "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"https://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>";
        $scripts .= "\r";
        $scripts .= "<script type=\"text/javascript\">(function() {var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.src = 'https://apis.google.com/js/platform.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s); })(); </script>";
        break;
    }

    echo $scripts;
  }


  public function getSocialBtn($type = null, $url = null, $width = '100px') {
    
    if ( !$url ) {
      // Get Current URL
      $url = craft()->request->getHostInfo();
      $url .= craft()->request->getUrl();
    }

    switch ($type) {
      case 'facebook':
        $button = "<div class=\"fb-like\" data-href=".$url." data-width=".$width." data-layout=\"button_count\" data-action=\"like\" data-show-faces=\"false\" data-share=\"false\"></div>";
        break;

      case 'twitter':
        $button = "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-size=".$width." data-url=". $url ." data-lang=\"en\">Tweet</a>";
        break;

      case 'google':
        $button = "<div class=\"g-plusone\" data-annotation=\"inline\" data-width=".$width."></div>";
        break;
      
      default:
        $button = null;
        break;
    }

    echo $button;
  }


  public function getSocialBtns($width = '120')
  {
    // Get Current URL
    $url = craft()->request->getHostInfo();
    $url .= craft()->request->getUrl();

    $buttons = "<div class=\"fb-like\" data-href=". $url ." data-width=". $width ." data-layout=\"button_count\" data-action=\"like\" data-show-faces=\"false\" data-share=\"false\"></div>";
    $buttons .= "\r";
    $buttons .= "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-url=". $url ." data-lang=\"en\"></a>";
    $buttons .= "\r";
    $buttons .= "<div class=\"g-plusone\" data-annotation=\"inline\" data-width=\"120\"></div>";

    echo $buttons;
  }
}
