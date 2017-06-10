<?php
namespace Jarm\App;
use Jarm\Core\Load;

class Container
{
  public function get_favicon_dot_ico()
  {
    header('Content-type: image/x-icon');
    readfile(_FILES.'cdn/favicon.ico');
    exit;
  }

  public function get_robots_dot_txt()
  {
    header('Content-type: text/plain');
    echo 'User-agent: *'."\n".'Disallow: /_cdn/';
    exit;
  }

  public function get_sitemap_dot_xml()
  {
    header('Content-type: text/xml; charset=utf-8');
    exit;
  }
}
?>
