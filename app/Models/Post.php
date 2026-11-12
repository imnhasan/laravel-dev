<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use mysql_xdevapi\Exception;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public static function getPost()
    {
        try {
            $userStore = DB::table('stores')
                ->join('store_user', 'store_user.store_id', '=','stores.id')
                ->select('stores.id')
                ->where('store_user.user_id', auth()->id())
                ->pluck('id');

            $transferUnreceivedList = DB::table('transfer_masters')
                ->join('stores as from_store', 'transfer_masters.from_store_id', '=', 'from_store.id')
                ->join('stores as to_store', 'transfer_masters.to_store_id', '=', 'to_store.id')
                ->join('buyers', 'transfer_masters.buyer_id', '=', 'buyers.id')
                ->join('buyers', 'transfer_masters.buyer_id', '=', 'buyers.id')
                ->join('buyers', 'transfer_masters.buyer_id', '=', 'buyers.id')
                ->join('buyers', 'transfer_masters.buyer_id', '=', 'buyers.id')
                ->join('buyers', 'transfer_masters.buyer_id', '=', 'buyers.id')
                ->select('transfer_masters.id', 'transfer_masters.from_store_id', 'from_store.store_name as from_store_name',
                    'transfer_masters.to_store_id', 'to_store.store_name as to_store_name', 'transfer_masters.buyer_id',
                    'buyers.buyer_name', 'transfer_masters.challan_date', 'transfer_masters.is_received', 'transfer_masters.remarks',
                    'transfer_masters.status'
                )
                ->whereIn('to_store', $userStore)
                ->where('is_received', 0)
                ->where('transfer_masters.status',  '!=', 'D')
                ->get();
            if($transferUnreceivedList->count() > 0) {
                return $transferUnreceivedList;
            }
        } catch (\Exception $exception) {
            info('errors');
        }
        return 0;
    }
}
