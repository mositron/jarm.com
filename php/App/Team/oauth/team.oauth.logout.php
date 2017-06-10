<?php


# check session/login
team::session()->logout();

if($_GET['redirect_uri'])
{
  Load::move($_GET['redirect_uri']);
}
else
{
  Load::move(['team','/oauth']);
}
?>
