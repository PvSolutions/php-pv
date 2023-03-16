<?php

namespace Pv\Objet ;

#[\AllowDynamicProperties]
class Exception
{
	public $Code = "" ;
	public $Message = "" ;
	public $Parametres = array() ;
	public $NumeroLigne = "" ;
	public $CheminFichier = "" ;
	public $ExceptionInterne = null ;
}