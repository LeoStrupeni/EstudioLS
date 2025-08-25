<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getloginrol()
    {
        if (Session::get('user') != null) {
            return true;
        } else {
            return false;
        }
    }

    public function listsaldos()
    {
        $val = $this->getloginrol();
        if ($val == false){
            return redirect()->route('logout');     
        }
        $fechaRango='';
        return view("settings.balances", compact("fechaRango"));

    }

    public function translateText($text)
    {
        $tr = new GoogleTranslate(); 
        $tr->setSource('en'); 
        $tr->setSource();
        $tr->setTarget('es');

        return $tr->translate(strtolower(str_replace("_", " ", $text)));
    }
}
