<?php

class ReportSummaryByFoundAt extends Eloquent {
	public $timestamps = false;
	protected $table = 'summary_by_found_at';
	public static function reportByCategory($categoryId, $startDate, $endDate) {
		if ($categoryId == 1) {
			$temp = ReportSummaryByFoundAt::where('found_date', '>=', $startDate) -> where('found_date', '<=', $endDate) -> where(function($query) {
				$query -> where('p', '>', 0) -> orwhere('r', '>', 0);
			});
		} else if ($categoryId == 2) {
			$temp = ReportSummaryByFoundAt::where('found_date', '>=', $startDate) -> where('found_date', '<=', $endDate) -> where(function($query) {
				$query -> where('a', '>', 0) -> orwhere('b', '>', 0) -> orwhere('c', '>', 0) -> orwhere('d', '>', 0) -> orwhere('e', '>', 0) -> orwhere('f', '>', 0);
			});
		}
		return $temp;

	}

}
?>