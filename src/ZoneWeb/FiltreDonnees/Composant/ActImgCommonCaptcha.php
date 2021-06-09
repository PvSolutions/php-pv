<?php

namespace Pv\ZoneWeb\FiltreDonnees\Composant ;

class ActImgCommonCaptcha extends \Pv\ZoneWeb\Action\EnvoiFichier
{
	protected $Support ;
	protected function InitSupport()
	{
		$this->Support = \Pv\Common\GD\Captcha::Create($this->ComposantIUParent->LargeurImg, $this->ComposantIUParent->HauteurImg) ;
		$this->Support->Name = $this->ComposantIUParent->NomImg ;
		$this->Support->CaseInsensitive = $this->ComposantIUParent->CasseInsensibleImg ;
	}
	protected function AfficheContenu()
	{
		$this->InitSupport() ;
		$this->Support->Open() ;
		$this->Support->Draw() ;
		$this->Support->Show() ;
		$this->Support->Close() ;
	}
	public function VerifieValeurSoumise($texte)
	{
		$this->InitSupport() ;
		return $this->Support->ConfirmSubmittedText($texte) ;
	}
}