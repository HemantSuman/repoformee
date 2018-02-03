<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Auth;

class OrderDetail extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'order_details';
    protected $fillable = [
        'id', 'classified_id', 'order_id', 'item_name', 'item_qty', 'item_price', 'item_total_amt','seller_id', 'item_ship_cost', 'item_ship_name', 'transaction_id', 'transaction_status', 'senderTransactionId', 'created_at', 'updated_at'
    ];
    
	 public function orderDetailSeller() {
        return $this->belongsTo('App\models\User', 'seller_id');
    }
	
	public function orders() {
        return $this->belongsTo('App\models\Order', 'order_id');
    }
	
	    /**
     * get list of Orders
     *
     * @param array $req  all conditions like where, order by and limit
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function Listing() {

        DB::enableQueryLog();
        $requestArr = Input::all();
		
       
            $results = new self();
			
			if (!empty($requestArr['order_id'])) {
                $results = $results->where('order_id', 'LIKE', "%{$requestArr['order_id']}%");
            }
            
            $results = $results->orderBy('created_at', 'DESC');
            $results = $results->paginate(10);
        

        return $results;
    }
    
}
