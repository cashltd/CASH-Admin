<?php
		class option {

			public function returnForm($options) {
				$optionHTML = "\t".'<select>';

					foreach ($options['values'] AS $kopts => $opts) {
						if ($kopts == $options['selected']) $selected = "SELECTED" ; else $selected = "";
						$optionHTML .= "\n\t\t".'<option '. $selected .' name="'. $kopts .'">'. $opts .'</option>';
					}

				$optionHTML .= "\n\t</select>\n";
				return $optionHTML;
			}

		}
?>