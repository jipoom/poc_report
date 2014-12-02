<?php


class Table extends Eloquent {
	
	public static function generateTable($categoryId,$khetId,$locationId,$foundAtId,$methodId,$startDate,$endDate){
		$startDate= date("Y-m-d", strtotime($startDate));	
			$endDate= date("Y-m-d", strtotime($endDate));	
			if($khetId == 0)
			{
				if($methodId == 0 && $foundAtId == 0 && $categoryId == 0){	
					$table = ReportSummary::where('found_date','>=',$startDate)
					->where('found_date','<=',$endDate)
					->get();
				}
				else if($methodId != 0 && $foundAtId != 0 && $categoryId != 0){
					$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
							->where('method', '=', $methodId) 
							->where('found_at_id', '=', $foundAtId)
							->get();	
				}
				else if($methodId == 0 && $foundAtId != 0 && $categoryId != 0){
					$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
							->where('found_at_id', '=', $foundAtId)
							->get();		
				}
				else if($methodId == 0 && $foundAtId == 0 && $categoryId != 0){
					$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)->get();	
				}
				else if($methodId != 0 && $foundAtId == 0 && $categoryId != 0){
					$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
							->where('method', '=', $methodId) 
							->get();	
				}
				else if($methodId != 0 && $foundAtId != 0 && $categoryId == 0){
					$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
					->where('found_date','<=',$endDate)
					->where('method','=',$methodId)
					->where('found_at_id','=',$foundAtId)
					->get();
				}
				else if($methodId == 0 && $foundAtId != 0 && $categoryId == 0){	
					$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
					->where('found_date','<=',$endDate)
					->where('found_at_id','=',$foundAtId)
					->get();
				}
				else if($methodId != 0 && $foundAtId == 0 && $categoryId == 0){			
					$table = ReportSummary::where('found_date','>=',$startDate)
					->where('found_date','<=',$endDate)
					->where('method','=',$methodId)	
					->get();
				}
				
			}
			else{
				if($locationId == 0)
				{
					if($methodId == 0 && $foundAtId == 0 && $categoryId == 0){		
						$table = ReportSummary::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',$khetId)
						->get();
					}	
					else if($methodId == 0 && $foundAtId == 0 && $categoryId != 0){
						$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
						    ->where('khet_id','=',$khetId)
							->get();	
					}	
					else if($methodId == 0 && $foundAtId != 0 && $categoryId == 0){	
						$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',$khetId)
						->where('found_at_id','=',$foundAtId)
						->get();
					}
					else if($methodId == 0 && $foundAtId != 0 && $categoryId != 0){
						$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
							->where('found_at_id','=',$foundAtId)
							->where('khet_id','=',$khetId)
							->get();	
					}
					else if($methodId != 0 && $foundAtId == 0 && $categoryId == 0){	
						$table = ReportSummary::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',$khetId)
						->where('method','=',$methodId)
						->get();
					}
					else if($methodId != 0 && $foundAtId == 0 && $categoryId != 0){
						$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
							->where('method', '=', $methodId) 
							->where('khet_id','=',$khetId)
							->get();		
					}
					else if($methodId != 0 && $foundAtId != 0 && $categoryId == 0){	
						$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',$khetId)
						->where('method','=',$methodId)
						->where('found_at_id','=',$foundAtId)
						->get();
					}
					else if($methodId != 0 && $foundAtId != 0 && $categoryId != 0){
						$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
							->where('method', '=', $methodId) 
							->where('found_at_id','=',$foundAtId)
							->where('khet_id','=',$khetId)
							->get();	
					}
				}
				else{
					if($methodId == 0 && $foundAtId == 0 && $categoryId == 0){		
						$table = ReportSummary::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('location_id','=',$locationId)
						->get();
					}	
					else if($methodId == 0 && $foundAtId == 0 && $categoryId != 0){
						$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
							->where('location_id','=',$locationId)
							->get();	
					}	
					else if($methodId == 0 && $foundAtId != 0 && $categoryId == 0){	
						$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('found_at_id','=',$foundAtId)
						->where('location_id','=',$locationId)
						->get();
					}
					else if($methodId == 0 && $foundAtId != 0 && $categoryId != 0){
						$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
							->where('found_at_id','=',$foundAtId)
							->where('location_id','=',$locationId)
							->get();	
					}
					else if($methodId != 0 && $foundAtId == 0 && $categoryId == 0){	
						$table = ReportSummary::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('method','=',$methodId)
						->where('location_id','=',$locationId)
						->get();
					}
					else if($methodId != 0 && $foundAtId == 0 && $categoryId != 0){
						$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
							->where('method','=',$methodId)
							->where('location_id','=',$locationId)
							->get();	
					}
					else if($methodId != 0 && $foundAtId != 0 && $categoryId == 0){	
						$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('found_at_id','=',$foundAtId)
						->where('method','=',$methodId)
						->where('location_id','=',$locationId)
						->get();
					}
					else if($methodId != 0 && $foundAtId != 0 && $categoryId != 0){
						$table = ReportSummaryByFoundAt::reportByCategory($categoryId,$startDate,$endDate)
							->where('method','=',$methodId)
							->where('found_at_id','=',$foundAtId)
							->where('location_id','=',$locationId)
							->get();	
					}
				
					
				}
				
			}			
			return $table;
	}
	public static function calculateTotal($table){
		$total = array('normal'=>'0','special'=>'0','notFound'=>'0','found'=>'0','a'=>'0','b'=>'0','c'=>'0','d'=>'0','e'=>'0','f'=>'0','g'=>'0','h'=>'0','i'=>'0','j'=>'0','k'=>'0','l'=>'0',
			'm'=>'0','n'=>'0','o'=>'0','p'=>'0','q'=>'0','r'=>'0','s'=>'0','t'=>'0','u'=>'0','v'=>'0','w'=>'0');
			foreach($table as $temp){
				if($temp->method == 1){
					$total['normal']++;
				}	
				else if($temp->method == 2){
					$total['special']++;
				}
				if($temp->a+$temp->b+$temp->c+$temp->d+$temp->e+
							$temp->f+$temp->g+$temp->h+$temp->i+$temp->j+
							$temp->k+$temp->l+$temp->m+$temp->n+$temp->o+
							$temp->p+$temp->q+$temp->r+$temp->s+$temp->t+
							$temp->u+$temp->v+$temp->w == 0)
				{
					$total['notFound']++;
				}	
				else{
					$total['found']++;
				}	
				$total['a'] = $temp->a + $total['a'];
				$total['b'] = $temp->b + $total['b'];
				$total['c'] = $temp->c + $total['c'];
				$total['d'] = $temp->d + $total['d'];
				$total['e'] = $temp->e + $total['e'];
				$total['f'] = $temp->f + $total['f'];
				$total['g'] = $temp->g + $total['g'];
				$total['h'] = $temp->h + $total['h'];
				$total['i'] = $temp->i + $total['i'];
				$total['j'] = $temp->j + $total['j'];
				$total['k'] = $temp->k + $total['k'];
				$total['l'] = $temp->l + $total['l'];
				$total['m'] = $temp->m + $total['m'];
				$total['n'] = $temp->n + $total['n'];
				$total['o'] = $temp->o + $total['o'];
				$total['p'] = $temp->p + $total['p'];
				$total['q'] = $temp->q + $total['q'];
				$total['r'] = $temp->r + $total['r'];
				$total['s'] = $temp->s + $total['s'];
				$total['t'] = $temp->t + $total['t'];
				$total['u'] = $temp->u + $total['u'];
				$total['v'] = $temp->v + $total['v'];
				$total['w'] = $temp->w + $total['w'];
			}
		    return $total;
	} 
}
?>