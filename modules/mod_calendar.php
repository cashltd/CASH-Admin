<?PHP

	class calendar {
		
			const folder = "calendar/";
		
		public function calendar_dayView($day, $month, $year, $user) {
			GLOBAL $page;
			
				$page->addHtml("<div class='calendar_hour'>08:00</div>");
				$page->addHtml("<div class='calendar_hour'>09:00</div>");
				$page->addHtml("<div class='calendar_hour'>10:00</div>");
				$page->addHtml("<div class='calendar_hour'>11:00</div>");
				$page->addHtml("<div class='calendar_hour'>12:00</div>");
				$page->addHtml("<div class='calendar_hour'>13:00</div>");
				$page->addHtml("<div class='calendar_hour'>14:00</div>");
				$page->addHtml("<div class='calendar_hour'>15:00</div>");
				$page->addHtml("<div class='calendar_hour'>16:00</div>");
				$page->addHtml("<div class='calendar_hour'>17:00</div>");
				$page->addHtml("<div class='calendar_hour'>18:00</div>");
				$page->addHtml("<div class='calendar_hour'>19:00</div>");
				$page->addHtml("<div class='calendar_hour'>20:00</div>");
				$page->addHtml("<div class='calendar_hour'>21:00</div>");
			
			
		}
		
		
		public function ajax_calendarView() {
			GLOBAL $page;
			
			
			calendar::calendar_dayView(10,11,10);
			
			
			
		}
		
		
		
		public function options() {
			GLOBAL $page;
				$page->addPage(self::folder . "view.tpl");
		}
			
	}

?>