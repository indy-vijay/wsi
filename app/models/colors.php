<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Colors extends Eloquent
{
    // public $table = 'brands';
    protected $fillable = array('id', 'styles_id', 'color');
    public $timestamps = false;

    public function scopeName($query, $id)
    {
        $result = $query->where('id', $id)
            ->select('color')
            ->first();

        if (count($result) == 1) {
            return $result->toArray()['color'];
        }

        return 'N/A';
    }

    public function scopeSelectedColor($query, $style)
    {
        return $query->where('style', $style);

    }
}
