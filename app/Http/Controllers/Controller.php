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
use DateTime;
$lava = new Lavacharts; // See note below for Laravel
class Controller extends BaseController
{

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function index() {
		return view('home');
	}
	public function customer() {        
		$customer = new \App\Models\Customer();
		if (auth()->user()->profile == 4) {
			$sales_customers = auth()->user()->sales_customers;
        	        $sales_customers = explode(";",$sales_customers);
			$customers = $customer::whereIn('id',$sales_customers)->get();
			return view('customer',['customers' => $customers]);
		} else {
			return view('customer',['customers' => $customer->all()]);
		}
	}
	public function ratesProvider() {
		$rates = new \App\Models\RateProvider();
		return view('rates-provider',['rates' => $rates->all()]);
	} 
	public function ratesCustomer() {
		$rates = new \App\Models\RateCustomer();
		if (auth()->user()->profile == 4 ) {
			$sales_customers = auth()->user()->sales_customers;
        	        $sales_customers = explode(";",$sales_customers);
			$customers = $rates::whereIn('company',$sales_customers)->get();
			return view('rates-customer',['rates' => $customers]);
		} else {
			return view('rates-customer',['rates' => $rates->all()]);
		}
	}
	public function editRatesCustomer($id) {
		$customer = new \App\Models\Customer();
		$rates = new \App\Models\RateCustomer();
		return view('editCustomerRate',['rate' => $rates::findOrfail($id), 'customers' => $customer->all()]);
	}
	public function updateRatesCustomer(Request $request) {
		$rates = new \App\Models\RateCustomer();
		$rates::where('id',$request->id)->update([
			'code' => $request->code,
			'destination' => $request->destination,
			'company' => $request->company,
			'cost' => $request->cost]);
		return redirect('/rates-customer');
	}
	public function updateRatesProvider(Request $request) {
                $rates = new \App\Models\RateProvider();
                $rates::where('id',$request->id)->update([
                        'code' => $request->code,
                        'destination' => $request->destination,
                        'company' => $request->company,
                        'cost' => $request->cost]);
                return redirect('/rates-provider');
        }
	/*public function updateProvider(Request $request) {
		$rates = new \App\Models\RateProvider();
                $rates::where('id',$request->id)->update([
                        'code' => $request->code,
                        'destination' => $request->destination,
                        'company' => $request->company,
                        'cost' => $request->cost]);
                return redirect('/rates-provider');
	}*/
	public function editRatesProvider($id) {
		//$provider = new \App\Models\Provider();
		 $provider = new \App\Models\Connectors();
		$rates = new \App\Models\RateProvider();
		return view('editProviderRate',['rate' => $rates::findOrfail($id), 'connectors' => $provider->all()]);
	}

	public function addRatesProvider() {
		$provider = new \App\Models\Connectors();
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
		$rates->company = $request->company;
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
		$customer->smpppass = $request->uidpass;
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
		$customer->tps = $request->tps;
		if ($request->selectCustomer == "") {
                        $selectCustomer = "";
                } else {
                        $selectCustomer = $request->selectCustomer;
		}
		$customer->sales_customers = $selectCustomer;
		$customer->save();
		shell_exec("python3 /opt/jasmin/cli/createUser.py '$request->uid' '$request->uidpass' '$request->tps'");
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
		$customer = new \App\Models\Customer();
		return view('addCustomer', ['customers' => $customer->all()]);
	}
	public function addProvider() {        
		return view('addProvider');
	}
	public function editProvider($id) {
	        $provider = new  \App\Models\Provider();
                return view('editProvider', ['providers' => $provider::findOrfail($id)]);	
	}
	public function editCustomer($id) { 
		$customer = new  \App\Models\Customer();
		$customer = $customer::findOrfail($id);
		return view('editCustomer', ['customers' => $customer::findOrfail($id), 'customersAll' => $customer->all()]);
	}
	public function editConnector($id) {
		$provider =  new \App\Models\Provider();
		$connectors = new \App\Models\Connectors();
		$providerID = $connectors::where('name', $id)->get(['provider']);
		$infoConn = shell_exec("python3 /opt/jasmin/cli/getConnector.py $id");
		return view('editConnector', ['conn' => $infoConn, 'id' => $id, 'providers' => $provider->all(), 'providerId' => $providerID]);
	}
	public function updateConnector(request $request) {
		$connector = new \App\Models\Connectors();
		$cid = $request->cid;
		$host = $request->host;
		$port = $request->port;
		$username = $request->username;
		$password = $request->password;
		$connector->provider = $request->provider;
		$tps = $request->tps;
		$connector::where('name', $request->cid)->update([
                        'provider' => $request->provider]);
		shell_exec("python3 /opt/jasmin/cli/updateConnector.py '$cid' '$host' '$port' '$username' '$password' '$tps'");
		return redirect('/connector');
	}
	public function startConnector($id) {
		$infoConn = shell_exec("python3 /opt/jasmin/cli/startConnector.py $id");
		return redirect('/connector');
	}
	public function stopConnector($id) {
		$infoConn = shell_exec("python3 /opt/jasmin/cli/stopConnector.py $id");
		return redirect('/connector');
	}

	public function updateCustomer(Request $request) { 
		$customer = new  \App\Models\Customer();
		$uid = $customer::findOrfail($request->id)->get();
                foreach ($uid as $uidUser) {
                        $uidOldGet = $uidUser->uid;
		}
		shell_exec("python3 /opt/jasmin/cli/deleteUser.py '$uidOldGet'");
		if ($request->selectCustomer == "") {
			$selectCustomer = "";
		} else {
			$selectCustomer = $request->selectCustomer;
		}
		if ($request->password != "") {
			$customer::where('id',$request->id)->update([
			'uid' => $request->uid,
			'name' => $request->name, 
			'email' => $request->email, 
			'password' => Hash::make($request->password),
			'address' => $request->address,
			'phone' => $request->phone,
			'company' => $request->company,
			'profile' => $request->profile,
			'tps' => $request->tps,
			'sales_customers' => $selectCustomer]);
		} else { 
			$customer::where('id',$request->id)->update([
                        'uid' => $request->uid,
                        'smpppass' => $request->uidpass,
                        'name' => $request->name,
                        'email' => $request->email,
                        'address' => $request->address,
                        'phone' => $request->phone,
                        'company' => $request->company,
                        'profile' => $request->profile,
			'tps' => $request->tps,
			'sales_customers' => $selectCustomer]);
		}
		shell_exec("python3 /opt/jasmin/cli/createUser.py '$request->uid' '$request->uidpass' '$request->tps'");
//		shell_exec("python3 /opt/jasmin/cli/updateUser.py '$request->uid' '$request->uidpass' '$request->tps'");
		return redirect('/customer');
	}
	public function updateProvider(Request $request) {
		$provider = new \App\Models\Provider();
		if ($request->password != "") {
			$provider::where('id',$request->id)->update([
			'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'address' => $request->address,
                        'phone' => $request->phone,
			'company' => $request->company]);
		} else {
			$provider::where('id',$request->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'address' => $request->address,
                        'phone' => $request->phone,
                        'company' => $request->company]);
		}
		return redirect('/provider');

	}
	public function destroyCustomer($id) {       
		$rates = new \App\Models\RateCustomer();
		$customer = new  \App\Models\Customer();
		shell_exec("python3 /opt/jasmin/cli/deleteUser.py '$id'");
		$customer::findOrfail($id)->delete();
		$rates::where('company',$id)->delete();
		return redirect('/customer');
	}
	public function destroyProvider($id) {       
		$provider = new  \App\Models\Provider();
		$provider::findOrfail($id)->delete();
		return redirect('/provider');
	}
	public function provider() {
		$provider = new \App\Models\Provider();
		return view('provider',['providers' => $provider->all()]);
	}
	public function reports() {
		function validateDateHour($date, $format = 'Y-m-d H:i:s') {
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}
		function validateDateYear($date, $format = 'Y-m-d') {
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}

		$reports = new \App\Models\Submit_log();
		if (isset($_GET['search'])) {
			$search = $_GET['search'];
			if ($_GET['search'] == "") {
				$query = $reports->orderBy('created_at','desc')->paginate(15);
			} else
				if (validateDateHour($search)) {
					$query = $reports::where('created_at', "$search")
						->paginate(15);
				} else if (validateDateYear($search)) {
					$query = $reports::where('created_at', 'LIKE', "$search%")
						->paginate(15);
				} else {
					$query = $reports::where('msgid', "$search")
						->orWhere('source_connector', "$search")
						->orWhere('routed_cid', "$search")
						->orWhere('source_addr', "$search")
						->orWhere('destination_addr', "$search")
						->orWhere('short_message', "$search")
						->orWhere('uid', "$search")	
						->paginate(15);
				}

		} else {
			$query = $reports->orderBy('created_at','desc')->paginate(15);
		}

		return view('reports',['reports' => $query]);
	}
	public function reports_customer() {
		\DB::enableQueryLog(); // Enable query log
		$id = auth()->user()->id;
		$reports = new \App\Models\Submit_log();
		$customer = new \App\Models\Customer();
		$uid = $customer::findOrfail($id)->get();
		foreach ($uid as $uidUser) {
			$id = $uidUser->uid;
		}
		$reportsGetId = $reports::where('uid',$id);
		if (auth()->user()->profile == 4) {
			$sales_customers = auth()->user()->sales_customers;
        	        $sales_customers = explode(";",$sales_customers);
			$customersUID = $customer::whereIn('id',$sales_customers)->get();
			foreach ($customersUID as $uid) {
				$uidF[] = $uid->uid;
			}
			$customers = $reports::WhereIn('uid', $uidF)->paginate(15);
//			dd(\DB::getQueryLog()); // Show results of log
			return view('reports-customer',['reports' => $customers]);
//			dd(\DB::getQueryLog()); // Show results of log
		} else {
			return view('reports-customer',['reports' => $reports::where('uid',"$id")->paginate(15)]);
		}
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
		$connectorsStatus = shell_exec("python3 /opt/jasmin/cli/mt-connectors.py | awk '{print $2 \" \" $3 \" \" $4 \" \" $5}' | sed 's/#//g'");
		$connectors = explode("\n", $connectors);
		$connectorsStatus = explode("\n", $connectorsStatus);
		return view('connector', 
			['connectores' => $connectors, 'connectorsStatus' => $connectorsStatus]);
	}
	public function addConnector() {
		$provider = new \App\Models\Provider();
		return view('addConnector', ['providers' => $provider->all()]);
	}
	public function storeConnector(Request $request) { 
		$connector = new \App\Models\Connectors();

		$cid = $request->cid;      
		$host = $request->host;
		$port = $request->port;
		$username = $request->username;
		$password = $request->password;
		$tps = $request->tps;
		$connector->name = $cid;
		$connector->provider = $request->provider;
		$connector->save();
		shell_exec("python3 /opt/jasmin/cli/createMtConnector.py '$cid' '$host' '$port' '$username' '$password' '$tps'");
		shell_exec("python3 /opt/jasmin/cli/persistent.py");
		return redirect('/connector');
	}
	public function destroyConnector($id) {    
		$connector = new \App\Models\Connectors();
		$connector::where('name', "$id")->delete();
		$rates = new \App\Models\RateProvider();
		$rates::where('company',$id)->delete();
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
		$customer = new  \App\Models\Submit_log();
		$countSMS = $_GET['countSMS'];
		if (is_null($_GET['customer'])) {
			$uid =  auth()->user()->uid;
		} else {
			$uid = $_GET['customer'];
		}
		$profile = auth()->user()->profile;
		//if ($profile == 3) {
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
		//} else {
		/*	if ($countSMS ==  'day') {
				$statusDelivered = $customer::where('status','like','DELI%')->whereDate('created_at', Carbon::today())->get()->count();
				$statusFailure = $customer::whereDate('created_at', Carbon::today())->where(function($query) {
					$query->where('status','like','REJ%')->orWhere('status','like','UND%')->orWhere('status','like','FAIL%');})->get()->count();
					$statusOk = $customer::where('status','CommandStatus.ESME_ROK')->whereDate('created_at', Carbon::today())->get()->count();
					$statusOthers = $customer::where('status','!=','CommandStatus.ESME_ROK')->where('status','!=','CommandStatus.')->whereDate('created_at', Carbon::today())->get()->count();
					//				  dd(\DB::getQueryLog()); // Show results of log
			}
			if ($countSMS ==  'month') {
				\DB::enableQueryLog(); // Enable query log
				$statusDelivered = $customer::where('status','like','DELI%')->where('created_at','LIKE',Carbon::now()->year.'-'.  date('m') .'%')->get()->count();
				$statusFailure = $customer::where('created_at','LIKE',Carbon::now()->year.'-'. date('m') .'%')->where(function($query) {
					$query->where('status','like','REJ%')->orWhere('status','like','UND%')->orWhere('status','like','FAIL%');})->get()->count();
					$statusOk = $customer::where('status','CommandStatus.ESME_ROK')->where('created_at','LIKE',Carbon::now()->year.'-'. date('m').'%')->get()->count();
					$statusOthers = $customer::where('status','!=','CommandStatus.ESME_ROK')->where('status','!=','CommandStatus.')->where('created_at', 'LIKE',Carbon::now()->year.'-'.  date('m') .'%')->get()->count();
					//dd(\DB::getQueryLog());
			}
			if ($countSMS ==  'year') {
				$statusDelivered = $customer::where('status','like','DELI%')->whereYear('created_at',Carbon::now()->year)->get()->count();
				$statusFailure = $customer::where("uid","$uid")->whereYear('created_at',Carbon::now()->year)->where(function($query) {
					$query->where('status','like','REJ%')->orWhere('status','like','UND%')->orWhere('status','like','FAIL%');})->get()->count();
					$statusOk = $customer::where('status','CommandStatus.ESME_ROK')->whereYear('created_at', Carbon::now()->year)->get()->count();
					$statusOthers = $customer::where('status','!=','CommandStatus.ESME_ROK')->where('status','!=','CommandStatus.')->where("uid","$uid")->whereYear('created_at', Carbon::now()->year)->get()->count();
			}	
		}
		*/
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
		$profile =  auth()->user()->profilei;

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
		if (auth()->user()->profile == 4) {
			$sales_customers = auth()->user()->sales_customers;
        	        $sales_customers = explode(";",$sales_customers);
			$customers = $customer::whereIn('id',$sales_customers)->get();
			return view('refill',['customers' => $customers]);
		} else {
			return view('refill',['customers' => $customer->all()]);
		}
	}
	public function addRefill($id) {
		return view('addRefill', ['id' => $id]);
	}
	public function invoices() {
		$invoices = new \App\Models\Invoices();
		if (auth()->user()->profile == 4) {
			$sales_customers = auth()->user()->sales_customers;
	                $sales_customers = explode(";",$sales_customers);
			$customers = $invoices::whereIn('client',$sales_customers)->get();
	                return view('invoices',['invoices' => $customers]);
		} else {
	                return view('invoices',['invoices' => $invoices->all()]);
		}
	}
	public function addInvoice() {
		$customer = new  \App\Models\Customer();
		return view('addInvoice', ['customers' => $customer->all()]);
	}
	public function storeInvoices(Request $request) {
		$invoices = new \App\Models\Invoices();
		$invoices->client = $request->company;
		$invoices->value = $request->refillValue;
		$invoices->comment = $request->comment;
		$invoices->save();
		return redirect('/invoices');

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
		$firewall->proto = $request->proto;
		$firewall->port = $request->port;
		$firewall->save();
		if ($firewall->rule == True) {
			$rule = 'ACCEPT';
		} else {
			$rule = 'DROP';
		}
		$db = pg_connect("host=localhost port=5432 dbname=sms user=sms password=Konnecting@39");
		$result = pg_query($db,"SELECT * FROM iptables");
		$myfile = fopen("/var/www/html/sms-project/firewall/rulesFW.v4", "w") or die("Unable to open file!");
		$txt = "*filter\n
:INPUT DROP [337085:33857280]\n
:FORWARD ACCEPT [0:0]\n
:OUTPUT ACCEPT [10379167:1343868855]\n
-A INPUT -i lo -j ACCEPT
-A INPUT -p tcp -m tcp --dport 40144 -j ACCEPT
-A INPUT -p tcp -m tcp --dport 998 -j ACCEPT
-A INPUT -m state --state RELATED,ESTABLISHED -j ACCEPT\n";
		fwrite($myfile, $txt);
		while($row=pg_fetch_assoc($result)){
			$ip = $row['ip'];
			$rule = $row['rule'];
			if ($rule == True) {
				$rule = 'ACCEPT';
			} else {
				$rule = 'DROP';
			}
			$port = $row['port'];
			$proto = $row['proto'];
			$identify = $row['identify'];
			$txt = "###$identify\n";
			fwrite($myfile, $txt);
			$txt = "-A INPUT -s $ip -p $proto -m $proto --dport $port -j $rule\n";
			fwrite($myfile, $txt);
		}
		$txt = "COMMIT\n";
		fwrite($myfile, $txt);
		$proto = $request->proto;
		$port = $request->port;
		//		shell_exec("sudo /sbin/iptables -A INPUT -s $ip -p $proto -m $proto --dport $port -j $rule");
		shell_exec("sudo /usr/sbin/iptables-restore < /var/www/html/sms-project/firewall/rulesFW.v4");
		return redirect('/firewall');
	}
	public function deleteFirewall($id) { 
		$firewall = new \App\Models\Iptables();
		$IP=$firewall::findOrfail($id)->get();
/*		foreach($IP as $ip) {
			$num=shell_exec("sudo /sbin/iptables -L -n -v --line-numbers | grep '$ip->ip' |awk {'print $1'}");
		}
		shell_exec("sudo /sbin/iptables -D INPUT $num");
 */
		$firewall::findOrfail($id)->delete();	
		$db = pg_connect("host=localhost port=5432 dbname=sms user=sms password=Konnecting@39");
                $result = pg_query($db,"SELECT * FROM iptables");
                $myfile = fopen("/var/www/html/sms-project/firewall/rulesFW.v4", "w") or die("Unable to open file!");
                $txt = "*filter\n
:INPUT DROP [337085:33857280]\n
:FORWARD ACCEPT [0:0]\n
:OUTPUT ACCEPT [10379167:1343868855]\n
-A INPUT -i lo -j ACCEPT
-A INPUT -p tcp -m tcp --dport 40144 -j ACCEPT
-A INPUT -p tcp -m tcp --dport 998 -j ACCEPT
-A INPUT -m state --state RELATED,ESTABLISHED -j ACCEPT\n";
                fwrite($myfile, $txt);
                while($row=pg_fetch_assoc($result)){
                        $ip = $row['ip'];
                        $rule = $row['rule'];
                        if ($rule == True) {
                                $rule = 'ACCEPT';
                        } else {
                                $rule = 'DROP';
                        }
                        $port = $row['port'];
                        $proto = $row['proto'];
                        $identify = $row['identify'];
                        $txt = "###$identify\n";
                        fwrite($myfile, $txt);
                        $txt = "-A INPUT -s $ip -p $proto -m $proto --dport $port -j $rule\n";
                        fwrite($myfile, $txt);
                }
                $txt = "COMMIT\n";
                fwrite($myfile, $txt);
		shell_exec("sudo /usr/sbin/iptables-restore < /var/www/html/sms-project/firewall/rulesFW.v4");
		return redirect('/firewall');
	}
	public function sendSMS() {
		return view('sendSMS');
	}
	public function sendSMSGW(Request $request) {
		$customer = new \App\Models\Customer();
		$src = urlencode($request->origem);
		$dst = urlencode($request->destino);
		$message = urlencode($request->mensagem);
		$baseurl = 'http://127.0.0.1:1401/send';
		$idUser = auth()->user()->id;
		$id = $customer::findOrfail($idUser);
		$uid = $id->uid;
		$password = $id->smpppass;
		$params = '?username='.$uid;
		$params.= '&password='.$password;
		$params.= '&from='.$src;
		$params.= '&to='.$dst;
		$params.= '&content='.$message;
		$params.= '&dlr=yes';
		$params.= '&dlr-level=3';
		$params.= '&dlr-url=http://127.0.0.1/dlr/index.php';
		$response = file_get_contents($baseurl.$params);
		return view('sendSMS', ['response' => $response]);

	}
	public function summaryCustomer() {
		return view('summaryCustomer');
	}
	public function summaryProvider() {
		return view('summaryProvider');
	}
}
