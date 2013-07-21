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
    }
    
    $scope.addBet = function(match, team){
        coupon.addBet(match, team);
    }
    
    $scope.init();
}

function menuCtrl($scope, $http, coupon){

    $scope.calculGains = function(){
        return coupon.calculGains();
    }
    
    $scope.removeBet = function(index){
        return coupon.removeBet(index);
    }
    
    $scope.saveBets = function(){
        return coupon.saveBets();
    }
    
     // On récupère les paris en session s'ils existent
    coupon.loadSessionBets().then(function(){
        $scope.coupon = coupon.getBets();
    });
    
    $scope.saveSessionCoupon = function(){
        coupon.setSessionBets();
    }
}