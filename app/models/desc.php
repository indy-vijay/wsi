<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Desc extends Eloquent 
{
    protected $fillable    = array('desc');
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

    public function brands()
    {
        return $this->hasMany('\Brands');
    }

}