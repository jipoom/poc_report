<?php


class Report extends Eloquent {	
	public $timestamps = false;
    protected $table = 'report';
	public function item()
	{
		return $this->belongTo('Item','item_id');
	}
	public function method()
	{
		return $this->belongTo('Method','method_id');
	}
	public function found_at()
	{
		return $this->belongTo('FoundAt','found_at_id');
	}
}

?>