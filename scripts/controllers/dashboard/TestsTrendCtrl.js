app.controller('TestsTrendCtrl',['$scope', '$rootScope', 'Filters', 'Commons','$http',function($scope,$rootScope,Filters,Commons,$http){

	$scope.toggleLoading = function () {
		
		this.testing_trends.loading = !this.testing_trends.loading
		this.tests_vs_errors_pie.loading = !this.tests_vs_errors_pie.loading
		this.yearly_testing_trends.loading = !this.yearly_testing_trends.loading
	}
	//	
	//FILTER. Variables plus watch function
	//
	entity_type = '';
	entity_id = '';
	start_date = '';
	end_date = '';
	 $rootScope.$watch('Filters.change_tst', function(){
        $scope.toggleLoading();
	 	entity_type = $rootScope.Filters.selected.entity.filter_type;//facility,partener..etc
	 	entity_id = $rootScope.Filters.selected.entity.filter_id; 
	 	start_date = $rootScope.Filters.selected.dates.start;
	 	end_date = $rootScope.Filters.selected.dates.end;
	 	
	 	//redraw the charts
	 	$scope.testing_trends_linegraph_series();//yAxis
	 	$scope.testing_trends_linegraph_categories();//xAxis
	 	
	 	$scope.yearly_testing_trends_series();
	 	$scope.critical_table();
	 	$scope.tests_vs_errors_pie_data()

	});





	
	//
	//
	//TESTING TRENDS LAST 4 YEARS
	//
	//
	
	//yAxis data line grpah[4yrs]
	$scope.testing_trends_linegraph_series = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_testing_trends"	,
			{
				params:{
					entityType : entity_type,
					entityId : entity_id,
					startDate : start_date,
					endDate : end_date					
				}
			})
		.success(function(response){
			$scope.testing_trends.series= response;
            $scope.testing_trends.loading = false;
		});	
	}
	$scope.testing_trends_linegraph_series();
	

	//categoreis for line graph xAxis [4yrs]
	$scope.testing_trends_linegraph_categories = function() {
		return $http.get(Commons.baseURL + "api/dashboard/return_testing_trends_categories",{
			params:{
				startDate : start_date,
				endDate : end_date
			}
		})
		.success(function(response) {
			$scope.testing_trends.xAxis.categories = response;
		});
	}
	$scope.testing_trends_linegraph_categories();


 	$scope.testing_trends = {
	  	options: {
            chart: {
                type: 'line',
                width:550,
                height:350,
                borderWidth:'2'                
            }
        },
        title: {
	    	text: 'Testing Trends',
	        x: -20 //center   
        },
        xAxis: {
	        categories: [],
	        labels: {
	            rotation: -45,
	            // step : 3,
	            align: "right"
	        }
	    },
	    yAxis: {
	        gridLineWidth: 2,
	        title: {
	            text: '# Tests'
	        },
	        plotLines: [{
	            value: 0,
	            width: 1,
	            color: '#808080'
	        }]
	    },
        plotOptions: {
	        area: {
	            stacking: 'percentage',
	            lineColor: '#666666',
	            lineWidth: 1,
	            marker: {
	                lineWidth: 0,
	                lineColor: '#666666',
	                radius: 0
	            }                
	        }            
	    },            
	    credits:{
	        enabled:false
	    },
	    tooltip: {
	        shared: true,
	        valueSuffix: ' Tests',
	        crosshairs: [true,false],
	    },
	    series: []  
    }

	//
	//
	//YEAERLY TESTING TRENDS
	//
	//	
	//series yearly testing trends column graph
	$scope.yearly_testing_trends_series = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/return_yearly_testing_trends_categories",
			{
				params:{
					entityType : entity_type,
					entityId : entity_id				
				}
			})
		.success(function(response){
			$scope.yearly_testing_trends.xAxis.categories= response[0];
			$scope.yearly_testing_trends.series = response[1];
            $scope.yearly_testing_trends.loading = false;
		});	
	}
	$scope.yearly_testing_trends_series();
	
	//chart definition
	$scope.yearly_testing_trends = {
		options: {
            chart: {
                type: 'column',
                height:350,
                width:350,
                borderWidth: '2'
            }
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            min: 0,
            title: {
                text: ' # Tests'
            }
        },
        title: {
            text: 'Yearly Testing Trends'
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.x +'</b><br/>'+
                this.series.name +': '+ this.y +'<br/>'+
                'Total: '+ this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black, 0 0 3px black'
                    }
                }
            },
        },
        series: [],
        loading: false
    }

	//
	//
	//Tests vs Errors pie chart
	//
	//
	
	//series data tests_vs_errors_pie
    
    $scope.tests_vs_errors_pie_data = function(){
      return $http.get(
         Commons.baseURL+"api/dashboard/test_errors_pie",{
         	params:{
         		entityType : entity_type,
				entityId : entity_id,
				startDate : start_date,
				endDate : end_date	
         	}	
         })
      .success(function(response){

            $scope.tests_vs_errors_pie.series[0].data[0].y = parseInt(response.errors);
            $scope.tests_vs_errors_pie.series[0].data[1].y = parseInt(response.valid);

            $scope.tests_vs_errors_pie.options.drilldown.series[0].data[1].y = parseInt(response.passed);
            $scope.tests_vs_errors_pie.options.drilldown.series[0].data[2].y = parseInt(response.failed);
            $scope.tests_vs_errors_pie.options.drilldown.series[0].data[0].y = parseInt(response.errors);
            $scope.tests_vs_errors_pie.loading = false;
        });	
  }
  $scope.prepare_tests_vs_errors_pie = function(){

    var data =  $scope.tests_vs_errors_pie_data()
    .success(function(response){
        if(response.total > 0){
            // $scope.tests_vs_errors_pie.series[0].data[0].perc = ((response.errors/response.total)*100).toFixed(2);
            // $scope.tests_vs_errors_pie.series[0].data[1].perc = ((response.valid/response.total)*100).toFixed(2);
        

            // $scope.tests_vs_errors_pie.options.drilldown.series[0].data[0].perc = ((response.passed/(response.failed + response.passed))*100).toFixed(2);
            // $scope.tests_vs_errors_pie.options.drilldown.series[0].data[1].perc = ((response.failed/(response.failed + response.passed))*100).toFixed(2);
           
        }
    });  

}

$scope.prepare_tests_vs_errors_pie();


	//chart definition
	$scope.tests_vs_errors_pie = {
        title: {
            text: 'Testing'
        },
        subtitle: {
            text: 'Tests and Device Errors'
        },
        options: {
            chart: {
                type: 'pie',
                width:350,
                height:250,
                borderWidth:'2'
            },
            drilldown: {
                series: [
                {
                    id: "Tests", 
                    name: "Tests",
                    data: [
                    {
                        name: "Errors", 
                        visible: false,
                        y :0,
                        perc: 0,
                color: Highcharts.Color(Highcharts.getOptions().colors[5]).brighten(-0.2).get()
                    },
                    {
                        name: "Abv 500 CD4", 
                        y :0,
                        perc: 0,
                color: Highcharts.Color(Highcharts.getOptions().colors[2]).brighten(0.2).get()
                    }, 
                    {
                        name: "Bel 500 CD4", 
                        y :0,
                        perc: 0,
                color: Highcharts.Color(Highcharts.getOptions().colors[2]).brighten(-0.2).get()
                    }
                    ]
                }
                ]
            },
            legend: {
                align: 'right',
                // x: -70,
                verticalAlign: 'bottom',
                y: 0,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: true
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}, {point.percentage:.2f}%</b> of total<br/>'
            },           
            credits:{
                enabled:false
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
        },
        series: [
        {
            name: 'Tests VS Errors',
            colorByPoint: true,
            data: [
            {
                drilldown: "Errors",
                name: "Errors",
                visible: true,
                y: 0,
                perc: 0,
                color: Highcharts.getOptions().colors[5]
            },
            {
                drilldown: "Tests",
                name: "Tests",
                visible: true,
                y: 0,
                perc: 0,
                color: Highcharts.getOptions().colors[2]
            }

            ]
        }]
    };
	//
	//
	//Tests table
	//
	//
	$scope.critical_table = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_tests",{
				params:{
					entityType : entity_type,
					entityId : entity_id,
					startDate : start_date,
					endDate : end_date	
				}	
			})
		.success(function(response){
			$scope.table_data = response;
			console.log($scope.table_data);
			
		});	
	}
	$scope.critical_table();
}])
