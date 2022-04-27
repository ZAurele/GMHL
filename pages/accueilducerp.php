<h2><p style="text-align:center"> Bienvenue sur le CERP, l’outil Collaboratif d'Évaluation du Risque de Prédation ! 
</p></h2>

<p style="text-align:center">
Le <b>CERP</b> est un outil de diagnostic du risque d'exposition d'une exploitation et/ou de parcelles. <u>Entièrement gratuit</u> et anonymisé 
sa vocation est d’identifier les forces et les différents axes d’améliorations de votre exploitation ou de vos parcelles exposées à un risque de prédation 
par les Mammifères prédateurs, en particulier le Loup gris <i>Canis lupus</i>. Il vous donne la possibilité de vous autoévaluer gratuitement, et de comparer vos résultats à vos résultats antérieurs ou avec ceux d’autres éleveurs.
</p>
<p style="text-align:center"> Le CERP a été construit par 7 structures principales <i>(appelées aussi "Membres fondateurs")</i> en partenariat avec de nombreux acteurs issus du monde agricole, 
de la recherche scientifique en écologie et en sciences sociales. Il s'appuie en effet sur les connaissances d'expert-es et d'éleveur-euses Limousin-es, Français-es, Européen-nes et parfois même au-delà ! 
La méthode scientifique pour la mise en place et l'amélioration du CERP a d'ailleurs bénéficié d'un <i> avis favorable du Conseil Scientifique national en charge du Plan National d'Actions sur le loup et les activités d'élevage en 2021</i>. 
</p>
<p style="text-align:center">
 Dans une optique de constante amélioration, le questionnaire technique du CERP est précédé d’une enquête sociale 
 permettant de mieux adapter l'outil à votre contexte et à votre situation. L’évaluation du CERP est accessible exclusivement aux membres possédant des identifiants délivrés à la demande par les 
 membres fondateurs. 
</p>
<p>
</p>
<h3><p style="text-align:center"> Vous engager </h3>
 Il existe plusieurs façon de s'engager dans ce travail : 
 <li>Vous êtes <b>éleveur-euse</b> ?  Vous pouvez évaluer la situation de votre exploitation ou de vos parcelles et partager le CERP autour de vous ! </li>
 <li> Vous êtes <b>citoyen-ne</b> ? Vous pouvez relayer ce travail autour de vous et mobiliser les structures professionnelles et/ou éleveur-euses sur votre territoire ! </li> 
 <li> Vous êtes <b>professionnel-le en écologie, agriculture ou sciences sociales</b> ? Vous pouvez devenir un partenaire relais sur le terrain, être formé à l'enquête et diffuser le CERP autour de vous aussi !  </li> 
</p><p style="text-align:justify"> 
Le CERP est évolutif, il doit être testé et critiqué pour être amélioré. 
Ce sont les utilisations répétées et les retours de ses utilisateur-ices 
qui vont permettre à terme de proposer des schémas d'aide à la décision personnalisés et cohérents avec les souhaits, les possibilités de chacun-e et 
le cadre réglementaire en vigueur. 
Pour évoluer, gagner en accessibilité et en fluidité sur le territoire, le CERP a besoin de partenaires sérieux et prêts à s’engager à nos côtés. 

Vous êtes motivé-e pour essayer et/ou diffuser le CERP ? Contactez-nous à info@projetcerp.com ! 
</p>

 <h3><p style="text-align:center">Comment utiliser le CERP ?</p> </h3>
<p style="text-align:justify"> Pour utiliser le CERP, <b>vous devez d'abord prendre contact avec l'une des structures proches de vous géographiquement </b> (voir "Membres fondateurs" et "Partenaires techniques"). 
Vous serez alors dirigé-e vers un relais local qui vous expliquera le fonctionnement du CERP et vous délivrera un mot de passe et un identifiant pour vous connecter à votre compte utilisateur. 
</p>

<h3><p style="text-align:center"> Que deviennent mes données ? </h3></p><p style="text-align:justify"> 
Les réponses aux questions du CERP sont sauvegardées sur votre compte utilisateur. Elles sont totalement anonymisées et envoyées à Ugo Arbieu de l'Institut Senckenberg pour être analysées dans une optique d'amélioration du CERP afin, à terme, de proposer des schémas d’aide à la décision les plus pertinents et personnalisés possibles.
Les opérateurs sur le terrain n'ont pas accès à vos données à moins que vous décidiez de leur réveler vos réponses. 
Sur le site, vous êtes automatiquement connu-e sous un pseudo délivré de façon aléatoire. Vous seul-e pouvez choisir de lever ou non votre anonymat. 
De cette façon, <b>nous garantissons la protection totale de vos données, de votre identité et de votre vie privée</b>. 
</p>

<p style="text-align:center">
N'hésitez pas à faire remonter vos questions et vos retours d'expériences à <a href="mailto:info@projetcerp.com" title="info@projetcerp.com" style="color:#17202A"> info@projetcerp.com </a></p>

<div class="home-block" style="border: orange2px solid;">
    <a href="?page=login"/><p style="text-align:center">Se connecter</p></a>
</div>

<?php if($logged):?>
<div class="home-blocks">
    <?php 
        foreach($QUESTIONS as $category => $cat_cf) {
            if (isset($cat_cf["disabled"]) && $cat_cf["disabled"]) continue;
    ?>
    <div class="home-block" style="border: <?=$cat_cf["b-color"]?> 4px solid;">
        <a href="?page=results&category=<?=$category?>" style="color:<?=$cat_cf["b-color"]?>">
            <span style="color:<?=$cat_cf['color']?> !important" class="icon fa-<?=$cat_cf['icon']?>"></span> 
        <?=$cat_cf['text']?></a>
    </div>
    <?php } ?>
</div>
<?php endif;?>

<?php include 'pages/messages.php';?>


