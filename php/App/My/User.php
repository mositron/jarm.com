<?php
namespace Jarm\App\My;
use Jarm\Core\Load;

class User extends Service
{
  public $profile=[];
  public function _user()
  {
    $user=Load::User();
    $prof=false;
    if(Load::$path[1]=='me')
    {
      return ['move'=>Load::$my?'/user/'.Load::$my['_id']:['oauth','/login/?redirect_uri='.urlencode(URH.'/user/me')]];
    }
    elseif(is_numeric(Load::$path[1]))
    {
      if($this->profile=$user->get(Load::$path[1]))
      {
        Load::Ajax()->register(['addpoint','setban','resetavatar','setblock','hackbywut','setverify','sethideall']);
        $this->user_upload($this->profile);
        $this->user_profile($this->profile);
        Load::cache();
      }
      else
      {
        return ['move'=>'/'];
      }
    }
    else
    {
      return ['move'=>'/'];
    }
  }
}
?>
