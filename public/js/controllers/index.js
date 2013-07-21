function indexCtrl($scope, $http, coupon){
    $scope.odds = [];
    $scope.isDataLoaded = false;
    $scope.bets = [];
    
    
    $scope.init = function(){
        var url = BASE_URL+'/backend/api/matches';
        
        // On récupère la liste des matchs avec leur cotes
        $http.get(url).success(function(data){
            
            $scope.odds = data.odds;
            
        }).then(function(){
            $scope.isDataLoaded = true;
        });
        
        $scope.bets = coupon.getBets();
    }
    
    $scope.addBet = function(match, idTeam){
        coupon.addBet(match, idTeam);
    }
    
    $scope.init();
}

function menuCtrl($scope, $http, coupon){

    $scope.bets = coupon.getBets();
    $scope.bets.type = 0;
    
    $scope.calculGains = function(){
        return coupon.calculGains();
    }
    
    $scope.removeBet = function(index){
        return coupon.removeBet(index);
    }
    
    $scope.saveBets = function(){
        return coupon.saveBets();
    }

}