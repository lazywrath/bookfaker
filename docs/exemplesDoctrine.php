<?php

// On récupère l'entity manager défini dans le Bootstrap
$em = Zend_Registry::get("entityManager");
        
$sport = new Entities\Sport();
$sport->setName("Football");
$em->persist($sport); // On passe l'entité à l'entity manager. Cela n'écrit pas en base
$em->flush(); // On applique les changements. Les INSERT et/ou UPDATE sont effectués à ce moment

$team1 = $em->find("\Application\Model\Entities\Team", 1); // On cherche en base l'équipe qui a l'ID 1
$team2 = $em->find("\Application\Model\Entities\Team", 2);
$ch1 = $em->find("\Application\Model\Entities\Championship", 1);
$ch2 = $em->find("\Application\Model\Entities\Championship", 2);

// Ces deux actions font la même chose parce que Championship et Team ont une relation 0,n-0,n (ManyToMany) en base
// Ajouter une equipe à un championnant ou un championnant à une équipe revient au même
$team1->addChampionship($ch1);
// ou
$ch1->addTeam($team1);

$em->flush();
?>
