<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Deposit extends Model
{
	protected $table = 'deposits';
	public function addressIsDesposited($address){
		$deposit = Deposit::where('address',$address)->first();
		if(isset($deposit->address)) return 1;
		else return 0;
	}
}
?>