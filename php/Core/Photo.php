<?php
namespace Jarm\Core;
class Photo
{
  public $folder;
  public function __construct()
  {
    $this->folder=_FILES;
  }
  public function thumb($tid,$fromfile,$todir,$w=120,$h=90,$fix=false,$totype='jpg',$base64=false): string // $fix -> both , width , height
  {
    if(!$base64)
    {
      $todir=trim($todir,'/');
      $folder=Load::Folder();
      $folder->folder=$this->folder;
      $folder->mkdir($todir);
    }
    $original_w = $w;
    $original_h = $h;
    $size=@getimagesize($fromfile);
    switch (strtolower($size['mime']))
    {
       case 'image/gif':
        $image = @imagecreatefromgif($fromfile);
        $type="gif";
        break;
       case 'image/jpg':
       case 'image/jpeg':
        $image = @imagecreatefromjpeg($fromfile);
        $type="jpg";
        break;
       case 'image/png':
       case 'image/x-png':
        $image = @imagecreatefrompng($fromfile);
        $type="png";
        imagealphablending($image, true);
        break;
    }
    if(isset($image))
    {
      $_x=0;
      $_y=0;
      $x=0;
      $y=0;
      $w2=0;
      $h2=0;
      $_w=$size[0];
      $_h=$size[1];
      $ratio = $_w/$_h;
      $filename = $tid.'.'.$totype;
      if($fix=='height'&&!($_w<$w&&$_h<$h))
      {
        if($_h<$h)$h=$_h;
        $w2 = (int)($ratio*$h);
        $w=($w<$w2?$w:$w2);
        $fix='bothtop';
      }

      if(in_array($fix,['both','bothtop']))
      {
        $ratioComputed    = $_w / $_h;
        $cropRatioComputed  = $w/$h;
        if ($ratioComputed < $cropRatioComputed)
        {
          $origHeight  = $_h;
          $_h  = $_w / $cropRatioComputed;
          $y=($fix=='bothtop')?0:(($origHeight - $_h) / 2);
        }
        else if ($ratioComputed > $cropRatioComputed)
        {
          $origWidth  = $_w;
          $_w    = $_h * $cropRatioComputed;
          $x  = ($origWidth - $_w) / 2;
        }
        $xRatio    = $w / $_w;
        $yRatio    = $h / $_h;
        if ($xRatio * $_h < $h)
        {
          $h  = ceil($xRatio * $_h);
          $w  = $w;
        }
        else
        {
          $w  = ceil($yRatio * $_w);
          $h  = $h;
        }
      }
      elseif($fix=='widthheight')
      {
        $ratioComputed    = $_w / $_h;
        $cropRatioComputed  = $w/$h;
        if ($ratioComputed > $cropRatioComputed)
        {
          $_y = ceil((((($_h - ($_w / $cropRatioComputed)) / 2)*-1)/($_w / $cropRatioComputed))*$h);
          $h2 = ceil($w / $ratio);
        }
        else if ($ratioComputed < $cropRatioComputed)
        {
          $_x = ceil((((($_w - ($_h * $cropRatioComputed)) / 2)*-1)/($_h * $cropRatioComputed))*$w);
          $w2 = ($ratio * $h);
        }
      }
      elseif($fix=='height')
      {
        if($_h<$h)$h=$_h;
        $w = (int)($ratio*$h);
      }
      elseif($fix=='width')
      {
        if($_w<$w)$w=$_w;
        $h = (int)($w/$ratio);
      }
      elseif($fix=='inboth')
      {
        if($totype=='gif' && $_w<=$w && $_h<=$h && !$base64)
        {
          @imagedestroy($image);
          @copy($fromfile, $this->folder.$todir.'/'.$tid.'.gif');
          return $tid.'.gif';
        }
        else
        {
          if($_w<$w)
          {
            $w=$_w;
          }
          $h2 = (int)($w/$ratio);
          if($h2>$h)
          {
            $w=intval($ratio*$h);
            $h2=$h;
          }
          else
          {
            $h=$h2;
          }

          #else
          #{
          #  $h=$h2;
          #}
        }
      }
      else
      {
        if($_w>$_h){
          $h = $_h * $w / $_w;
          }else{
              $w = $_w * $h / $_h;
        }
      }
      if($w<1)$w=1;
      if($h<1)$h=1;
      if($_w<1)$_w=1;
      if($_h<1)$_h=1;

      if(in_array($fix,['both','bothtop']))
      {
        $output = @imagecreatetruecolor($original_w,$original_h);
      }
      else
      {
        $output = @imagecreatetruecolor($w,$h);
      }

      if(!in_array($totype,['png','gif']) || $fix=='widthheight')
      {
        @imagefill($output, 0, 0, @imagecolorallocate($output, 255, 255, 255));
      }
      elseif(in_array($type,['png','gif']) && $totype=='jpg')
      {
        @imagefill($output, 0, 0, @imagecolorallocate($output, 255, 255, 255));
      }
      elseif($totype!='jpg')
      {
        imagealphablending($output, false);
        imagesavealpha($output, true);
      }

      @imagecopyresampled($output, $image, $_x, $_y, $x, $y, $w2?$w2:$w, $h2?$h2:$h, $_w, $_h);
      if(!$base64)
      {
        if($totype=='png')
        {
          $filename = $tid.'.png';
          @imagepng($output, $this->folder.$todir.'/'.$filename, 0);
        }
        elseif($totype=='gif')
        {
          $filename = $tid.'.gif';
          @imagegif($output, $this->folder.$todir.'/'.$filename);
        }
        else
        {
          $filename = $tid.'.jpg';
          @imagejpeg($output, $this->folder.$todir.'/'.$filename, 85);
        }
        @imagedestroy($output);
        @imagedestroy($image);
        return $filename;
      }
      else
      {
        ob_start ();
        @imagejpeg($output);
        $image_data = ob_get_contents ();
        ob_end_clean ();
        @imagedestroy($output);
        @imagedestroy($image);
        return base64_encode($image_data);
      }
    }
    return '';
  }
}
?>
