<?php
namespace Jarm\Core;

class Xml
{
  public function process(string $xml): array
  {
    $xml=simplexml_load_string($xml);
    $xmlarray=$this->objectsInto($xml);
    return $xmlarray;
  }
  public function objectsInto($arrObjData,array $arrSkipIndices=[]): array
  {
    $arrData=[];
    if(is_object($arrObjData))
    {
      $arrObjData=get_object_vars($arrObjData);
    }
    if(is_array($arrObjData))
    {
      foreach($arrObjData as $index=>$value)
      {
        if(is_object($value)||is_array($value))
        {
          $value=$this->objectsInto($value,$arrSkipIndices); // recursive call
        }
        if(in_array($index,$arrSkipIndices))
        {
          continue;
        }
        $arrData[$index]=$value;
      }
    }
    return $arrData;
  }
/*
    public $parser;   #a reference to the XML parser
    public $document; #the entire XML structure built up so far
    public $parent;   #a pointer to the current parent - the parent will be an array
    public $stack;    #a stack of the most recent parent at each nesting level
    public $last_opened_tag; #keeps track of the last tag opened.

    public function __construct()
   {
        $this->parser = xml_parser_create('utf-8');
        xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, false);
        xml_set_object($this->parser, $this);
        xml_set_element_handler($this->parser, 'open','close');
        xml_set_character_data_handler($this->parser, 'data');
    }
    public function destruct()
   {
     xml_parser_free($this->parser);
  }
   public function & parse(&$data)
  {
        $this->document = [];
        $this->stack    = [];
        $this->parent   = $this->document;
        return xml_parse($this->parser, $data, true) ? $this->document : NULL;
    }
    public function open(&$parser, $tag, $attributes)
   {
        $this->data = ''; #stores temporary cdata
        $this->last_opened_tag = $tag;
        if(is_array($this->parent) and array_key_exists($tag,$this->parent))
      { #if you've seen this tag before
            if(is_array($this->parent[$tag]) and array_key_exists(0,$this->parent[$tag]))
        { #if the keys are numeric
                #this is the third or later instance of $tag we've come across
                $key = count_numeric_items($this->parent[$tag]);
            }
        else
        {
                #this is the second instance of $tag that we've seen. shift around
                if(array_key_exists("$tag attr",$this->parent))
           {
                    $arr = ['0 attr'=>$this->parent["$tag attr"], $this->parent[$tag]];
                    unset($this->parent["$tag attr"]);
                }
           else
           {
                    $arr = [$this->parent[$tag]];
                }
                $this->parent[$tag] = &$arr;
                $key = 1;
            }
            $this->parent = $this->parent[$tag];
        }
      else
      {
            $key = $tag;
        }
        if($attributes) $this->parent["$key attr"] = $attributes;
        $this->parent  = $this->parent[$key];
        $this->stack[] = $this->parent;
    }
    public function data(&$parser, $data)
   {
        if($this->last_opened_tag != NULL) #you don't need to store whitespace in between tags
            $this->data .= $data;
    }
    public function close(&$parser, $tag)
   {
        if($this->last_opened_tag == $tag)
      {
            $this->parent = $this->data;
            $this->last_opened_tag = NULL;
        }
        array_pop($this->stack);
        if($this->stack) $this->parent = $this->stack[count($this->stack)-1];
    }
   */
}
function count_numeric_items(&$array): int
{
    return is_array($array) ? count(array_filter(array_keys($array), 'is_numeric')) : 0;
}
?>
