$('#crawl').live("click", function(){ 
    $.ajax({
        url: "../api/",
        type: "POST",
        data:
        {
        },
        success: function(data)
        {
           $('#content').html(data);
        },
        error: function(data)
        {
            Popup.show( 'Une erreur est survenue lors du chargement, merci de réessayer'+data );
        }
    });
});

$('.ReslutatTeamOne').live("click", function(){ 
    idMatch = $(this).attr('matchid');
    
    $.ajax({
        url: "../api/match/",
        type: "POST",
        data:
        {
            'idmatch' : idMatch,
            'resultat' : 'teamOne'
        },
        success: function(data)
        {
           $('#content').html(data);
        },
        error: function(data)
        {
            Popup.show( 'Une erreur est survenue lors du chargement, merci de réessayer'+data );
        }
    });
});

$('.ReslutatTeamTwo').live("click", function(){ 
    idMatch = $(this).attr('matchid');
    
    $.ajax({
        url: "../api/match/",
        type: "POST",
        data:
        {
            'idmatch' : idMatch,
            'resultat' : 'teamTwo'
        },
        success: function(data)
        {
           $('#content').html(data);
        },
        error: function(data)
        {
            Popup.show( 'Une erreur est survenue lors du chargement, merci de réessayer'+data );
        }
    });
});

$('.ReslutatDraw').live("click", function(){ 
    idMatch = $(this).attr('matchid');
    
    $.ajax({
        url: "../api/match/",
        type: "POST",
        data:
        {
            'idmatch' : idMatch,
            'resultat' : 'draw'
        },
        success: function(data)
        {
           $('#content').html(data);
        },
        error: function(data)
        {
            Popup.show( 'Une erreur est survenue lors du chargement, merci de réessayer'+data );
        }
    });
});


