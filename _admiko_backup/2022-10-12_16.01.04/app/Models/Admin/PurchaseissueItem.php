<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ItemsList;
use App\Models\Admin\StudentsList;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;
use App\Http\Controllers\Traits\Admin\AdmikoAuditableTrait;
use App\Http\Controllers\Traits\Admin\AdmikoMultiTenantModeTrait;

class PurchaseissueItem extends Model
{
    use AdmikoFileUploadTrait,AdmikoAuditableTrait,AdmikoMultiTenantModeTrait;

    public $table = 'purchaseissue_item';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"student_name",
		"quantity",
		"amount",
    ];
    public function items_many()
    {
        return $this->belongsToMany(ItemsList::class, 'purchaseissue_item_items_many', 'parent_id', 'selected_id')->withPivot('admiko_order');
    }
	public function student_name_id()
    {
        return $this->belongsTo(StudentsList::class, 'student_name');
    }
	public function getAmountAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
}