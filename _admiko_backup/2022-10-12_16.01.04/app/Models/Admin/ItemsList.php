<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ItemType;
use App\Models\Admin\Suppliers;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;
use App\Http\Controllers\Traits\Admin\AdmikoAuditableTrait;
use App\Http\Controllers\Traits\Admin\AdmikoMultiTenantModeTrait;

class ItemsList extends Model
{
    use AdmikoFileUploadTrait,AdmikoAuditableTrait,AdmikoMultiTenantModeTrait;

    public $table = 'items_list';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"item_name",
		"type",
		"quantity",
		"price",
		"supplier",
    ];
    public function type_id()
    {
        return $this->belongsTo(ItemType::class, 'type');
    }
	public function getPriceAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
	public function supplier_id()
    {
        return $this->belongsTo(Suppliers::class, 'supplier');
    }
}