/*jslint  browser: true, white: true, plusplus: true */
/*global $: true */
///I NEED TO CHANGE FUNCTION IN FOCUS FUNCTION IN ORDER TO FORCEFULLY GET PURCHASER ID
//////////*************************/////////
//$(function () {
	
	
	$('#autocomplete-ajax').focus(function() {
		'use strict';
  		 var pID = $("#tender_purchaser").val();
		 //alert(pID);
		 //var pID=19;

   // Load countries then initialize plugin:
   shan(pID);
//alert(pID);
});
function shan(pID)
{
 $.ajax({
        
        url: 'shaan.php?pID='+pID,

        dataType: 'json',
		success : function(response){
			
		alert('g');
		
		
		},
		
    }).done(function (source) {

        
		var countriesArray = $.map(source, function (value, key) { return { value: value, data: key }; }),
            countries = $.map(source, function (value) { return value; });

        // Setup jQuery ajax mock:
        $.mockjax({
            url: '*',
            responseTime:  200,
            response: function (settings) {
                var query = settings.data.query,
                    queryLowerCase = query.toLowerCase(),
                    suggestions = $.grep(countries, function(country) {
                         return country.toLowerCase().indexOf(queryLowerCase) !== -1;
                    }),
                    response = {
                        query: query,
                        suggestions: suggestions
                    };

                this.responseText = JSON.stringify(response);
            }
        });

        // Initialize ajax autocomplete:
        $('#autocomplete-ajax').autocomplete({
			
            serviceUrl: '/autosuggest/service/url',
            onSelect: function(suggestion) {
				
				
                $('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
            }
        });

        
        
        
    });
}

	