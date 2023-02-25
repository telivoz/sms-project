<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use app\Models;
use Carbon\Carbon;
use App\Models\Customer;
#use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Auth;
use Khill\Lavacharts\Lavacharts;

$lava = new Lavacharts; // See note below for Laravel
class Controller extends BaseController
{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index() {
        return view('home');
    }
    public function customer() {        
        $customer = new \App\Models\Customer();
        return view('customer',['customers' => $customer->all()]);
    }
    public function ratesProvider() {
        $rates = new \App\Models\RateProvider();
    	return view('rates-provider',['rates' => $rates->all()]);
    } 
    public function ratesCustomer() {
	$rates = new \App\Models\RateCustomer();
        return view('rates-customer',['rates' => $rates->all()]);
    }
    public function addRatesProvider() {
	$provider = new \App\Models\Provider();
    	return view('addProviderRate', ['providers' => $provider->all()]);
    }
    public function addRatesCustomer() {
	$customer = new \App\Models\Customer();
        return view('addCustomerRate',['customers' => $customer->all()]);
    }
    public function storeRatesCustomer(Request $request) {
    	$rates = new \App\Models\RateCustomer();
	$rates->code = $request->code;
	$rates->destination = $request->destination;
        $rates->company = $request->company;
        $rates->cost = $request->cost;
	$rates->save();
	return redirect('/rates-customer');
    }
    public function storeRatesProvider(Request $request) {
        $rates = new \App\Models\RateProvider();
        $rates->code = $request->code;
	$rates->destination = $request->destination;
	$retes->company = $request->company;
        $rates->cost = $request->cost;
        $rates->save();
        return redirect('/rates-provider');
    }
    public function deleteRateCustomer($id) {
        $provider = new  \App\Models\RateCustomer();
        $provider::findOrfail($id)->delete();
        return redirect('/rates-customer');
    }
    public function deleteRateProvider($id) {
        $provider = new  \App\Models\RateProvider();
        $provider::findOrfail($id)->delete();
        return redirect('/rates-provider');
    }
    public function storeCustomer(Request $request){
        $customer = new  \App\Models\Customer();
        $customer->uid = $request->uid;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password); 
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->company = $request->company;
        $customer->profile = $request->profile;
        $customer->rate = "0.0000";
        $customer->currency = "$";
        $customer->balance = "0.0000";
	$customer->save();
	shell_exec("python3 /opt/jasmin/cli/createUser.py '$request->uid' '$request->password'");
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
        $customer = new  \App\Models\Customer();
        $customer = $customer::findOrfail($id);
        return view('editCustomer', ['customers' => $customer::findOrfail($id)]);
    }
    public function editConnector($id) { 
	$infoConn = shell_exec("python3 /opt/jasmin/cli/getConnector.py $id");
        return view('editConnector', ['conn' => $infoConn, 'id' => $id]);
    }
    public function updateConnector(request $request) {
    	$cid = $request->cid;
	$host = $request->host;
	$port = $request->port;
	$username = $request->username;
	$password = $request->password;
	shell_exec("python3 /opt/jasmin/cli/updateConnector.py '$cid' '$host' '$port' '$username' '$password'");
	return redirect('/connector');
    }
    public function updateCustomer(Request $request) { 
    	$customer = new  \App\Models\Customer();
        $customer::where('id',$request->id)->update([
        'uid' => $request->uid,
        'name' => $request->name, 
        'email' => $request->email, 
        'password' => Hash::make($request->password),
        'address' => $request->address,
        'phone' => $request->phone,
        'company' => $request->company,
        'profile' => $request->profile]);
        shell_exec("python3 /opt/jasmin/cli/updateUser.py '$request->uid' '$request->password'");       
        return redirect('/customer');
    }
    public function destroyCustomer($id) {       
        $customer = new  \App\Models\Customer();
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
    public function reports_customer() {
	$id = auth()->user()->id;
	$reports = new \App\Models\Submit_log();
	$customer = new \App\Models\Customer();
	$uid = $customer::findOrfail($id)->get();
	foreach ($uid as $uidUser) {
		$id = $uidUser->uid;
	}
	$reportsGetId = $reports::where('uid',$id);
        return view('reports-customer',['reports' => $reports::where('uid',"$id")->paginate(15)]);
    }
    public function reports_provider() {
        $reports = new \App\Models\Submit_log();
        return view('reports-provider',['reports' => $reports->paginate(15)]);
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
    public function dashboardAPI() {
	    \DB::enableQueryLog(); // Enable query log
	$countSMS = $_GET['countSMS'];
	$customer = new  \App\Models\Submit_log();
	$uid =  auth()->user()->uid;
	if ($countSMS ==  'day') {
        	$statusDelivered = $customer::where('status','like','DELI%')->where("uid","$uid")->whereDate('created_at', Carbon::today())->get()->count();
		$statusFailure = $customer::where("uid","$uid")->whereDate('created_at', Carbon::today())->where(function($query) { 
			$query->where('status','like','REJ%')->orWhere('status','like','UND%')->orWhere('status','like','FAIL%');})->get()->count();
        	$statusOk = $customer::where('status','CommandStatus.ESME_ROK')->where("uid","$uid")->whereDate('created_at', Carbon::today())->get()->count();
			$statusOthers = $customer::where('status','!=','CommandStatus.ESME_ROK')->where('status','!=','CommandStatus.')->where("uid","$uid")->whereDate('created_at', Carbon::today())->get()->count();
			//dd(\DB::getQueryLog()); // Show results of log
	}
	if ($countSMS ==  'month') {
		\DB::enableQueryLog(); // Enable query log
		$statusDelivered = $customer::where('status','like','DELI%')->where("uid","$uid")->where('created_at','LIKE',Carbon::now()->year.'-'.  date('m') .'%')->get()->count();
		$statusFailure = $customer::where("uid","$uid")->where('created_at','LIKE',Carbon::now()->year.'-'. date('m') .'%')->where(function($query) {
			$query->where('status','like','REJ%')->orWhere('status','like','UND%')->orWhere('status','like','FAIL%');})->get()->count();
			$statusOk = $customer::where('status','CommandStatus.ESME_ROK')->where("uid","$uid")->where('created_at','LIKE',Carbon::now()->year.'-'. date('m').'%')->get()->count();
			$statusOthers = $customer::where('status','!=','CommandStatus.ESME_ROK')->where('status','!=','CommandStatus.')->where("uid","$uid")->where('created_at', 'LIKE',Carbon::now()->year.'-'.  date('m') .'%')->get()->count();
			//dd(\DB::getQueryLog());
	}
	if ($countSMS ==  'year') {
		$statusDelivered = $customer::where('status','like','DELI%')->where("uid","$uid")->whereYear('created_at',Carbon::now()->year)->get()->count();
                $statusFailure = $customer::where("uid","$uid")->whereYear('created_at',Carbon::now()->year)->where(function($query) {
                        $query->where('status','like','REJ%')->orWhere('status','like','UND%')->orWhere('status','like','FAIL%');})->get()->count();
			$statusOk = $customer::where('status','CommandStatus.ESME_ROK')->where("uid","$uid")->whereYear('created_at', Carbon::now()->year)->get()->count();
			$statusOthers = $customer::where('status','!=','CommandStatus.ESME_ROK')->where('status','!=','CommandStatus.')->where("uid","$uid")->whereYear('created_at', Carbon::now()->year)->get()->count();
        }
	$data = [
           	'delivered' => $statusDelivered,
	        'failure' => $statusFailure,	
		'ok'   => $statusOk,
		'others' => $statusOthers,
                'type'  => $countSMS,
            
        ];

        return response()->json($data, 200);

    }
    public function dashboard(){

	if (!isset(auth()->user()->uid)) {
		return redirect('/login');
	}
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
        return view('details',['details' => $submit_log::where('msgid',$id)->get()->toArray(), 'id' => $id]);
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
    public function refill() {
    	$customer = new \App\Models\Customer();
        return view('refill',['customers' => $customer->all()]);
    }
    public function addRefill($id) {
	    return view('addRefill', ['id' => $id]);
    }
    public function updateRefill(Request $request) {
	    $customer = new  \App\Models\Customer();
	    $rate = $customer::where('id',$request->id)->value('balance') + $request->refillValue;
        $customer::where('id',$request->id)->update([
		'balance' => $rate]);

	return redirect('/refil');

    }
    public function firewall() {
	    $firewall = new \App\Models\Iptables();
	    return view('firewall', ['rules' => $firewall->all()]);
    }

    public function addFirewall() {
	    return view('addFirewall');
    }
    public function storeFirewall(Request $request) {
	$firewall = new \App\Models\Iptables();	
	$firewall->ip = $request->ip;
	$ip = $request->ip;
        $firewall->identify = $request->desc;
        $firewall->rule = $request->type;
	$firewall->save();
	if ($firewall->rule == True) {
		$rule = 'ACCEPT';
	} else {
		$rule = 'DROP';
	}
	shell_exec("sudo /sbin/iptables -A INPUT -s $ip -j $rule");
	return redirect('/firewall');
    }
    public function deleteFirewall($id) { 
	$firewall = new \App\Models\Iptables();
	$IP=$firewall::findOrfail($id)->get();
	foreach($IP as $ip) {
		$num=shell_exec("sudo /sbin/iptables -L -n -v --line-numbers | grep '$ip->ip' |awk {'print $1'}");
	}
	shell_exec("sudo /sbin/iptables -D INPUT $num");
	$firewall::findOrfail($id)->delete();	
	return redirect('/firewall');
    }
}
