<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Desc extends Eloquent 
{
    protected $fillable    = array('desc','flag_active');
    public    $timestamps  = false;
    protected $table       = 'desc';

    public function scopeName($query, $id)
    {
        return $query->where('id',$id)
                        ->select('desc')
                        ->first()
                        ->toArray()['desc'];
    }

    public function scopeGetIdByName($query, $desc)
    {
        return $query->where('desc', $desc)
                        ->select('id')
                        ->get();
    }

    public function scopeActive($query)
    {
        return $query->where('flag_active',1);
    }

    public function brands()
    {
        return $this->hasMany('\Brands');
    }

}