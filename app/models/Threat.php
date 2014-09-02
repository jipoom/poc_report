<?php


class Threat extends Eloquent {	
	public $timestamps = false;
    protected $table = 'poc_threat';
	public static function getThreatTodayJSON()
	{
		$i=0;		
		$threatCheck = array();
		$allThreat = Threat::rightjoin('poc_location', 'poc_location.id', '=', 'poc_threat.location_id')
                     ->select(DB::raw('poc_location.id, COUNT(location_id) AS total'))
                     ->orderBy('poc_location.id')
                     ->groupBy('poc_location.id')->get();
		
		foreach($allThreat as $temp)
		{
			if($temp->total != 0)
			{
				$threatCheck = array_add($threatCheck, $i , 1);
			}					
			else {
				$threatCheck = array_add($threatCheck, $i , 0);
			}
			
			$i++;
		}
		return json_encode($threatCheck);
			
	}
	public static function getMaxThreatTodayJSON()
	{
		$i=0;		
		$threatMax = array();
		$allThreat = Threat::rightjoin('poc_location', 'poc_location.id', '=', 'poc_threat.location_id')
                     ->select(DB::raw('poc_location.id, MAX(qty) AS maximum'))
                     ->orderBy('poc_location.id')
                     ->groupBy('poc_location.id')->get();
		
		foreach($allThreat as $temp)
		{
			if($temp->maximum)
			{
				$threatMax = array_add($threatMax, $i , $temp->maximum);
			}					
			else {
				$threatMax = array_add($threatMax, $i , 0);
			}
			
			$i++;
		}
		return json_encode($threatMax);
			
		
	}
}

?>