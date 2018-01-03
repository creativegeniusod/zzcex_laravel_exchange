<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeWithdraw extends Model
{
    protected $table = 'fee_withdraw';
    public $timestamps = false;

    public function getFeeWithdraw($wallet_id){
    	$fee_withdraw = FeeWithdraw::where('wallet_id', '=', $wallet_id)->first();    	
        if(isset($fee_withdraw->percent_fee))
            return $fee_withdraw->percent_fee;
        else return 0;
    }
}