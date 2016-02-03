		var $date_pick_noc = jQuery.noConflict();

$date_pick_noc(document).ready(function() {

    $date_pick_noc('#datepicker-example1_dsib').Zebra_DatePicker();
	$date_pick_noc('#datepicker-example1_nsci').Zebra_DatePicker();
	$date_pick_noc('#datepicker-example1_dgd').Zebra_DatePicker();
	$date_pick_noc('#datepicker-example1_dgq').Zebra_DatePicker();

    $date_pick_noc('#datepicker-example2').Zebra_DatePicker({
        direction: 1    // boolean true would've made the date picker future only
                        // but starting from today, rather than tomorrow
    });

    $date_pick_noc('#datepicker-example3').Zebra_DatePicker({
        direction: true,
        disabled_dates: ['* * * 0,6']   // all days, all monts, all years as long
                                        // as the weekday is 0 or 6 (Sunday or Saturday)
    });

    $date_pick_noc('#datepicker-example4').Zebra_DatePicker({
        direction: [1, 10]
    });

    $date_pick_noc('#datepicker-example5').Zebra_DatePicker({
        // remember that the way you write down dates
        // depends on the value of the "format" property!
        direction: ['2012-08-01', '2012-08-12']
    });

    $date_pick_noc('#datepicker-example6').Zebra_DatePicker({
        // remember that the way you write down dates
        // depends on the value of the "format" property!
        direction: ['2012-08-01', false]
    });

    $date_pick_noc('#datepicker-example7-end').Zebra_DatePicker({
        direction: 1
    });
    $date_pick_noc('#datepicker-example7-start').Zebra_DatePicker({
        direction: true,
        pair: $date_pick_noc('#datepicker-example7-end')
    });


    $date_pick_noc('#datepicker-example8').Zebra_DatePicker({
        format: 'M d, Y'
    });

    $date_pick_noc('#datepicker-example9').Zebra_DatePicker({
        show_week_number: 'Wk'
    });

    $date_pick_noc('#datepicker-example10').Zebra_DatePicker({
        view: 'years'
    });

    $date_pick_noc('#datepicker-example11').Zebra_DatePicker({
       format: 'Y m'
	      
    });

    $date_pick_noc('#datepicker-example12').Zebra_DatePicker({
        onChange: function(view, elements) {
            if (view == 'days') {
                elements.each(function() {
                    if ($date_pick_noc(this).data('date').match(/\-24$date_pick_noc/))
                        $date_pick_noc(this).css({
                            backgroundColor:    '#C40000',
                            color:              '#FFF'
                        });
                });
            }
        }
    });

    $date_pick_noc('#datepicker-example13').Zebra_DatePicker({
        always_visible: $date_pick_noc('#container')
    });

});