<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\User;
use App\Media;
use App\Pmsg;
use App\Business;
use Illuminate\Http\Request;

class Test extends Controller
{
  

    public function msg($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();

        $msg = Pmsg::where('user_id', '=', $user->id)->first();
        print_r($msg->msg);
    }

    public function photos($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();

        $photo = Media::where('user_id', '=', $user->id)->where('gallery', '=', 1)->get();
        
         print_r(json_encode($photo));
    }

 

    public function business($slug)
    {

        $user = User::whereSlug($slug)->firstOrFail();

        $business = Business::where('user_id', '=', $user->id)->where('intro', '=', null)->get();

        print_r(json_encode($business));
    }


function createDomain(Request $req) {


$cpanelUsername = 'grampanc';
$cpanelPassword = 'GBFG-#JoTdJo?9TH@;';
$cpanelDomain = 'grampanchayat.org';  // Replace with your domain

// Subdomain details
$subdomainName = 'shardul';    // Replace with your desired subdomain
$subdomainDir = 'public_html/shardul'; // Replace with desired directory

// cPanel API URL
$apiUrl = "https://grampanchayat.org:2083/execute/SubDomain/addsubdomain?domain={$subdomainName}&rootdomain={$cpanelDomain}&subdomain={$subdomainName}&dir={$subdomainDir}";

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "{$cpanelUsername}:{$cpanelPassword}");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // This might be necessary if you encounter SSL errors

// Execute the API request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    echo 'Subdomain created successfully';
}

// Close cURL session
curl_close($ch);


    
}

function deleteDomain(Request $req) {


$cpanelUsername = 'grampanc';
$cpanelPassword = 'GBFG-#JoTdJo?9TH@;';
$cpanelDomain = 'grampanchayat.org';  // Replace with your domain

// Subdomain details
$subdomainName = 'shardul';    // Replace with the subdomain you want to delete

$directory = "/public_html/$subdomainName";

// cPanel API URL
// $apiUrl = "https://grampanchayat.org:2083/execute/SubDomain/delsubdomain?domain={$subdomainName}&rootdomain={$cpanelDomain}&subdomain={$subdomainName}";
$apiUrl =  "https://$cpanelDomain:2083/json-api/cpanel?cpanel_jsonapi_func=delsubdomain&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_version=2&domain=".$subdomainName.'.'.$cpanelDomain."&dir=$directory";  //Note: To delete the subdomain of an addon domain, separate the subdomain with an underscore (_) instead of a dot (.). For example, use the following format: subdomain_addondomain.tld

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "{$cpanelUsername}:{$cpanelPassword}");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // This might be necessary if you encounter SSL errors

// Execute the API request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    echo 'Subdomain deleted successfully';
}

// Close cURL session
curl_close($ch);

    
}



}
