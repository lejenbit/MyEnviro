<div class="content-header">
<h4>Jenis Industri</h4><small> Sumber : doe.gov.my </small> 
</div>
<br>


<div id="container" style="width:100%; height:400px;"></div>
<div id="containerdd" ></div>



<script>

   $(document).ready(function() {
                var options = {
	            chart: {
	                renderTo: 'container',
	                type: 'column',

	            },

	            title: {
	                text: '<b>Jumlah dan Jenis Industri Mengikut Daerah</b>',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Sumber:doe.gov.my',
	                x: -20
	            },
	            xAxis: {
	                categories: []
	            },
//                    plotOptions: {
//                        column: {
//                        grouping: false}
//                    },
	            yAxis: {
                        allowDecimals: false,
	                title: {
	                    text: 'Total'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b> '+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },

	            series: []
	        }

	        $.getJSON("<?=base_url('index.php/home/return_industry_by_cat')?>", function(json) {
			options.xAxis.categories = json[0]['data'];
	        	options.series[0] = json[1];
	        	options.series[1] = json[2];
                options.series[2] = json[3];
                options.series[3] = json[4];
                chart = new Highcharts.Chart(options);

                console.log(chart);
	        });
        });


    $( document ).ready(function() {

         


    // Create the chart
// Highcharts.chart('containerdd', {
//     chart: {
//         type: 'column'
//     },
//     title: {
//         text: 'Browser market shares. January, 2018'
//     },
//     subtitle: {
//         text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
//     },
//     xAxis: {
//         type: 'category'
//     },
//     yAxis: {
//         title: {
//             text: 'Total percent market share'
//         }

//     },
//     legend: {
//         enabled: false
//     },
//     plotOptions: {
//         series: {
//             borderWidth: 0,
//             dataLabels: {
//                 enabled: true,
//                 format: '{point.y:.1f}%'
//             }
//         }
//     },

//     tooltip: {
//         headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
//         pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
//     },

//     series: [
//         {
//             name: "Browsers",
//             colorByPoint: true,
//             data: [
//                 {
//                     name: "Chrome",
//                     y: 62.74,
//                     drilldown: "Chrome"
//                 },
//                 {
//                     name: "Firefox",
//                     y: 10.57,
//                     drilldown: "Firefox"
//                 },
//                 {
//                     name: "Internet Explorer",
//                     y: 7.23,
//                     drilldown: "Internet Explorer"
//                 },
//                 {
//                     name: "Safari",
//                     y: 5.58,
//                     drilldown: "Safari"
//                 },
//                 {
//                     name: "Edge",
//                     y: 4.02,
//                     drilldown: "Edge"
//                 },
//                 {
//                     name: "Opera",
//                     y: 1.92,
//                     drilldown: "Opera"
//                 },
//                 {
//                     name: "Other",
//                     y: 7.62,
//                     drilldown: null
//                 }
//             ]
//         }
//     ],
//     drilldown: {
//         series: [
//             {
//                 name: "Chrome",
//                 id: "Chrome",
//                 data: [
//                     [
//                         "v65.0",
//                         0.1
//                     ],
//                     [
//                         "v64.0",
//                         1.3
//                     ],
//                     [
//                         "v63.0",
//                         53.02
//                     ],
//                     [
//                         "v62.0",
//                         1.4
//                     ],
//                     [
//                         "v61.0",
//                         0.88
//                     ],
//                     [
//                         "v60.0",
//                         0.56
//                     ],
//                     [
//                         "v59.0",
//                         0.45
//                     ],
//                     [
//                         "v58.0",
//                         0.49
//                     ],
//                     [
//                         "v57.0",
//                         0.32
//                     ],
//                     [
//                         "v56.0",
//                         0.29
//                     ],
//                     [
//                         "v55.0",
//                         0.79
//                     ],
//                     [
//                         "v54.0",
//                         0.18
//                     ],
//                     [
//                         "v51.0",
//                         0.13
//                     ],
//                     [
//                         "v49.0",
//                         2.16
//                     ],
//                     [
//                         "v48.0",
//                         0.13
//                     ],
//                     [
//                         "v47.0",
//                         0.11
//                     ],
//                     [
//                         "v43.0",
//                         0.17
//                     ],
//                     [
//                         "v29.0",
//                         0.26
//                     ]
//                 ]
//             },
//             {
//                 name: "Firefox",
//                 id: "Firefox",
//                 data: [
//                     [
//                         "v58.0",
//                         1.02
//                     ],
//                     [
//                         "v57.0",
//                         7.36
//                     ],
//                     [
//                         "v56.0",
//                         0.35
//                     ],
//                     [
//                         "v55.0",
//                         0.11
//                     ],
//                     [
//                         "v54.0",
//                         0.1
//                     ],
//                     [
//                         "v52.0",
//                         0.95
//                     ],
//                     [
//                         "v51.0",
//                         0.15
//                     ],
//                     [
//                         "v50.0",
//                         0.1
//                     ],
//                     [
//                         "v48.0",
//                         0.31
//                     ],
//                     [
//                         "v47.0",
//                         0.12
//                     ]
//                 ]
//             },
//             {
//                 name: "Internet Explorer",
//                 id: "Internet Explorer",
//                 data: [
//                     [
//                         "v11.0",
//                         6.2
//                     ],
//                     [
//                         "v10.0",
//                         0.29
//                     ],
//                     [
//                         "v9.0",
//                         0.27
//                     ],
//                     [
//                         "v8.0",
//                         0.47
//                     ]
//                 ]
//             },
//             {
//                 name: "Safari",
//                 id: "Safari",
//                 data: [
//                     [
//                         "v11.0",
//                         3.39
//                     ],
//                     [
//                         "v10.1",
//                         0.96
//                     ],
//                     [
//                         "v10.0",
//                         0.36
//                     ],
//                     [
//                         "v9.1",
//                         0.54
//                     ],
//                     [
//                         "v9.0",
//                         0.13
//                     ],
//                     [
//                         "v5.1",
//                         0.2
//                     ]
//                 ]
//             },
//             {
//                 name: "Edge",
//                 id: "Edge",
//                 data: [
//                     [
//                         "v16",
//                         2.6
//                     ],
//                     [
//                         "v15",
//                         0.92
//                     ],
//                     [
//                         "v14",
//                         0.4
//                     ],
//                     [
//                         "v13",
//                         0.1
//                     ]
//                 ]
//             },
//             {
//                 name: "Opera",
//                 id: "Opera",
//                 data: [
//                     [
//                         "v50.0",
//                         0.96
//                     ],
//                     [
//                         "v49.0",
//                         0.82
//                     ],
//                     [
//                         "v12.1",
//                         0.14
//                     ]
//                 ]
//             }
//         ]
//     }
// });
});
    </script>
</html>