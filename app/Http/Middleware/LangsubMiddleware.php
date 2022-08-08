<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use IlluminateSupportFacadesApp;
class LangsubMiddleware
{
    public function handle($request, Closure $next)
    {
       
        $data_posted=$request->all();
        if(!$request->session()->has('lang'))
         session(['lang' =>'AR']);

        if(isset($data_posted['lang'])){
           $request->session()->put('lang',$data_posted['lang']); 
          //  echo $lang;
        }
        if($request->session()->has('lang')){
            $request->session()->get('lang');
            
        }
        $url_array = explode('.', parse_url($request->url(), PHP_URL_HOST));
        $subdomain = $url_array[0];

        $languages =['pharma', 'egifix','demo','admin'];
         
        if (in_array($subdomain,$languages)) {
            \App::setLocale($subdomain.'_'.$request->session()->get('lang'));
        }

        return $next($request);
    }
}