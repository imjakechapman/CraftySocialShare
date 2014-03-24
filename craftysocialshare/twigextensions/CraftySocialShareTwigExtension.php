<?php
namespace Craft;

// Define our script instead of rewriting them everywhere
define("FACEBOOK_SCRIPT", "<div id=\"fb-root\"></div><script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = \"//connect.facebook.net/en_US/all.js#xfbml=1&appId=543069402473732\"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>");

define("TWITTER_SCRIPT", "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"https://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>");

define("GOOGLE_SCRIPT", "<script type=\"text/javascript\">(function() {var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.src = 'https://apis.google.com/js/platform.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s); })(); </script>");


class CraftySocialShareTwigExtension extends \Twig_Extension
{
  public function getName()
  {
    return 'CraftySocialShare';
  }

  public function getFunctions()
  {
    return array(
      'SocialShareScripts' => new \Twig_Function_Method($this, 'getSocialShareScripts'),
      'SocialBtn' => new \Twig_Function_Method($this, 'getSocialBtn'),
      'SocialBtns' => new \Twig_Function_Method($this, 'getSocialBtns')
    );
  }


  /*
   * @param
   * $scripts(string) - pipe delimited list of scripts to include
   *
   * @return
   * $scripts(string) = echos appropriate script tags
   */
  public function getSocialShareScripts($scriptList = null)
  {

    $scripts = ''; // scripts to echo

    if ( $scriptList != null ) {
      $scriptList = explode('|', $scriptList); // pipe delimited list of scripts to include

      foreach ($scriptList as $script) {
        if ( $script == 'facebook' ) {

          $scripts .= FACEBOOK_SCRIPT;

        } elseif ( $script == 'twitter' ) {

          $scripts .= TWITTER_SCRIPT;

        } elseif ( $script == 'google' ) {

          $scripts .= GOOGLE_SCRIPT;

        }
      } // end foreach

    } else {
       $scripts .= FACEBOOK_SCRIPT;
       $scripts .= TWITTER_SCRIPT;
       $scripts .= GOOGLE_SCRIPT;
    } // end if

    echo $scripts;
  }


  /*
   * @param
   * $type(string, required) - Type of button to display
   * $url(string, optional) - URL to use for button (default is current request url)
   * $opts(array, optional) - override parameters for button data attributes
   *
   * @return
   * (string) - echos appropriate button markup
   */
  public function getSocialBtn($type = null, $opts = null) {

    $url = $this->checkOpt($opts['url'], craft()->request->getHostInfo() . craft()->request->getUrl());

    switch ($type) {
      case 'facebook':

        if ( $opts !== null ) {

          $button = "<div class=\"fb-like\" data-href=". $url ." data-width=\"{$this->checkOpt($opts["width"], '100px')}\" data-layout=\"{$this->checkOpt($opts['layout'], 'button')}\" data-action=\"{$this->checkOpt($opts["action"], 'like')}\" data-show-faces=\"{$this->checkOpt($opts['faces'], 'false')}\" data-share=\"{$this->checkOpt($opts['share'], 'false')}\"></div>";

        } else {
          $button = "<div class=\"fb-like\" data-href=". $url ." data-width=\"100px\" data-layout=\"button_count\" data-action=\"like\" data-show-faces=\"false\" data-share=\"false\"></div>";
        }

        break;

      case 'twitter':

        if ( $opts !== null ) {
          $button = "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-size=\"{$this->checkOpt($opts["size"], '100px')}\" data-via=\"{$this->checkOpt($opts["via"], '')}\" data-url=\"{$this->checkOpt($opts["url"], $url)}\" data-lang=\"{$this->checkOpt($opts["lang"], 'en')}\" data-text=\"{$this->checkOpt($opts["text"], '')}\" data-related=\"{$this->checkOpt($opts["related"], '')}\" data-count=\"{$this->checkOpt($opts["count"], 'none')}\" data-counturl=\"{$this->checkOpt($opts["counturl"], $url)}\" data-hashtags=\"{$this->checkOpt($opts["hashtags"], "")}\" data-dnt=\"{$this->checkOpt($opts["opt-out"], "false")}\">Tweet</a>";
        } else {
          $button = "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-size=\"100px\" data-url=". $url ." data-lang=\"en\">Tweet</a>";
        }

        break;

      case 'google':
        if ( $opts !== null ) {
          $button = "<div class=\"g-plusone\" data-href=\"{$this->checkOpt($opts["href"], $url)}\" data-size=\"{$this->checkOpt($opts["size"], 'standard')}\" data-annotation=\"{$this->checkOpt($opts["annotation"], 'bubble')}\" data-width=\"{$this->checkOpt($opts["width"], '120')}\" data-align=\"{$this->checkOpt($opts["align"], 'left')}\" expandTo=\"{$this->checkOpt($opts["expandTo"], '')}\" data-recommendations=\"{$this->checkOpt($opts["recommendations"], 'true')}\" data-count=\"{$this->checkOpt($opts["count"], 'true')}\"></div>";
        } else {
          $button = "<div class=\"g-plusone\" data-annotation=\"inline\" data-width=\"120px\"></div>";
        }
        break;
      
      default:
        $button = null;
        break;
    }

    echo $button;
  }


  /*
   * @param
   * $type(string) - Type of button to display
   * $url(string) - URL to use for button (default is current request url)
   * $width(string) - Width in pixels for button to be
   *
   * @return
   * $button(string) - echos appropriate button markup
   */
  public function getSocialBtns($btnList = null, $width = '120')
  {
    $buttons = ''; // our return list of markup
    $btnList = explode('|', $btnList); // pipe delimited list of buttons to include
    $url = craft()->request->getHostInfo() . craft()->request->getUrl(); // Get Current URL

    if ( $btnList != null ) {
      foreach ($btnList as $btn) {
        
        if ( $btn == 'facebook' ) {

          $buttons .= "<div class=\"fb-like\" data-href=". $url ." data-width=". $width ." data-layout=\"button_count\" data-action=\"like\" data-show-faces=\"false\" data-share=\"false\"></div>";

        } elseif ( $btn == 'twitter' ) {

          $buttons .= "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-url=". $url ." data-lang=\"en\"></a>";

        } elseif ( $btn == 'google' ) {

          $buttons .= "<div class=\"g-plusone\" data-annotation=\"inline\" data-width=\"120\"></div>";

        } else {
          $buttons = "<div class=\"fb-like\" data-href=". $url ." data-width=". $width ." data-layout=\"button_count\" data-action=\"like\" data-show-faces=\"false\" data-share=\"false\"></div>";
          $buttons .= "\r";
          $buttons .= "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-url=". $url ." data-lang=\"en\"></a>";
          $buttons .= "\r";
          $buttons .= "<div class=\"g-plusone\" data-annotation=\"inline\" data-width=\"120\"></div>";
        }

      }
    }

    echo $buttons;
  }



  public function checkOpt($var, $fallback) {
    if ( $var == null ) {
      return $fallback;
    } else {
      return $var;
    }
  }


}