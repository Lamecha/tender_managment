<!--validation-->

<link rel="stylesheet" href="main_css/validation/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="main_css/validation/template.css" type="text/css"/>
	<script src="Xmain_js/validation/jquery-1.7.2.min.js" type="text/javascript">
	</script>
	<script src="main_js/validation/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="main_js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine();
		});

		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	</script>


<!--validation-->