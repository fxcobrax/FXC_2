<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Staffs;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;
use App\Http\Controllers\Traits\Admin\AdmikoAuditableTrait;
use App\Http\Controllers\Traits\Admin\AdmikoMultiTenantModeTrait;

class PaySalary extends Model
{
    use AdmikoFileUploadTrait,AdmikoAuditableTrait,AdmikoMultiTenantModeTrait;

    public $table = 'pay_salary';
    
    
	const STATUS_CONS = ["FullPayment"=>"Full Payment","PartPayment"=>"Part Payment"];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"staff",
		"amount",
		"status",
    ];
    public function staff_id()
    {
        return $this->belongsTo(Staffs::class, 'staff');
    }
	public function getAmountAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
}