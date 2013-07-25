// declare a module
var bookfaker = angular.module('bookfaker', []);

var BASE_URL = "/bookfaker/public";

bookfaker.factory('coupon', function($http){
    var coupon = {bets:[]};
    var _this = {
        addBet : function(match, team){
            coupon.bets.push({
                match :match,
                team : team
            });
            
            _this.setSessionBets();
        },
        getBets : function(){
            return coupon;
        },
        loadSessionBets : function(){
            
            var url = BASE_URL+'/frontend/bet/get-session';
            
            return $http.get(url).success(function(data){
                
                if(null != data.bets)
                    coupon = angular.fromJson(data.bets);
                
                if(undefined == coupon.type){
                    coupon.type = 0;
                }
                    
            });
        },
        setSessionBets : function(){
            
            var url = BASE_URL+'/frontend/bet/set-session';
            $http.post(url, coupon);
        },
        clearSessionBets : function(){
            
            var url = BASE_URL+'/frontend/bet/clear-session';
            
            $http.get(url);
            coupon.bets = [];
        },
        calculGains : function(){
            var gains = 0;
            if(undefined === coupon.bets || null === coupon.bets|| coupon.bets.length == 0 || undefined === coupon.stacke || 0 == coupon.stacke)
                return 0;
            
            var stacke = parseInt(coupon.stacke);
            var odds;
            
            if(0 == coupon.type){ // Paris simples
                angular.forEach(coupon.bets, function(bet, key){
                    odds = _this.getOdds(bet);
                    gains += stacke*odds;
                });
            }else if(1 == coupon.type){ // Paris combinés
                
                angular.forEach(coupon.bets, function(bet, key){
                    if(undefined === odds || 0 == odds)
                        odds = _this.getOdds(bet);
                    else
                        odds *= _this.getOdds(bet);
                });
                
                gains = odds*stacke;
            }
            

            return Math.floor(gains);
        },
        getOdds: function(bet){
            
            var odds = 0;

            if(1 == bet.team)
                odds = bet.match.oddsTeamOne;
            else if(2 == bet.team)
                odds = bet.match.oddsTeamTwo;
            else if(0 == bet.team)
                odds = bet.match.oddsDraw;

            return odds;
        },
        removeBet : function(index){
            coupon.bets.splice(index,1);
            
            _this.setSessionBets();
        },
        saveBets : function(){
            var url = BASE_URL+'/frontend/bet/save-bets';
            
            return $http.post(url, coupon).success(function(data){
                if(1 == data.state)
                    _this.clearSessionBets();
            });
        }
    };
    
    return _this;
});

bookfaker.filter('truncate', function () {
        return function (text, length, end) {
            
            if (isNaN(length))
                length = 10;
 
            if (end === undefined)
                end = "...";
 
            if (text.length <= length || text.length - end.length <= length) {
                return text;
            }
            else {
                return String(text).substring(0, length-end.length) + end;
            }
 
        };
    });