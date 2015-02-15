app.controller('dashboardCtrl',['$scope','$timeout','ngProgress', 'Filters','$activityIndicator',function($scope,$timeout,ngProgress,Filters,$activityIndicator){

	ngProgress.color('#FFD3D3');

	ngProgress.start();
	$activityIndicator.startAnimating();

	$scope.showMe =3;
	$scope.filters 	={};
	$scope.filters.programs 	={};

	$scope.filters.programs.selected = function(){
		return Filters.programs.selected;
	};

	$timeout(function () {
		$activityIndicator.stopAnimating()
		ngProgress.complete()
	}, 300);

}])
