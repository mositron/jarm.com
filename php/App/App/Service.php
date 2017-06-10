<?php
namespace Jarm\App\App;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  private $conf;
  #private $iv = ''; #Same as in JAVA
  #private $key = ''; #Same as in JAVA

  public function __construct()
  {
    $this->conf=[
      'com.doodroid.lotto'=>[
        't'=>'ตรวจหวย+',
        'd'=>'ตรวจหวย สลากกินแบ่งรัฐบาล หวยหุ้น เลขเด็ด',
        'i'=>'https://lh4.ggpht.com/D4BJLOSWrwOolnFktTouF3vD9Bh_ASQLDic5qlH8RvpLXagoVYRck6cadThQquaOxsM=w200-rw',
              //	's'=>true
      ],
      'com.doodroid.friend'=>[
        't'=>'หาเพื่อน+ หญิง ชาย เกย์ เสเบี้ยน',
        'd'=>'หาเพื่อนคุย หาเพื่อนเฟสบุ๊ค หาเพื่อนเกย์ หาเพื่อนเลสเบี้ยน',
        'i'=>'https://lh6.ggpht.com/Zpg6BzzKx7rlz515kMRr-y2vnp2A0_KfhsRYSyMmJdwLA0wp28zn9prKqwYCISRXeP4=w200-rw',
            //		's'=>true
      ],
      'com.doodroid.radio'=>[
        't'=>'วิทยุออนไลน์+',
        'd'=>'ฟังเพลง ฟังวิทยุออนไลน์ ได้ทันทีโดยไม่ต้องติดตั้งอะไรเพิ่มเติม',
        'i'=>'https://lh4.ggpht.com/JR7azJbS76mIoWazWn-t9ERHk74fi_FXx6R4CvYiSx6GnM85QM1DeppoioKxt0bXOA=w200-rw',
            //		's'=>true
      ],
      'com.doodroid.lyric'=>[
        't'=>'เพลงใหม่',
        'd'=>'เพลง เพลงใหม่ เนื้อเพลงใหม่ มิวสิควิดีโอ MV MP3 ข่าววงการเพลง',
        'i'=>'https://lh3.ggpht.com/CFAWXzmTPkiXyocVOBa_5sFspRoEkipj6Ozl1B4K1I-km7F9BvKcbIb44hfqINU1Hw=w200-rw',
        's'=>true
      ],
      'com.doodroid.football'=>[
        't'=>'ผลบอล+',
        'd'=>'ผลบอล ข่าวฟุตบอล ผลบอลสด บอลวันนี้ ผลบอลเมื่อคืน บอลพรุ่งนี้',
        'i'=>'https://lh6.ggpht.com/rTguztJg6o1S208hsPbDGyXjgm_Syjo89qZqjbOCdHUGXA1gp7B9rs3QIett6J2h_XVh=w200-rw',
          //		's'=>true
      ],
      'com.doodroid.movie'=>[
        't'=>'หนังใหม่+',
        'd'=>'เช็คหนังใหม่ หนังที่กำลังเข้าฉาย รอบที่ฉาย และหนังโปรแกรมหน้า',
        'i'=>'https://lh3.ggpht.com/Ci9gcp3HPIv4G9GAe7wM9ab_gGx_YL26RhvozfstaQ-LzowUOr4PVT-30F6dwsfENuE=w200-rw'
      ],
      'com.doodroid.tv'=>[
        't'=>'ดูทีวีย้อนหลัง+',
        'd'=>'ทีวีย้อนหลัง ละครย้อนหลัง ข่าว มิวสิควิดีโอ หนังภาพยนต์ ซีรีย์',
        'i'=>'https://lh3.ggpht.com/RW3jeOVlzo-ByF6_iUpZeeRleGEY2GjCKAYBxCob14gfZdsB3S7lmxe36XxIxE9kCYY=w200-rw',
            //		's'=>true
      ],
      'com.doodroid.thdict'=>[
        't'=>'พจนานุกรม+ ฉบับราชบัณฑิตยสถาน',
        'd'=>'พจนานุกรม+ ฉบับราชบัณฑิตยสถาน ล่าสุดปี พ.ศ.2554 แบบออฟไลน์',
        'i'=>'https://lh4.ggpht.com/p6KfCn_aITuRFj74YPvLkDY6c1YdnF_kWgJnAIEp3JceZnHZB-1tiX81gudexMf8LVc=w200-rw'
      ],
      'com.doodroid.physiognomy'=>[
        't'=>'ดูโหงวเฮ้ง+',
        'd'=>'ดูโหงวเฮ้ง ทายลักษณะนิสัย จากรูปร่างหน้าตา ด้วยข้อมูลกว่า 200 ราการ',
        'i'=>'https://lh3.ggpht.com/ou5V1Br7yOBrEt230nf6vJDGpysdDIbOQ6Oe8fUlmRtF6g2DZB6rs4Kw3w-NrTlMHQ=w200-rw'
      ],
      'com.doodroid.trend'=>[
        't'=>'ข่าววันนี้',
        'd'=>'ข่าววันนี้ กระแสวันนี้ ติดตามข่าวและเหตุกาณ์ในโลกโซเชียล',
        'i'=>'https://lh3.googleusercontent.com/jqpPjintFWh_NP9r51wjqeROBDaelXIGb0slPCF4_dR9nlhZwz47RjOILkPRiH6KcA=w200-rw'
      ],
      'com.images.download'=>[
        't'=>'สติกเกอร์น่ารัก',
        'd'=>'รวมสติกเกอร์เฟสบุ๊คฟรี สามารถนำไปใช้บนแอพอื่นได้ทันที',
        'i'=>'https://lh3.ggpht.com/6xc-EojDYjZZ4dn_35-JzXqHbSz-0Q_S7tTOoj6bFJF5XXMG3RIXaoKEbj1bQy1jJg=w200-rw'
      ],
      'com.doodroid.tarot'=>[
        't'=>'ดูดวง ไพ่ยิปซี+',
        'd'=>'ดูดวงรายวัน ดูดวงรายเดือน ด้วยไพ่ยิปซี',
        'i'=>'https://lh4.ggpht.com/8_4JSVMMvm9SE7i_zlW48HKXPIqkpu7s5N0DoS7M6gYYGVTzYlpORAGIYLiuldREDj4=w200-rw'
      ],
      'com.doodroid.fortunesticks'=>[
        't'=>'ดูดวงเซียมซี',
        'd'=>'ดูดวงด้วยเซียมซี จากหลากหลายวัดชื่อดัง มีให้เลือกถึง 18สถานที่',
        'i'=>'https://lh3.googleusercontent.com/kvMPuvPvOiJsGb3pK42ga6cpANnQC-E5oLsfHf2CZ3vUkrj2bMY2_nSoJs2T8F1oDpk=w200-rw'
      ],
      'com.doodroid.cat'=>[
        't'=>'ทาสแมว',
        'd'=>'รวมรูปภาพแมวน่ารัก เซเลบแมว แมวชื่อดัง จากเพจต่างๆบน facebook',
        'i'=>'https://lh3.ggpht.com/TI8-70afEu4xh9Sw6Vvf1K3bh8uFMNwVmZ0a0FsSrCKOHOG0WaCJ7MexCzDOwcXvyEo=w200-rw',
      ],
      'com.doodroid.fbcomment'=>[
        't'=>'คอมเม้นท์ฮาๆ',
        'd'=>'รวมรูปภาพคอมเม้นท์ฮาๆ จากเฟสบุ๊ค สำหรับนำไปใช้งาน',
        'i'=>'https://lh3.ggpht.com/40fRn5s6PHIiWOH5O32917D034F9e21ZozrE03Tkwwu-f0oILS0V18g4SCj7uvDOkbRs=w200-rw',
      ],
      'com.doodroid.quote'=>[
        't'=>'คำคม+ อัพเดททุกวัน',
        'd'=>'รวมรูปภาพคำคม รูปภาพโดนใจ รูปภาพกินใจจากแฟนเพจชื่อดัง',
        'i'=>'http://static.doodroid.com/images/mobile/app-quip.png',
        'i'=>'https://lh3.ggpht.com/9l_493_OT__uiBNAOO4NlxHhgPg5J9xVwFl-yDxbohv8MAxrrV1UpsabHMj8Rklxb2I=w200-rw',
      ],
      'com.doodroid.herb'=>[
        't'=>'สมุนไพรไทย 200+ ชนิด',
        'd'=>'รวมข้อมูลสมุนไพรไทยกว่า 200+ ชนิด พร้อมรายละเอียดและสรรพคุณ',
        'i'=>'https://lh5.ggpht.com/27wxFIaglWScwkhvxiDf3G9S77Cs993w4GP43BxQtQUjBJEIhe3QhJuJQBKizMo0pus=w200-rw'
      ],
      'com.doodroid.thdict'=>[
        't'=>'พจนานุกรม+ ฉบับราชบัณฑิตยสถาน',
        'd'=>'พจนานุกรม+ ฉบับราชบัณฑิตยสถาน แบบออฟไลน์',
        'i'=>'https://lh4.ggpht.com/p6KfCn_aITuRFj74YPvLkDY6c1YdnF_kWgJnAIEp3JceZnHZB-1tiX81gudexMf8LVc=w200-rw'
      ],
      'com.doodroid.dream'=>[
        't'=>'ดูดวง ทำนายฝัน+',
        'd'=>'ดูดวงจากความฝัน หาเลขเด็ดจากฝัน ทำนายความฝัน',
        'i'=>'https://lh4.ggpht.com/bcDNslbj1-EN4cbUYOTtAf_J1SSSis8kJMwwGZHg9oexi1bvgMLzAW4ifKH38l6iBg=w200-rw'
      ],
      'com.doodroid.fbimage'=>[
        't'=>'รูปภาพคำคม+',
        'd'=>'รวมรูปภาพ คำคมโดนใจ ที่ผ่านการคัดแล้วจากเพจต่างๆ ให้คุณแชร์ต่อได้ทันที',
        'i'=>'https://lh5.ggpht.com/n8h3H1TUo_ZGyuy9AJiaIibhX5ZLIf8CGIqws06oT0LmvRu3PE6059zvulEyxosEqg=w200-rw'
      ],
      'com.doodroid.guess'=>[
        't'=>'เกมทายใจ+',
        'd'=>'เกมทายใจ โพสไปยังหน้า wall บน Facebook',
        'i'=>'https://lh3.ggpht.com/nHCc3QtEUwbaJhS_P4MEBCeBdMih5PIMnKURjGF3zSZhJvMIUR4aoLClONpUaN8DSLA=w200-rw'
      ],
      'com.doodroid.matching'=>[
        't'=>'เกมจับคู่+',
        'd'=>'เกมจับคู่(ภาพเหมือน) ออนไลน์ สะสมคะแนน เก็บเลเวล แชร์เฟสบุ๊ค เล่นง่ายๆ',
        'i'=>'https://lh4.ggpht.com/xK8wl_Vc6dyVUrmzXZzBBiBAv9iRjta5sMDxeVn2xHdyF4yUxpUjDSLaAZrer8juOyg=w300-rw'
      ],
      'com.doodroid.pixiefly'=>[
        't'=>'Pixie Fly - นางฟ้าแฟล็ปๆ',
        'd'=>'เกมนางฟ้าบิน แนว Flappy Bird ',
        'i'=>'https://lh3.ggpht.com/LjQz_9tyoWDYQFfX1FR3A9NK8lnsORTAv6V7KQkHzlrrFOCIMxxWQvRjaEEpV2VSncs=w200-rw',
      ],
      'com.doodroid.crazyzombies'=>[
        't'=>'Crazy Zombies',
        'd'=>'เกมยิงซอมบี้ เก็บคะแนน เล่นง่ายๆ ไม่ต้องต่อเน็ท',
        'i'=>'https://lh3.ggpht.com/bd3Pim973yFQd8sihlnIie7_M7MauP_KoASCb318es3J48XHdHBPFj8zYs78TCCN1Q=w200-rw',
      ],
      'com.doodroid.oil'=>[
        't'=>'ราคาน้ำมัน+',
        'd'=>'เช็คราคาน้ำมันล่าสุด แก๊สโซฮอล, เบนซิน, ดีเซล, LPG, NGV',
        'i'=>'https://lh4.ggpht.com/9Nh2yCTYhSR61aMMhhykZwi_JC3bsGgR8sSYr7njTUxwqlbxD4b7LxGhbn7MEqruyw=w200-rw'
      ],
      'com.doodroid.weather'=>[
        't'=>'พยากรณ์อากาศ+',
        'd'=>'ตรวจสภาพอาการครบทุกจังหวัดทั่วไป พร้อมพยากรณ์อากาศล่วงหน้า 10 วัน',
        'i'=>'https://lh6.ggpht.com/j1dpsSF7ZHxeqLyW3C8wwxdGz0mo08SgHOwGnLIJ8Yh7sfIf886dp8o32K9ORXqYj3nv=w200-rw'
      ],
      'com.doodroid.gold'=>[
        't'=>'ราคาทอง+',
        'd'=>'เช็คราคาทองคำ ทองรูปพรรณ ทองแท่ง ทั้งในประเทศและต่างประเทศ',
        'i'=>'https://lh6.ggpht.com/jhaojKdzPXbhXNB9fy8ETWu6xhCgTjRmepGqPouQamACe1cHVF2TVdzKYuURyo8egRBf=w200-rw'
      ],
    ];
  }

  public function get_home()
  {
    echo ':)';
    exit;
  }

  public function get_apps()
  {
    $apps=[];
    foreach($this->conf as $k=>$v)
    {
      $t=['id'=>$k,'title'=>$v['t'],'thumbnail'=>$v['i'],'content'=>$v['d']];
      if($v['s'])
      {
        $t['show']='1';
      }
      $apps[]=$t;
    }

    $data=[
      'status'=>'ok',
      'pages'=>1,
      'posts'=>$apps
    ];

    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
    exit;
  }

  /**
   * @param string $str
   * @param bool $isBinary whether to encrypt as binary or not. Default is: false
   * @return string Encrypted data
   */
  public function encrypt($str, $isBinary = false)
  {
    $iv = Load::$conf['app']['gcm']['iv'];
    $str = $isBinary ? $str : utf8_decode($str);
    $td = mcrypt_module_open('rijndael-128', ' ', 'cbc', $iv);
    mcrypt_generic_init($td, Load::$conf['app']['gcm']['key'], $iv);
    $encrypted = mcrypt_generic($td, $str);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    return $isBinary ? $encrypted : bin2hex($encrypted);
  }

  /**
   * @param string $code
   * @param bool $isBinary whether to decrypt as binary or not. Default is: false
   * @return string Decrypted data
   */
  public function decrypt($code, $isBinary = false)
  {
    $code = $isBinary ? $code : $this->hex2bin($code);
    $iv = Load::$conf['app']['gcm']['iv'];
    $td = mcrypt_module_open('rijndael-128', ' ', 'cbc', $iv);
    mcrypt_generic_init($td, Load::$conf['app']['gcm']['key'], $iv);
    $decrypted = mdecrypt_generic($td, $code);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    return $isBinary ? trim($decrypted) : utf8_encode(trim($decrypted));
  }

  protected function hex2bin($hexdata)
  {
    $bindata = '';
    for ($i = 0; $i < strlen($hexdata); $i += 2)
    {
      $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
    }
    return $bindata;
  }
}
?>
