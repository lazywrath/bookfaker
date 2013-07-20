function indexCtrl($scope, $http){
    $scope.odds = [];
    $scope.isDataLoaded = false;
    $scope.test = "false";
    
    
    $scope.init = function(){
//        var url = 'http://feeds.lafermeduweb.net/LaFermeDuWeb';
        var url = BASE_URL+'/backend/api/matches';
        
        // On récupère la liste des matchs avec leur cotes
        $http.get(url).success(function(data){
            
            $scope.odds = data.odds;
            
        }).then(function(){
            $scope.isDataLoaded = true;
        });
    }
    
    $scope.init();
}