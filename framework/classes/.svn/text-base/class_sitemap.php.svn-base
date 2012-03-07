<?PHP


	class sitemap {

		private $html;

		public function __construct() {

			$this->html = '<?xml version="1.0" encoding="UTF-8"?>';
			$this->html .= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';

		}

		public function addLink($link, $date="now") {

			if ($date == "now") {
				$date = date('Y-m-d', strtotime("now"));
			}


				$this->html .= "<url>";
				$this->html .= "<loc>".$link."</loc>";
				$this->html .= "<lastmod>".$date."</lastmod>";
				$this->html .= "<priority>1</priority>";
				$this->html .= "<changefreq>weekly</changefreq>";
				$this->html .= "</url>";


		}

		public function view() {
			GLOBAL $page;
			$this->html .= "</urlset>";
			$page->addHtml($this->html);
		}


	}


?>