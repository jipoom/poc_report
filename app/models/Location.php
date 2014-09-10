<?php


class Location extends Eloquent {	
	public $timestamps = false;
    protected $table = 'locations';	
	public function user()
	{
		return $this->hasMany('User');
	}
	
	public static function getLatitudeJSON()
	{
		$i=0;		
		$lat = array();
		$allLat = Location::all();
		foreach($allLat as $temp)
		{				
			$lat = array_add($lat, $i , $temp->lat);
			$i++;
		}
		return json_encode($lat);
	}
	public static function getLongitudeJSON()
	{
		$i=0;		
		$lat = array();
		$allLat = Location::all();
		foreach($allLat as $temp)
		{				
			$lat = array_add($lat, $i , $temp->long);
			$i++;
		}
		return json_encode($lat);
	}
	public static function getLocationID_JSON()
	{
		$i=0;		
		$lat = array();
		$allLat = Location::all();
		foreach($allLat as $temp)
		{				
			$lat = array_add($lat, $i , $temp->id);
			$i++;
		}
		return json_encode($lat);
	}
	public static function getLocationNameJSON()
	{
		$i=0;		
		$lat = array();
		$allLat = Location::all();
		foreach($allLat as $temp)
		{				
			$lat = array_add($lat, $i , $temp->name);
			$i++;
		}
		return json_encode($lat);
	}
	
	
	
}

?>