<?php

namespace Pv\ZoneWeb\FiltreDonnees\CorrecteurValeur ;

#[\AllowDynamicProperties]
class Utf8 extends \Pv\ZoneWeb\FiltreDonnees\CorrecteurValeur\Correcteur
{
	public function Applique($valeur, & $filtre)
	{
		return utf8_encode($valeur) ;
	}
	public function iso8859_1_to_utf8(string $s): string {
		$s .= $s;
		$len = \strlen($s);

		for ($i = $len >> 1, $j = 0; $i < $len; ++$i, ++$j) {
			switch (true) {
				case $s[$i] < "\x80": $s[$j] = $s[$i]; break;
				case $s[$i] < "\xC0": $s[$j] = "\xC2"; $s[++$j] = $s[$i]; break;
				default: $s[$j] = "\xC3"; $s[++$j] = \chr(\ord($s[$i]) - 64); break;
			}
		}

		return substr($s, 0, $j);
}
}