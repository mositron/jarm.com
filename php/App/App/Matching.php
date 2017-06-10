<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Matching extends Service
{
  public $game_config=[
    1=>['cell'=>4,'time'=>90,'score'=>50,'fail'=>5,'min'=>1,'max'=>4,'icon'=>'sticker1'],
    2=>['cell'=>4,'time'=>90,'score'=>50,'fail'=>5,'min'=>1,'max'=>4,'icon'=>'sticker2'],
    3=>['cell'=>4,'time'=>90,'score'=>50,'fail'=>6,'min'=>2,'max'=>6,'icon'=>'sticker1'],
    4=>['cell'=>4,'time'=>90,'score'=>50,'fail'=>6,'min'=>2,'max'=>6,'icon'=>'sticker2'],
    5=>['cell'=>4,'time'=>80,'score'=>50,'fail'=>7,'min'=>3,'max'=>8,'icon'=>'sticker1'],
    6=>['cell'=>4,'time'=>80,'score'=>50,'fail'=>7,'min'=>3,'max'=>8,'icon'=>'sticker2'],
    7=>['cell'=>4,'time'=>80,'score'=>50,'fail'=>8,'min'=>2,'max'=>8,'icon'=>'sticker1'],
    8=>['cell'=>4,'time'=>70,'score'=>50,'fail'=>8,'min'=>2,'max'=>8,'icon'=>'sticker2'],
    9=>['cell'=>4,'time'=>70,'score'=>50,'fail'=>9,'min'=>1,'max'=>8,'icon'=>'sticker1'],
    10=>['cell'=>4,'time'=>70,'score'=>50,'fail'=>9,'min'=>1,'max'=>8,'icon'=>'sticker2'],

    11=>['cell'=>5,'time'=>120,'score'=>50,'fail'=>10,'min'=>1,'max'=>9,'icon'=>'sticker3'],
    12=>['cell'=>5,'time'=>120,'score'=>50,'fail'=>10,'min'=>2,'max'=>11,'icon'=>'sticker3'],
    13=>['cell'=>5,'time'=>120,'score'=>50,'fail'=>10,'min'=>1,'max'=>11,'icon'=>'sticker3'],
    14=>['cell'=>5,'time'=>120,'score'=>50,'fail'=>10,'min'=>1,'max'=>12,'icon'=>'sticker3'],

    15=>['cell'=>5,'time'=>120,'score'=>50,'fail'=>12,'min'=>1,'max'=>9,'icon'=>'sticker4'],
    16=>['cell'=>5,'time'=>120,'score'=>50,'fail'=>12,'min'=>4,'max'=>12,'icon'=>'sticker4'],
    17=>['cell'=>5,'time'=>120,'score'=>50,'fail'=>12,'min'=>1,'max'=>12,'icon'=>'sticker4'],

    18=>['cell'=>5,'time'=>120,'score'=>50,'fail'=>14,'min'=>1,'max'=>10,'icon'=>'sticker5'],
    19=>['cell'=>5,'time'=>120,'score'=>50,'fail'=>14,'min'=>3,'max'=>12,'icon'=>'sticker5'],
    20=>['cell'=>5,'time'=>120,'score'=>50,'fail'=>14,'min'=>1,'max'=>12,'icon'=>'sticker5'],


    21=>['cell'=>6,'time'=>210,'score'=>50,'fail'=>14,'min'=>1,'max'=>12,'icon'=>'sticker6'],
    22=>['cell'=>6,'time'=>195,'score'=>50,'fail'=>14,'min'=>3,'max'=>15,'icon'=>'sticker6'],
    23=>['cell'=>6,'time'=>180,'score'=>50,'fail'=>14,'min'=>5,'max'=>18,'icon'=>'sticker6'],
    24=>['cell'=>6,'time'=>165,'score'=>50,'fail'=>13,'min'=>3,'max'=>18,'icon'=>'sticker6'],
    25=>['cell'=>6,'time'=>150,'score'=>50,'fail'=>12,'min'=>1,'max'=>18,'icon'=>'sticker6'],

    26=>['cell'=>6,'time'=>180,'score'=>50,'fail'=>14,'min'=>1,'max'=>14,'icon'=>'sticker7'],
    27=>['cell'=>6,'time'=>180,'score'=>50,'fail'=>14,'min'=>2,'max'=>16,'icon'=>'sticker7'],
    28=>['cell'=>6,'time'=>180,'score'=>50,'fail'=>14,'min'=>3,'max'=>18,'icon'=>'sticker7'],
    29=>['cell'=>6,'time'=>180,'score'=>50,'fail'=>14,'min'=>2,'max'=>18,'icon'=>'sticker7'],
    30=>['cell'=>6,'time'=>180,'score'=>50,'fail'=>14,'min'=>1,'max'=>18,'icon'=>'sticker7'],
  ];

  public function get_matching()
  {
    Load::$conf['social']['facebook']['appid']='1503674803191830';
    define('APP_VERSION','1.0');
    $serv=[
      ''=>'json_home',
      'apps'=>'get_apps',
      'help'=>'json_help',
      'top'=>'json_top',
      'game'=>'json_game',
      'score'=>'json_score',
    ];

    $cate=[];

    $this->{$serv[Load::$path[0]]}();
    echo Load::$core->assign('cate',$cate)->fetch('app/matching');
    exit;
  }

  public function json_game()
  {
    $db=Load::DB();
    if(!Load::$path[1] || !$user=$db->findone('matching_user',['_id'=>intval(Load::$path[1])]))
    {
      Load::move('/matching');
    }

    define('USER_ID',$user['_id']);
    define('USER_FB',$user['fb']);
    define('USER_LV',$user['lv']);

    Load::Ajax()->register(['setpass']);

    $lv=intval(Load::$path[2]);

    if(!$lv || $lv>USER_LV)
    {
      $lv=USER_LV;
    }

    $game=['error'=>'เลเวลนี้ยังไม่เปิด.'];
    $games=$this->$game_config;
    if(isset($games[$lv]))
    {
      $game=$games[$lv];
    }

    Load::$core->data['content']=Load::$core
      ->assign('lv',$lv)
      ->assign('game',$game)
      ->assign('maxlv',count($games)+1)
      ->assign('user',$user)
      ->fetch('app/matching.game');
  }

  public function json_home()
  {
    Load::Ajax()->register(['getmenu']);
    Load::$core->data['content']=Load::$core->fetch('app/matching.home');
  }

  public function json_score()
  {
    $db=Load::DB();
    if(!Load::$path[1] || !$user=$db->findone('matching_user',['_id'=>intval(Load::$path[1])]))
    {
      Load::move('/matching');
    }

    define('USER_ID',$user['_id']);
    define('USER_FB',$user['fb']);
    define('USER_LV',$user['lv']);

    $games=$this->$game_config;

    Load::$core->data['content']=Load::$core->assign('parent','/matching')
                    ->assign('games',$games)
                    ->assign('maxlv',count($games)+1)
                    ->assign('user',$user)
                    ->fetch('app/matching.score');

  }

  public function json_top()
  {
    Load::$core->data['content']=Load::$core
      ->assign('user',Load::DB()->find('matching_user',['dd'=>['$exists'=>false]],['_id'=>1,'name'=>1,'fb'=>1,'score'=>1,'lv'=>1],['sort'=>['score'=>-1,'lv'=>-1,'_id'=>1],'limit'=>100]))
      ->assign('parent','/matching')
      ->fetch('app/matching.top');
  }

  public function getmenu($arg)
  {
    $db=Load::DB();
    $ajax=Load::Ajax();
    if($user=$db->findone('matching_user',['fb'=>$arg['id']]))
    {

    }
    else
    {
      $user=['fb'=>$arg['id'],'name'=>$arg['name'],'email'=>$arg['email'],'lv'=>1,'score'=>0,'bonus'=>['open'=>5,'answer'=>5]];
      $id=$db->insert('matching_user',$user);
      $user['_id']=$id;
    }

    $ajax->script('showmenu('.json_encode($user).')');
  }

  public function setpass($arg)
  {
    global $user;
    $db=Load::DB();
    $ajax=Load::Ajax();

    $lv=['error'=>'เลเวลนี้ยังไม่เปิด.'];
    $game=$this->$game_config;
    if(isset($game[$arg['lv']]))
    {
      $g=$game[$arg['lv']];
      $cell=$g['cell'];
      $sc=intval(($cell*$cell)/2)*$g['score'];
      //$score=$g['score'];

      $max=intval($arg['score']);
      $fail=intval($arg['fail']);
      $score=$max-$fail;
      if($sc==$max && $fail<$max && USER_ID==$arg['id'] && USER_FB==$arg['fb'])
      {
        $nlv=($arg['lv']+1);

        $set=[];
        $wall=false;
        if(USER_LV==$arg['lv'])
        {
          $wall=true;
          $set['lv']=$nlv;
        }
        $clv=$user['pass']['lv'.$arg['lv']];
        if(!$clv || $clv['s']<$score)
        {
          $set['pass.lv'.$arg['lv']]=['m'=>$max,'f'=>$fail,'s'=>$score];

          if(!is_array($user['pass']))
          {
            $user['pass']=[];
          }
          $user['pass']['lv'.$arg['lv']]=['m'=>$max,'f'=>$fail,'s'=>$score];

          $now=0;
          for($i=1;$i<=USER_LV;$i++)
          {
            $now+=intval($user['pass']['lv'.$i]['s']);
          }
          $set['score']=$now;
        }
        if($wall)
        {

        }
        //'lv'=>$nlv,'pass.lv'.$arg['lv']=>[])
        if(count($set)>0)
        {
          //$ajax->alert(print_r(['_id'=>USER_ID],true).' - '.print_r($set,true));
          $db->update('matching_user',['_id'=>USER_ID],['$set'=>$set]);
        }
        $fb=[
          'message'=>'อัพเลเวล '.$nlv.'. ใน เกมจับคู่+',
          'name'=>'เลเวล '.$nlv.'!.',
          'caption'=>'อัพเลเวล '.$nlv.'. ใน เกมจับคู่+ สำหรับ Android',
          'link'=>'https://play.google.com/store/apps/details?id=com.doodroid.matching',
          'picture'=>'https://lh6.ggpht.com/3qgcgzMX5TmSq6kWthzd9IwhA7O62k5jfHY0swhyjwqCqSJ3FUbsoFqjmuu1APFAyQ',
          'description'=>'เกมจับคู่+ by jarm.com - เกมทดสอบควมจำ เก็บเลเวล สะสมแต้ม เล่นง่ายๆ บนมือถือ/แท็บเล็ต Android',
          'actions'=>[['name'=>'เกมจับคู่+ for Android','link'=>'https://play.google.com/store/apps/details?id=com.doodroid.matching']]
        ];
        if($wall)
        {
          $ajax->script('m.result('.json_encode($fb).')');
        }
        if(isset($game[$nlv]))
        {
          $ajax->script('m.nextlevel(true,'.json_encode(['lv'=>$nlv,'wall'=>$wall]).');');
        }
        else
        {
          $ajax->script('m.nextlevel(false,'.json_encode(['lv'=>$nlv,'wall'=>$wall]).');');
        }
      }
      else
      {
        $ajax->script('m.playagain(true);');
      }
    }
    else
    {
      $ajax->script('m.playagain(false);');
    }
  }
}
?>
