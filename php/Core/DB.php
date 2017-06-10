<?php
namespace Jarm\Core;
class DB
{
  public $mongo=[];
  public $col=[];
  public static $count=0;
  public static $qry=[];
  private $debug=false;
  private $concern;
  public function __construct($key="default")
  {
    //$this->concern=new \MongoDB\Driver\WriteConcern(\MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  }

  public function __call($func,$param)
  {
    return $this->_command($param[0],$func,array_slice($param,1));
  }

  public function _command(string $col,string $func,array $param=[])
  {
    try
    {
      $cursor=$this->mongo[$this->getServer($col)]
                   ->executeCommand(Load::$conf['db']['db'],
                      new \MongoDB\Driver\Command(array_merge([$func=>$col],$param))
      );
      return $cursor->toArray()[0]->values ?? NULL;
    }
    catch(\MongoDB\Driver\Exception\Exception $e)
    {
      die('_command - '.$func.' - '.$col.' : '.$e->getMessage());
    }
  }

  public function drop()
  {
    return false;
  }

  public function connect(string $host): void
  {
    try
    {
      $this->mongo[$host]=new \MongoDB\Driver\Manager('mongodb://'.Load::$conf['db']['user'].':'.Load::$conf['db']['pass'].'@'.Load::$conf['server']['db'][$host].'/'.Load::$conf['db']['db']);
    }
    catch(\MongoDB\Driver\Exception\ConnectionTimeoutException $e)
    {
      die('Error connecting timeout('.$e->getMessage().') - '.$host.' - '.$_SERVER['SERVER_ADDR']);
    }
    catch(\MongoDB\Driver\Exception\ConnectionException $e)
    {
      die('Error connecting to DB server('.$e->getMessage().') - '.$host.' - '.$_SERVER['SERVER_ADDR']);
    }
    catch(\MongoDB\Driver\Exception\Exception $e)
    {
      die('Error: ' . $e->getMessage());
    }
  }

  public function getServer(string $col): string
  {
    if(!isset($this->collection[$col]))
    {
      $host=Load::$conf['db']['collection'][$col];
      if(is_null($host) || !$host)
      {
        die('Not allow this collection - '.$col);
      }
      if(!isset($this->mongo[$host]))
      {
        $this->connect($host);
      }
      $this->collection[$col]=$host;
    }
    return $this->collection[$col];
  }

  public function find(string $col,array $qry=[],array $fld=[],array $opt=[],bool $fet=true): ?array
  {
    return count($rs=$this->mongo[$this->getServer($col)]
                            ->executeQuery(Load::$conf['db']['db'].'.'.$col,
                              new \MongoDB\Driver\Query($qry, array_merge($opt, ['projection'=>$fld])))
                            ->toArray()
    )?$this->obj2ar($rs):NULL;
  }

  public function findOne(string $col,array $qry=[],array $fld=[],array $opt=[],$fet=true): ?array
  {
    return $this->find($col,$qry,$fld,array_merge($opt,['limit'=>1]),$fet)[0]??NULL;
  }

  public function insert(string $col,array $data): ?int
  {
    $host=$this->getServer($col);
    if(!$data['_id'])
    {
      $rs=$this->mongo[$host]
               ->executeQuery(Load::$conf['db']['db'].'._seq',
                 new \MongoDB\Driver\Query(['_id'=>$col],['projection'=>['seq'=>1],'limit'=>1]))
               ->toArray();
      $data['_id']=(count($rs)?intval($this->obj2ar($rs)[0]['seq']):0)+1;
      $bulk=new \MongoDB\Driver\BulkWrite();
      $bulk->update(['_id'=>$col],['seq'=>$data['_id']],['multi'=>false,'upsert'=>true]);
      try
      {
        $this->mongo[$host]->executeBulkWrite(Load::$conf['db']['db'].'._seq',$bulk);
      }
      catch(\MongoDB\Driver\Exception\BulkWriteException $e)
      {
        $rs=$e->getWriteResult();
        if($er=$rs->getWriteConcernError()) // Check if the write concern could not be fulfilled
        {
          printf("insert/update-seq - %s(%d): %s\n",$er->getMessage(),$er->getCode(),var_export($er->getInfo(),true));
        }
        foreach($rs->getWriteErrors() as $er) // Check if any write operations did not complete at all
        {
          printf("insert/update-seq - Operation#%d: %s(%d)\n",$er->getIndex(),$er->getMessage(),$er->getCode());
        }
        exit;
      }
      catch(\MongoDB\Driver\Exception\Exception $e)
      {
        printf("insert/update-seq - Other error: %s\n",$e->getMessage());
        exit;
      }
    }
    else
    {
      if(is_numeric($data['_id']))
      {
        $data['_id']=intval($data['_id']);
      }
    }
    if(!isset($data['da']))
    {
      $data['da']=Load::Time()->now();
    }
    $bulk=new \MongoDB\Driver\BulkWrite();
    $_id=$bulk->insert($data);
    try
    {
      $this->mongo[$host]->executeBulkWrite(Load::$conf['db']['db'].'.'.$col, $bulk);
      return is_numeric($data['_id'])?$data['_id']:-1;
    }
    catch(\MongoDB\Driver\Exception\BulkWriteException $e)
    {
      $rs=$e->getWriteResult();
      if($er=$rs->getWriteConcernError()) // Check if the write concern could not be fulfilled
      {
        printf("insert - %s(%d): %s\n",$er->getMessage(),$er->getCode(),var_export($er->getInfo(),true));
      }
      foreach($rs->getWriteErrors() as $er) // Check if any write operations did not complete at all
      {
        printf("insert - Operation#%d: %s(%d)\n",$er->getIndex(),$er->getMessage(),$er->getCode());
      }
    }
    catch(\MongoDB\Driver\Exception\Exception $e)
    {
      printf("insert - Other error: %s\n",$e->getMessage());
      exit;
    }
    return NULL;
  }

  public function update(string $col,array $qry=[],array $new=[],array $opt=[]): ?int
  {
    $host=$this->getServer($col);
    $bulk=new \MongoDB\Driver\BulkWrite(['ordered'=>true]);
    $bulk->update($qry,$new,array_merge(['multi'=>true,'upsert'=>false],$opt));
    try
    {
      if(isset($new['$set'])||isset($new['$push'])||isset($new['$unset'])||isset($new['$pull'])||isset($new['$inc']))
      {
        return $this->mongo[$host]
                    ->executeBulkWrite(Load::$conf['db']['db'].'.'.$col, $bulk)
                    ->getModifiedCount();
      }
      else
      {
        die('update - not set $ operation');
      }
    }
    catch(\MongoDB\Driver\Exception\BulkWriteException $e)
    {
      $rs=$e->getWriteResult();
      if($er=$rs->getWriteConcernError()) // Check if the write concern could not be fulfilled
      {
        printf("update - %s(%d): %s\n",$er->getMessage(),$er->getCode(),var_export($er->getInfo(),true));
      }
      foreach($rs->getWriteErrors() as $er) // Check if any write operations did not complete at all
      {
        printf("update - Operation#%d: %s(%d)\n",$er->getIndex(),$er->getMessage(),$er->getCode());
      }
    }
    catch(\MongoDB\Driver\Exception\Exception $e)
    {
      printf("update - Other error: %s\n",$e->getMessage());
    }
    exit;
  }

  public function remove(string $col,array $qry=[],array $opt=[]): ?int
  {
    $host=$this->getServer($col);
    $bulk=new \MongoDB\Driver\BulkWrite(['ordered'=>true]);
    $bulk->delete($qry,array_merge(['limit'=>false],$opt));
    try
    {
      if(count($qry)>0)
      {
        return $this->mongo[$host]
                    ->executeBulkWrite(Load::$conf['db']['db'].'.'.$col,$bulk)
                    ->getDeletedCount();
      }
      else
      {
        die('remove - not set $ operation');
      }
    }
    catch(\MongoDB\Driver\Exception\BulkWriteException $e)
    {
      $rs=$e->getWriteResult();
      if($er=$rs->getWriteConcernError()) // Check if the write concern could not be fulfilled
      {
        printf("remove - %s(%d): %s\n",$er->getMessage(),$er->getCode(),var_export($er->getInfo(),true));
      }
      foreach($rs->getWriteErrors() as $er) // Check if any write operations did not complete at all
      {
        printf("remove - Operation#%d: %s(%d)\n",$er->getIndex(),$er->getMessage(),$er->getCode());
      }
    }
    catch(\MongoDB\Driver\Exception\Exception $e)
    {
      printf("remove - Other error: %s\n",$e->getMessage());
    }
    exit;
  }

  public function delete(string $col,string $key,array $qry=[]): ?int
  {
    return $this->remove($col,$qry,$opt);
  }

  public function distinct(string $col,string $key,array $qry=[]): ?array
  {
    return $this->_command($col,'distinct',['key'=>$key,'query'=>$qry]);
  }

  public function aggregate(string $col,array $pipeline=[])
  {
    try
    {
      $cursor=$this->mongo[$this->getServer($col)]
                   ->executeCommand(Load::$conf['db']['db'],
                      new \MongoDB\Driver\Command([
                        'aggregate'=>$col,
                         'pipeline'=>$pipeline
                      ])
              );
      return $this->obj2ar($cursor->toArray()[0]->result) ?? NULL;
    }
    catch(\MongoDB\Driver\Exception\Exception $e)
    {
      die('group - '.$col.' : '.$e->getMessage());
    }
    //return $this->_command($col,'group',['key'=>$key, 'cond'=>$condition, 'reduce'=>$reduce, 'initial'=>$initial]);
    /*
    $rs=$this->_command($col, 'group', [$key, $initial, $reduce, $condition]);
    return $return?$rs['retval'][0][$return]:$rs['retval'];
    */
  }

  public function count(string $col,array $qry=[],array $opt=[]): ?int
  {
    try
    {
      $cursor=$this->mongo[$this->getServer($col)]
                   ->executeCommand(Load::$conf['db']['db'],
                      new \MongoDB\Driver\Command([
                        'count'=>$col,
                        'query'=>$qry
                    ])
              );
      return $cursor->toArray()[0]->n ?? NULL;
    }
    catch(\MongoDB\Driver\Exception\Exception $e)
    {
      die('count - '.$col.' : '.$e->getMessage());
    }
  }

  public function mapreduce($col, $map , $reduce, $qry)
  {
    /*
    $host=Load::$conf['db']['collection'][$col];
    $this->getServer($col,1);
    $rs=$this->db[$host]->command(['mapreduce'=>$col,'map'=>new \MongoDB\BSON\Javascript($map),'reduce'=>new \MongoDB\BSON\Javascript($reduce),'query'=>$qry,'out'=>$col.'_out']);
    return $this->db[$host]->selectCollection($rs['result']);
    */
  }

  public function lastError($host)
  {
    return $this->db[$host]->lastError();
  }

  public function obj2ar($d)
  {
    if(is_object($d))
    {
      $d=get_object_vars($d);
    }
    if(is_array($d))
    {
      return array_map([$this,__FUNCTION__], $d);
    }
    else
    {
      return $d;
    }
  }
}
