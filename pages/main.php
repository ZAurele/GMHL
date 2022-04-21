<h2><p style="text-align:center"> Bienvenue sur le CERP, l’outil Collaboratif pour l’Estimation du Risque de Prédation.
</p></h2>

<p style="text-align:center">
Le <b>CERP</b> est un outil diagnostic <u>entièrement gratuit</u> et anonymisé dont l’objectif est de vous permettre d’identifier les forces et les différents axes d’améliorations de votre exploitation ou de vos parcelles exposées à un risque de prédation, en particulier vis-à-vis du loup. Pour cette raison, le questionnaire technique est précédé d’une enquête d’évaluation permettant de mieux adapter le CERP à votre contexte et votre situation. L’évaluation se base sur plusieurs domaines identifiés comme pouvant avoir une influence sur la prédation : le contexte socio-économique, les pratiques d’élevage, les moyens de protection et enfin, la biologie des prédateurs. 
</p>
<p>
L’outil vous donnera la possibilité de vous autoévaluer et de comparer vos résultats à certains de vos résultats antérieurs ou avec ceux d’autres éleveurs.
</p>
 
<h3><p style="text-align:center"> Que deviennent mes données ? </h3>
Les réponses aux questions du CERP sont sauvegardées sur votre compte utilisateur. Elles sont totalement anonymisées et envoyées à Ugo Arbieu de l'Institut Senckenberg pour être analysées dans une optique d'amélioration du CERP afin, à terme, de proposer des schémas d’aide à la décision les plus pertinents et personnalisés possibles.
</p>


<h3><p style="text-align:center"> Vous engager : </h3>
Pour évoluer et gagner en accessibilité et en fluidité sur le territoire, le CERP a besoin de partenaires sérieux et prêts à s’engager à nos côtés. Si vous même appartenez à une structure qui pourrait soutenir les agriculteurs en difficultés, et que vous souhaitez vous investir pour les accompagner par le biais de ce travail,  contactez nous grâce au formulaire et indiquez votre zone géographique.
Il est également possible de s’investir individuellement, à la mesure de vos possibilités.
</p>

<h3><p style="text-align:center">Comment utiliser le CERP ? </h3>
Une seule réponse est possible pour chaque facteur. C'est le facteur le plus vulnérant qui est inscrit. Par exemple, si vous élevez des ovins et des caprins, les ovins étant le plus à risque (situés plus bas dans le menu déroulant), veuillez n'indiquer que les ovins.
Lorsque vous ne pouvez pas répondre à une question, merci de choisir la réponse 'Ne sais pas / non-applicable'
</p>
<p style="text-align:center">
N'hésitez pas à faire remonter vos questions et vos retours d'expériences à 
 <a href="mailto:info@projetcerp.com">info@projetcerp.com</a></p>

<?php if($logged):?>
<div class="home-blocks">
    <?php 
        foreach($QUESTIONS as $category => $cat_cf) {
    ?>
    <div class="home-block" style="border: <?=$cat_cf["b-color"]?> 2px solid;">
        <a href="<?=$cat_cf['url']?>" style="color:<?=$cat_cf["b-color"]?>">
            <span style="color:<?=$cat_cf['color']?> !important" class="icon fa-<?=$cat_cf['icon']?>"></span> 
        <?=$cat_cf['text']?></a>
    </div>
    <?php } ?>
</div>
<?php endif;?>

<?php include 'pages/messages.php';?>
