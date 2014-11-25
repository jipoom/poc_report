<?php

class TableController extends BaseController {
	public function getReport($startDate=null,$endDate=null){
		$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
		if($startDate==null || $endDate == null)
		{
			$startDate=date('Y-m-d',strtotime("-1 days"));
			$endDate = $startDate;
		}	
		else{
			$startDate = Report::convertYearBtoC($startDate);
			$endDate = Report::convertYearBtoC($endDate);
		}
		/*$table = Report::generateReportRow(Auth::user()->location->id,$startDate,$endDate);
		// get summary
		$total = Report::getTotal(Auth::user()->location->id, $startDate, $endDate);
		$table = array_add($table,'รวม',$total);*/
		$startDate= date("Y-m-d", strtotime($startDate));	
		$endDate= date("Y-m-d", strtotime($endDate));	
		$table = ReportSummary::where('found_date','>=',$startDate)
		->where('found_date','<=',$endDate)
		->where('location_id','=',Auth::user()->location->id)
		->get();
		
		$total = Report::getTotal(Auth::user()->location->id, $startDate, $endDate);
		
		$startDate = Report::convertYearCtoB(date('d-m-Y',strtotime($startDate)));
		$endDate = Report::convertYearCtoB(date('d-m-Y',strtotime($endDate)));
		return View::make('report/view_table',compact('table','buddhistYear','startDate','endDate','total'));
	}
	public function postReport(){
		$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
		if(Input::get('startDate')==null || Input::get('endDate') == null)
		{
			$startDate=date('Y-m-d',strtotime("-1 days"));
			$endDate = $startDate;
		}	
		else{
			$startDate = Report::convertYearBtoC(Input::get('startDate'));
			$endDate = Report::convertYearBtoC(Input::get('endDate'));
		}
		/*$table = Report::generateReportRow(Auth::user()->location->id,$startDate,$endDate);
		// get summary
		$total = Report::getTotal(Auth::user()->location->id, $startDate, $endDate);
		$table = array_add($table,'รวม',$total);
		*/
		$startDate= date("Y-m-d", strtotime($startDate));	
		$endDate= date("Y-m-d", strtotime($endDate));	
		$table = ReportSummary::where('found_date','>=',$startDate)
		->where('found_date','<=',$endDate)
		->where('location_id','=',Auth::user()->location->id)
		->get();
		$total = Report::getTotal(Auth::user()->location->id, $startDate, $endDate);
		$startDate = Report::convertYearCtoB(date('d-m-Y',strtotime($startDate)));
		$endDate = Report::convertYearCtoB(date('d-m-Y',strtotime($endDate)));
		return View::make('report/view_table',compact('table','buddhistYear','startDate','endDate','total'));
	}
	public function getAdminReport($startDate=null,$endDate=null){
		$total = array();		
		if(Auth::user()->role_id !=3 )
		{	
			$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
			if($startDate==null || $endDate == null)
			{
				$startDate=date('Y-m-d',strtotime("-1 days"));
				$endDate = $startDate;
			}	
			else{
				$startDate = Report::convertYearBtoC($startDate);
				$endDate = Report::convertYearBtoC($endDate);
			}
			/*$i=0;
			$table = array();		
			foreach(Location::orderBy('khet_id')->get() as $location)
			{
				$table_temp = Report::generateReportRow($location->id,$startDate,$endDate);
				$table = array_add($table,$i,$table_temp);
				$i++;
			}*/
			$startDate= date("Y-m-d", strtotime($startDate));	
			$endDate= date("Y-m-d", strtotime($endDate));	
			$table = ReportSummary::where('found_date','>=',$startDate)
			->where('found_date','<=',$endDate)
			->get();
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
			$startDate = Report::convertYearCtoB(date('d-m-Y',strtotime($startDate)));
			$endDate = Report::convertYearCtoB(date('d-m-Y',strtotime($endDate)));
			$location_id = 0;
			$item_id = 0;
			return View::make('report/view_table_all',compact('table','buddhistYear','startDate','endDate','total','location_id','item_id'));
		}
		else {
			echo "permission denied";
		}
	}
	public function postAdminReport(){
		if(Auth::user()->role_id !=3 )
		{	
			$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
			if(Input::get('startDate')==null || Input::get('endDate') == null)
			{
				$startDate=date('Y-m-d',strtotime("-1 days"));
				$endDate = $startDate;
			}	
			else{
				$startDate = Report::convertYearBtoC(Input::get('startDate'));
				$endDate = Report::convertYearBtoC(Input::get('endDate'));
			}
			/*$i=0;
			$table = array();		
			foreach(Location::orderBy('khet_id')->get() as $location)
			{
				$table_temp = Report::generateReportRow($location->id,$startDate,$endDate);
				$table = array_add($table,$i,$table_temp);
				$i++;
			}*/
			$startDate= date("Y-m-d", strtotime($startDate));	
			$endDate= date("Y-m-d", strtotime($endDate));	
			if(Input::get('khet_id') == 0)
			{
				if(Input::get('method_id') == 0 && Input::get('found_at_id') == 0 && Input::get('category_id') == 0){	
					$table = ReportSummary::where('found_date','>=',$startDate)
					->where('found_date','<=',$endDate)
					->get();
				}
				else if(Input::get('method_id') != 0 && Input::get('found_at_id') != 0 && Input::get('category_id') != 0){
					$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
							->where('method', '=', Input::get('method_id')) 
							->where('found_at_id', '=', Input::get('found_at_id'))
							->get();	
				}
				else if(Input::get('method_id') == 0 && Input::get('found_at_id') != 0 && Input::get('category_id') != 0){
					$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
							->where('found_at_id', '=', Input::get('found_at_id'))
							->get();		
				}
				else if(Input::get('method_id') == 0 && Input::get('found_at_id') == 0 && Input::get('category_id') != 0){
					$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)->get();	
				}
				else if(Input::get('method_id') != 0 && Input::get('found_at_id') == 0 && Input::get('category_id') != 0){
					$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
							->where('method', '=', Input::get('method_id')) 
							->get();	
				}
				else if(Input::get('method_id') != 0 && Input::get('found_at_id') != 0 && Input::get('category_id') == 0){
					$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
					->where('found_date','<=',$endDate)
					->where('method','=',Input::get('method_id'))
					->where('found_at_id','=',Input::get('found_at_id'))
					->get();
				}
				else if(Input::get('method_id') == 0 && Input::get('found_at_id') != 0 && Input::get('category_id') == 0){	
					$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
					->where('found_date','<=',$endDate)
					->where('found_at_id','=',Input::get('found_at_id'))
					->get();
				}
				else if(Input::get('method_id') != 0 && Input::get('found_at_id') == 0 && Input::get('category_id') == 0){			
					$table = ReportSummary::where('found_date','>=',$startDate)
					->where('found_date','<=',$endDate)
					->where('method','=',Input::get('method_id'))	
					->get();
				}
				
			}
			else{
				if(Input::get('location_id') == 0)
				{
					if(Input::get('method_id') == 0 && Input::get('found_at_id') == 0 && Input::get('category_id') == 0){		
						$table = ReportSummary::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',Input::get('khet_id'))
						->get();
					}	
					else if(Input::get('method_id') == 0 && Input::get('found_at_id') == 0 && Input::get('category_id') != 0){
						$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
						    ->where('khet_id','=',Input::get('khet_id'))
							->get();	
					}	
					else if(Input::get('method_id') == 0 && Input::get('found_at_id') != 0 && Input::get('category_id') == 0){	
						$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',Input::get('khet_id'))
						->where('found_at_id','=',Input::get('found_at_id'))
						->get();
					}
					else if(Input::get('method_id') == 0 && Input::get('found_at_id') != 0 && Input::get('category_id') != 0){
						$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
							->where('found_at_id','=',Input::get('found_at_id'))
							->where('khet_id','=',Input::get('khet_id'))
							->get();	
					}
					else if(Input::get('method_id') != 0 && Input::get('found_at_id') == 0 && Input::get('category_id') == 0){	
						$table = ReportSummary::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',Input::get('khet_id'))
						->where('method','=',Input::get('method_id'))
						->get();
					}
					else if(Input::get('method_id') != 0 && Input::get('found_at_id') == 0 && Input::get('category_id') != 0){
						$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
							->where('method', '=', Input::get('method_id')) 
							->where('khet_id','=',Input::get('khet_id'))
							->get();		
					}
					else if(Input::get('method_id') != 0 && Input::get('found_at_id') != 0 && Input::get('category_id') == 0){	
						$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',Input::get('khet_id'))
						->where('method','=',Input::get('method_id'))
						->get();
					}
					else if(Input::get('method_id') != 0 && Input::get('found_at_id') != 0 && Input::get('category_id') != 0){
						$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
							->where('method', '=', Input::get('method_id')) 
							->where('found_at_id','=',Input::get('found_at_id'))
							->where('khet_id','=',Input::get('khet_id'))
							->get();	
					}
				}
				else{
					if(Input::get('method_id') == 0 && Input::get('found_at_id') == 0 && Input::get('category_id') == 0){		
						$table = ReportSummary::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('location_id','=',Input::get('location_id'))
						->get();
					}	
					else if(Input::get('method_id') == 0 && Input::get('found_at_id') == 0 && Input::get('category_id') != 0){
						$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
							->where('location_id','=',Input::get('location_id'))
							->get();	
					}	
					else if(Input::get('method_id') == 0 && Input::get('found_at_id') != 0 && Input::get('category_id') == 0){	
						$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',Input::get('khet_id'))
						->where('found_at_id','=',Input::get('found_at_id'))
						->where('location_id','=',Input::get('location_id'))
						->get();
					}
					else if(Input::get('method_id') == 0 && Input::get('found_at_id') != 0 && Input::get('category_id') != 0){
						$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
							->where('found_at_id','=',Input::get('found_at_id'))
							->where('location_id','=',Input::get('location_id'))
							->get();	
					}
					else if(Input::get('method_id') != 0 && Input::get('found_at_id') == 0 && Input::get('category_id') == 0){	
						$table = ReportSummary::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',Input::get('khet_id'))
						->where('method','=',Input::get('method_id'))
						->where('location_id','=',Input::get('location_id'))
						->get();
					}
					else if(Input::get('method_id') != 0 && Input::get('found_at_id') == 0 && Input::get('category_id') != 0){
						$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
							->where('method', '=', Input::get('method_id')) 
							->where('location_id','=',Input::get('location_id'))
							->get();	
					}
					else if(Input::get('method_id') != 0 && Input::get('found_at_id') != 0 && Input::get('category_id') == 0){	
						$table = ReportSummaryByFoundAt::where('found_date','>=',$startDate)
						->where('found_date','<=',$endDate)
						->where('khet_id','=',Input::get('khet_id'))
						->where('method','=',Input::get('method_id'))
						->where('location_id','=',Input::get('location_id'))
						->get();
					}
					else if(Input::get('method_id') != 0 && Input::get('found_at_id') != 0 && Input::get('category_id') != 0){
						$table = ReportSummaryByFoundAt::reportByCategory(Input::get('category_id'),$startDate,$endDate)
							->where('method', '=', Input::get('method_id')) 
							->where('found_at_id','=',Input::get('found_at_id'))
							->where('location_id','=',Input::get('location_id'))
							->get();	
					}
				
					
				}
				
			}
			
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
		    $category_id = Input::get('category_id');
			$item_id = Input::get('item_id');
			if(Input::get('item_id') == null)
			{
				$item_id = 0;
			}
			
			$khet_id = Input::get('khet_id');
			$location_id = Input::get('location_id');
			if(Input::get('khet_id') == 0)
			{
				$location_id = 0;
			}
			$method_id = Input::get('method_id');
			$found_at_id = Input::get('found_at_id');
			$startDate = Report::convertYearCtoB(date('d-m-Y',strtotime($startDate)));
			$endDate = Report::convertYearCtoB(date('d-m-Y',strtotime($endDate)));
			return View::make('report/view_table_all',compact('table','buddhistYear','startDate','endDate','total','khet_id','location_id','method_id','found_at_id','category_id','item_id'));
		}
		else {
			echo "permission denied";
		}
	}

	
	
}
?>