<?php
function func_randnick()
{
	$amount=rand(2,10);
	$name=[];
	$chars = ['a','b','c','d','e','f','g','h','i','j','l','k','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
	$vowel = ['a', 'e', 'i', 'o', 'u', 'y'];
	$conso = ['b','c','d','f','g','h','j','l','k','m','n','p','q','r','s','t','v','w','x','z'];
	for ($i=0;$i<$amount;$i++)
	{
		$rndn = rand(4,12);
		for ($x=0;$x<$rndn;$x++)
		{
			$rndn2 = rand(0,19);
			if ($x == 0)
			{
				$name[] = $chars[$rndn2];
			}
			elseif ($i%2 == 0)
			{
				if ($x == 1 || $x == 3 || $x == 5 || $x == 7 || $x == 9 || $x == 11 || $x == 13 )
				{
					$rndnW = rand(0,5);
					$name[] = $vowel[$rndnW];
				}
				else
				{
					$name[] = $chars[$rndn2];
				}
			}
			elseif ($x == 2 || $x == 5 || $x == 8 || $x == 11 || $x == 14 )
			{
				if ($i%2 == 0)
				{
					$name[] = $chars[$rndn2];
				}
				else
				{
					$rndnW = rand(0,5);
					$name[] = $vowel[$rndnW];
				}
			}
			else
			{
				$name[] = $chars[$rndn2];
			}
		}
	}
	return ucfirst(substr(implode('',$name),0,$amount));
}
?>