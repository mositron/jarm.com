<?php
namespace Jarm\App\Story\Method;
use Jarm\Core\Load;

class Home
{
  private $story;
  public function __construct($story)
  {
    $this->story = $story;
  }

  public function get()
  {
    return 'x';
  }
}
?>
