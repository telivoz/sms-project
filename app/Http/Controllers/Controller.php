<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use app\Models;
use App\Models\Customer;
#use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

use Khill\Lavacharts\Lavacharts;
$lava = new Lavacharts; // See note below for Laravel
class Controller extends BaseController
{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index() {
        return view('home');
    }
    public function customer() {        
        $customer = new \App\Models\User();
        return view('customer',['customers' => $customer->all()]);
    }    
    public function storeCustomer(Request $request){
        $customer = new  \App\Models\User();
        $customer->uid = $request->uid;
        $customer->name = $request->name;
        $customer->email = $request->email;
        shell_exec("");
        $customer->password = Hash::make($request->password); 
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->company = $request->company;
        $customer->profile = $request->profile;
        $customer->rate = "0.0000";
        $customer->currency = "$";
        $customer->balance = "0.0000";
        $customer->save();
        return redirect('/customer');
    }
    public function storeProvider(Request $request){
        $provider = new  \App\Models\Provider();       
        $provider->name = $request->name;
        $provider->email = $request->email;
        $provider->password = $request->password;
        $provider->address = $request->address;
        $provider->phone = $request->phone;  
        $provider->company = $request->company;
        $provider->rate = "0.0000";    
        $provider->balance = "0.0000";
        $provider->save();
        return redirect('/provider');
    }
    public function addCustomer() {        
        return view('addCustomer');
    }
    public function addProvider() {        
        return view('addProvider');
    }
    public function editProvider() {        
        return view('editProvider');
    }
    public function editCustomer($id) { 
        $customer = new  \App\Models\User();
        $customer::findOrfail($id);
        return view('editCustomer', ['customers' => $customer->all()]);
    }
    public function updateCustomer(Request $request) { 
        $customer = new  \App\Models\User();
        $customer::where('id',$request->id)->update([
        'uid' => $request->uid,
        'name' => $request->name, 
        'email' => $request->email, 
        'address' => $request->address,
        'phone' => $request->phone,
        'company' => $request->company,
        'profile' => $request->profile]);        
        return redirect('/customer');
    }
    public function destroyCustomer($id) {       
        $customer = new  \App\Models\User();
        $customer::findOrfail($id)->delete();
        return redirect('/customer');
    }
    public function destroyProvider($id) {       
        $provider = new  \App\Models\Provider();
        $provider::findOrfail($id)->delete();
        return redirect('/customer');
    }
    public function provider() {
        $provider = new \App\Models\Provider();
        return view('provider',['providers' => $provider->all()]);
    }
    public function reports() {
        $reports = new \App\Models\Submit_log();
        return view('reports',['reports' => $reports->paginate(15)]);
    }
    public function sms() {
        return view('sms');
    }
    
    public function MtConnector() {
        $connectors = shell_exec("python3 /opt/jasmin/cli/mt-connectors.py | awk '{print $1}' | sed 's/#//g'");
        $connectors = explode("\n", $connectors);
        return view('connector', 
         ['connectores' => $connectors]);
    }
    public function addConnector() {        
        return view('addConnector');
    }
    public function storeConnector(Request $request) {  
        $cid = $request->cid;      
        $host = $request->host;
        $port = $request->port;
        $username = $request->username;
        $password = $request->password;
        shell_exec("python3 /opt/jasmin/cli/createMtConnector.py '$cid' '$host' '$port' '$username' '$password'");
        shell_exec("python3 /opt/jasmin/cli/persistent.py");
        return redirect('/connector');
    }
    public function destroyConnector($id) {     
        shell_exec("python3 /opt/jasmin/cli/removeMtconnector.py '$id'");
        shell_exec("python3 /opt/jasmin/cli/persistent.py");

        return redirect('/connector');
    }
    public function Mtrouter() {        
        $routers = shell_exec("python3 /opt/jasmin/cli/mt-router.py | awk '{print $1}' | sed 's/#//g'");
        $routers = explode("\n", $routers);
        return view('mt-router', 
         ['routers' => $routers]);   
    }
    public function addMtrouter() {        
        return view('addMtrouter');
    }
    public function destroyMtrouter($id) {     
        shell_exec("python3 /opt/jasmin/cli/deleteMtrouter.py '$id'");
        shell_exec("python3 /opt/jasmin/cli/persistent.py");
        return redirect('/mt-router');
    }
    public function storeMtrouter(Request $request) {
        $type = $request->type;
        $order = $request->order;
        $connector = $request->connector;
        if ($request->filter != "") {
            $filter = $request->filter;
            shell_exec("python3 /opt/jasmin/cli/createMtRouterFilter.py '$type' '$connector' '$order' '$filter'");
        } else {
            shell_exec("python3 /opt/jasmin/cli/createMtRouter.py '$type' '$connector' '$order'");
        }
        shell_exec("python3 /opt/jasmin/cli/persistent.py");
        return redirect('/mt-router');
    }
    public function filter(){
        return view('filter');
    }
    public function destroyFilter($id) {
        shell_exec("python3 /opt/jasmin/cli/deleteFilter.py '$id'");
        shell_exec("python3 /opt/jasmin/cli/persistent.py");
        return redirect('filters');
    }
    public function addFilter() {
        return view('addFilter');
    }
    public function storeFilter(Request $request) {
        $fid = $request->fid;
        $type = $request->type;
        $parameter = $request->parameter;
        if ($parameter != "") {
            shell_exec("python3 /opt/jasmin/cli/createFilter.py '$fid' '$type' '$parameter'");
        } else {
            shell_exec("python3 /opt/jasmin/cli/createFilterTransparente.py '$fid' '$type'");
        }
        shell_exec("python3 /opt/jasmin/cli/persistent.py");
        return redirect('filters');
    }

    public function dashboard(){
        $customer = new  \App\Models\Submit_log();
        $uid =  auth()->user()->uid;
        $statusOk = $customer::where('status','OK')->where("uid","$uid")->get()->count();
        $statusDelivered = $customer::where('status','DELI%')->where("uid","$uid")->get()->count();
        $statusFailure = $customer::where('status','UNK%')->where("uid","$uid")->get()->count();
        return view('dashboard',['statusOK' => $statusOk, 'statusDelivered' => $statusDelivered, 'statusFailure' => $statusFailure]);
    }

    public function details($id) {
        $submit_log = new \App\Models\Submit_log();
        $submit_log::where('msgid',$id);
        return view('details',['details' => $submit_log->get()]);
    }
    public function logs() {
	    $arrFiles = array();
	    $handle = opendir('/var/log/jasmin');
	    if ($handle) {
		    while (($entry = readdir($handle)) !== FALSE) {
			    $arrFiles[] = $entry;
		    }
	    }
	    closedir($handle);
	    return view('logs', ['files' => $arrFiles]);
    }

}
