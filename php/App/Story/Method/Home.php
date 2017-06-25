<?php
namespace Jarm\App\Story;
use Jarm\Core\Load;

class Home
{
  private $story;
  public function __construct($story)
  {
    $this->story = $story;
    return 'x';
  }
}
?>
