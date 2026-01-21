<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
        
    public function mediaPath($data,$param = [],$status = TRUE){
        
        if($status && count($data) > 0){
            foreach($data as $d){
                foreach($param as $p){
                    $d[$p] = asset('images/'.$d[$p]);
                }
            }
            return $data;
        }else{
            
            if($data->{$param[0]}){
                $data->{$param[0]} = asset('images/'.$data->{$param[0]});
            }
            return $data;
        }
        return [];
    }
    
    public function removeHtml($data,$param = [],$status = TRUE){
        
        if($status && count($data) > 0){
            foreach($data as $d){
                foreach($param as $p){
                    $d[$p] = $this->remove_html_and_css($d[$p]);
                }
            }
            return $data;
        }else{
            $data[$param[0]] = $this->remove_html_and_css( $data[$param[0]],FALSE);
            return $data;
        }
        return [];
    }
    
    
    public function remove_html_and_css($input_string) {
        // Remove HTML tags
        $input_string = strip_tags($input_string);
    
        // Remove CSS styles (inside <style> tags)
        $input_string = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $input_string);
    
        // Remove inline CSS styles (style attributes)
        $input_string = preg_replace('/<[^>]+style\s*=\s*"[^"]*"/i', '', $input_string);
    
        return $input_string;
    }
    
    public function getUserDatilsByToken($token){
        $user = User::where('api_token',$token)->first();
        return $user;
        
    }



    
}
