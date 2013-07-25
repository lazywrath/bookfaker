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

function sportCtrl($scope, $http, coupon){
    $scope.oddsByChampionship = [];
    $scope.isDataLoaded = false;
    $scope.bets = [];
    $scope.isChampionship = false;
    
    $scope.init = function(sport, championship){
        var url = BASE_URL+'/backend/api/get-sport-odds';
        
        if(championship){
            url += '?championship='+championship;
            $scope.isChampionship = true;
        }else if(sport){
            url += '?sport='+sport;
        }
        
        // On récupère la liste des matchs avec leur cotes
        $http.get(url).success(function(data){
            
            $scope.oddsByChampionship = data.odds;
            
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
            else if(1==data.state){
                $scope.isLogged = true;
                $scope.isSaved = true;
            }
        });
    }
    
    $scope.getOdds =  function(bet){
        
        return coupon.getOdds(bet);
    }
    
    $scope.loadBestUsers = function(duree){
         var url = BASE_URL+'/backend/api/classement?duree'+duree;
        
        // On récupère la liste des matchs avec leur cotes
        $http.get(url).success(function(data){
            
            $scope.bestUsers = data;
            
        });
    }
    
    $scope.calculCote = function(){
        
        if(undefined == $scope.coupon)
            return;
        
        var cote = 1;
        
        angular.forEach($scope.coupon.bets, function(bet, key){
            cote *= coupon.getOdds(bet);
        })
        
        return Math.floor(cote);
        
    }
    
     // On récupère les paris en session s'ils existent
    coupon.loadSessionBets().then(function(){
        $scope.coupon = coupon.getBets();
    });
    
    $scope.saveSessionCoupon = function(couponType){
        coupon.setSessionBets();
        $scope.coupon.type = couponType;
    }
}