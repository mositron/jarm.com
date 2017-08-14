<?php

require_once __DIR__.'/door.php';
require_once(_PHP.'Vendor/autoload.php');

$FILES=_FILES.'cdn/';

clean_gz();

$js = new \MatthiasMullie\Minify\JS();
$js->add($FILES.'lib/jquery/jquery.min.js');
$js->add($FILES.'lib/bootstrap/js/bootstrap.min.js');
$js->add($FILES.'js/lazyload/jquery.lazyload.min.js');
$js->add($FILES.'js/jarm.js');
$js->minify($FILES.'js/jarm-all.js');

$tmp = file_get_contents($FILES.'lib/bootstrap/css/bootstrap.min.css');
$css = new \MatthiasMullie\Minify\CSS();
$css->add(str_replace('../fonts/','../lib/bootstrap/fonts/',$tmp));
$css->add($FILES.'css/jarm-bootstrap.css');
$css->minify($FILES.'css/jarm-all.css');

make_gz();


//minify_html
define('TPL_default',_PHP.'Tpl/default/');
define('TPL_tmp',_PHP.'Tpl/tmp/');
$folder->folder=TPL_tmp;
make_tpl();

echo 'OK';

function make_tpl($type='')
{
  global $folder;
  if (!is_dir(TPL_default.$type)||!($dh=@opendir(TPL_default.$type))) return false;
  while($file=readdir($dh))
  {
    if(!in_array($file,['.','..']))
    {
      $file2=$type.'/'.$file;
      if(is_dir(TPL_default.$file2))
      {
        make_tpl($file2);
      }
      else
      {
        $tmp = minify_html(file_get_contents(TPL_default.$file2));
        $folder->save($file2, $tmp);
      }
    }
  }
  return true;
}

function clean_gz($type='')
{
  if (!is_dir(_FILES.'cdn/'.$type)||!($dh=@opendir(_FILES.'cdn/'.$type))) return false;
  while($file=readdir($dh))
  {
    if(!in_array($file,['.','..']))
    {
      $file2=$type.'/'.$file;
      if(is_dir(_FILES.'cdn/'.$file2))
      {
        clean_gz($file2);
      }
      elseif(substr($file,-3)=='.gz')
      {
        @unlink(_FILES.'cdn/'.$file2);
      }
    }
  }
  return true;
}

function make_gz($type='')
{
  if (!is_dir(_FILES.'cdn/'.$type)||!($dh=@opendir(_FILES.'cdn/'.$type))) return false;
  while($file=readdir($dh))
  {
    if(!in_array($file,['.','..']))
    {
      $file2=$type.'/'.$file;
      if(is_dir(_FILES.'cdn/'.$file2))
      {
        make_gz($file2);
      }
      elseif(substr($file,-3)=='.js'||substr($file,-4)=='.css')
      {
        compress_gz(_FILES.'cdn/'.$file2);
      }
    }
  }
  return true;
}

function compress_gz($file,$lv=9)
{
  $to = $file.'.gz';
  $error = false;
  if($out = gzopen($to, 'wb'.$lv))
  {
    if($in = fopen($file,'rb'))
    {
      while(!feof($in))
      {
        gzwrite($out,fread($in, 1024 * 512));
      }
      fclose($in);
    }
    else
    {
      $error = true;
    }
    gzclose($out);
  }
  else
  {
    $error = true;
  }
  if($error)
  {
    return false;
  }
  else
  {
    return $to;
  }
}


function minify_html($input) {
    if(trim($input) === "") return $input;
    // Remove extra white-space(s) between HTML attribute(s)
    $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
        return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
    }, str_replace("\r", "", $input));
    // Minify inline CSS declaration(s)
    if(strpos($input, ' style=') !== false) {
        $input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function($matches) {
            return '<' . $matches[1] . ' style=' . $matches[2] . minify_css($matches[3]) . $matches[2];
        }, $input);
    }
    if(strpos($input, '</style>') !== false) {
      $input = preg_replace_callback('#<style(.*?)>(.*?)</style>#is', function($matches) {
        return '<style' . $matches[1] .'>'. minify_css($matches[2]) . '</style>';
      }, $input);
    }
    if(strpos($input, '</script>') !== false) {
      $input = preg_replace_callback('#<script(.*?)>(.*?)</script>#is', function($matches) {
        return '<script' . $matches[1] .'>'. minify_js($matches[2]) . '</script>';
      }, $input);
    }
    return preg_replace(
        array(
            // t = text
            // o = tag open
            // c = tag close
            // Keep important white-space(s) after self-closing HTML tag(s)
            '#<(img|input)(>| .*?>)#s',
            // Remove a line break and two or more white-space(s) between tag(s)
            '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
            '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
            '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
            '#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
            '#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
            '#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
            // Remove HTML comment(s) except IE comment(s)
            '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
        ),
        array(
            '<$1$2</$1>',
            '$1$2$3',
            '$1$2$3',
            '$1$2$3$4$5',
            '$1$2$3$4$5$6$7',
            '$1$2$3',
            '<$1$2',
            '$1 ',
            '$1',
            ""
        ),
    $input);
}
// CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
function minify_css($input) {
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
        ),
        array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2'
        ),
    $input);
}
// JavaScript Minifier
function minify_js($input) {
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
            // Remove white-space(s) outside the string and regex
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
            // Remove the last semicolon
            '#;+\}#',
            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
            '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
            // --ibid. From `foo['bar']` to `foo.bar`
            '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
        ),
        array(
            '$1',
            '$1$2',
            '}',
            '$1$3',
            '$1.$3'
        ),
    $input);
}
?>
