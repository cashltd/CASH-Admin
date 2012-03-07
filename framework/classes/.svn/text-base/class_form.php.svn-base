<?php

		class form {

			private $formContent;
			private $formName;

			public function __construct($name, $action, $method) {
				$this->formName = $name;
				$this->formContent = "\n".'<form name="' . $name . '" action="' . $action . '" method="' . $method . '">'."\n";
			}

			public function addField($type, $options) {
				if (method_exists($type, 'returnForm'))
					$this->formContent .= call_user_func(Array($type, 'returnForm'), $options);
			}

			public function addSubmitReset($submitValue) {
				$this->formContent .= "\t".'<input type="submit" name="'. $this->formName .'_submit" value="'. $submitValue .'">'."\n";
			}

			public function render() {
				$this->formContent .= '</form>'."\n";
				return $this->formContent;
			}


		}



?>