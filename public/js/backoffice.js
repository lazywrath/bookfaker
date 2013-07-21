$('.closemodal').live("click", function(){ 
    $('.modal').addClass('fade');
});

$('#crawl').live("click", function(){ 
    $('.modal .modal-body').html('L\'outil est en train de vérifier si de nouveaux matchs existent. Veuillez attendre que l\'opération soit finis, la popup se fermera d\'elle même');
    $('.modal').removeClass('fade');
    $.ajax({
        url: "../api/",
        type: "POST",
        data:
        {
        },
        success: function(data)
        {
            $('.modal').addClass('fade');
           $('#content').html(data);
        },
        error: function(data)
        { 
            $('.modal .modal-body').html( 'Une erreur est survenue lors du chargement, merci de réessayer'+data );
           $('.modal').removeClass('fade');
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
           $('.modal .modal-body').html('Vous venez de rentrer comme équipe vainqueur :'+data);
           $('.modal').removeClass('fade');
        },
        error: function(data)
        {
            $('.modal .modal-body').html( 'Une erreur est survenue lors du chargement, merci de réessayer'+data );
           $('.modal').removeClass('fade');
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
           $('.modal .modal-body').html('Vous venez de rentrer comme équipe vainqueur :'+data);
           $('.modal').removeClass('fade');
        },
        error: function(data)
        {
            $('.modal .modal-body').html( 'Une erreur est survenue lors du chargement, merci de réessayer'+data );
           $('.modal').removeClass('fade');
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
        $('.modal .modal-body').html('Vous venez de rentrer un match nul.');
           $('.modal').removeClass('fade');
        },
        error: function(data)
        {
            Popup.show( 'Une erreur est survenue lors du chargement, merci de réessayer'+data );
        }
    });
});


