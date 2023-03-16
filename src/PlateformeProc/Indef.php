<?php

namespace Pv\PlateformeProc ;

#[\AllowDynamicProperties]
class Indef extends PlateformeProc
{
	public function EstDisponible()
	{
		return 0 ;
	}
	public function RecupArgs()
	{
		return array() ;
	}
	public function LanceProcessusProg(& $prog)
	{
	}
}