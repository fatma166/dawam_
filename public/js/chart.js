$(document).ready(function() {

   // var data_line_chart;

		getUrl=window.location;
	var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

	line_chart_url=baseUrl+"/line-chart";
	// Line Chart
		$.ajax({

		url:line_chart_url,

		}).done(function(data) {

            //data_line_chart=data;

			//console.log(data);
			
        	Morris.Line({
        		element: 'line-charts',
        		data:data,
        		xkey: 'day',
        		ykeys: ['present', 'absent','late_comers','early_leave'],
        		labels: ['present', 'absent','late_comers','early_leave'],
        		lineColors: ['#1DB9C3','#7027A0','#C32BAD','#F56FAD'],
        		lineWidth: '3px',
        		resize: true,
        		redraw: true,
                parseTime: false
        	});
      });
		
		
});
;