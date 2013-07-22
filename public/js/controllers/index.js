function indexCtrl($scope, $http, coupon){
    $scope.odds = [];
    $scope.isDataLoaded = false;
    $scope.bets = [];
    
    $scope.init = function(sport, championship){
        var url = BASE_URL+'/backend/api/get-odds';
        
        if(championship){
            url += '?championship='+championship;
        }else if(sport){
            url += '?sport='+sport;
        }
        
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
}

function menuCtrl($scope, $http, coupon){

    $scope.isLogged = true;
    
    $scope.calculGains = function(){
        return coupon.calculGains();
    }
    
    $scope.removeBet = function(index){
        return coupon.removeBet(index);
    }
    
    $scope.saveBets = function(){
        return coupon.saveBets().success(function(data){
            if(0==data.state)
                $scope.isLogged = false;
            else if(1==data.state)
                $scope.isLogged = true;
        });
    }
    
     // On récupère les paris en session s'ils existent
    coupon.loadSessionBets().then(function(){
        $scope.coupon = coupon.getBets();
    });
    
    $scope.saveSessionCoupon = function(){
        coupon.setSessionBets();
    }
}