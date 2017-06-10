<?php
namespace Jarm\Core;

class Folder
{
  public $folder;
  public function __construct()
  {
    //debug_print_backtrace();
    $this->folder=_FILES;
  }

  public function save(string $file,string $data): bool
  {
    if(!is_dir(dirname($this->folder.$file)))
    {
      $this->_mkdir(dirname($this->folder.$file));
    }
    if($fp=@fopen($this->folder.$file, 'wb'))
    {
    //  $data=stripslashes($data);
      $len=strlen($data);
      @fwrite($fp, $data, $len);
      @fclose($fp);
      return true;
    }
    return false;
  }

  public function mkdir(string $dir,int $mode=0777): bool
  {
    if(!is_dir($this->folder.$dir))
    {
      $this->_mkdir($this->folder.$dir,$mode);
    }
    return true;
  }

  public function delete($file): bool
  {
    if(file_exists($this->folder.$file))
    {
      @unlink($this->folder.$file);
    }
    return true;
  }

  private function _mkdir($dir, $mode = 0777): void
  {
    if(!is_dir($dir))
    {
      $this->_mkdir(dirname($dir));
      @mkdir($dir, $mode);
      @chmod($dir, $mode);
    }
  }

  public function clean($type): bool
  {
    if (!is_dir($this->folder.$type)||!($dh=@opendir($this->folder.$type))) return false;
    $result=true;
    while($file=readdir($dh))
    {
      if(!in_array($file,['.','..']))
      {
        $file2=$type.'/'.$file;
        if(is_dir($this->folder.$file2))
        {
          $this->clean($file2);
        }
        else
        {
          @unlink($this->folder.$file2);
        }
      }
    }
    @rmdir($this->folder.$type);
    return true;
  }

  public function fd(int $i,bool $f=false): string
  {
    if(!preg_match('/^([0-9]{1,10})$/i',$i,$c))
    {
      die('folder->fd('.$i.'); - invalid number');
    }
    $a = [
    '0', '1', '2', '3','4', '5', '6', '7', '8', '9',
    'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
    'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
    'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
    'y', 'z'
    ];
    $s = '';
    $c = count($a);
    while($i > 0)
    {
      $s = (string)$a[$i % $c] . $s;
      $i = floor($i / $c);
    }
    $fd = '000000'.strval($s);
    return $f?substr($fd,-6,2).'/'.substr($fd,-4,2).'/'.substr($fd,-2,2):substr($fd,-6);
  }
}
?>
