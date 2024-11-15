<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'category_id', 'supplier_id', 'created_by'
    ];
    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',  
        'updated_at' => 'datetime:Y-m-d H:i:s', 
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public static function getItems()
    {
        return self::query()
                ->with(['category:id,name', 'supplier:id,name', 'createdBy:id,username'])
                ->get()
                ->makeHidden(['category_id', 'supplier_id', 'created_by']);
    }
}
