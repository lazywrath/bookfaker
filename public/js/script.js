// declare a module
var bookfaker = angular.module('bookfaker', []);

var BASE_URL = "/bookfaker/public";

bookfaker.factory('coupon', function($http){
    var bets = [];
    var _this = {
        addBet : function(match, team){
            match.team = team;
            bets.push({
                match :match,
                team : team
            });
        },
        getBets : function(){
            return bets;
        },
        calculGains : function(){
            var gains = 0;
            if(undefined === bets || bets.length == 0 || undefined === bets.stacke || 0 == bets.stacke)
                return 0;
            
            var stacke = parseInt(bets.stacke);
            var odds;
            
            if(0 == bets.type){ // Paris simples
                angular.forEach(bets, function(bet, key){
                    odds = _this.getOdds(bet);
                    gains += stacke*odds;
                });
            }else if(1 == bets.type){ // Paris combinés
                
                angular.forEach(bets, function(bet, key){
                    if(undefined === odds || 0 == odds)
                        odds = _this.getOdds(bet);
                    else
                        odds *= _this.getOdds(bet);
                });
                
                gains = odds*stacke;
            }
        
            return gains
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
            bets.splice(index,1);
        },
        saveBets : function(){
            var url = BASE_URL+'/backend/api/save-bets';
            
            $http.post(url, bets);
        }
    };
    
    return _this;
})