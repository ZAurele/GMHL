<!-- Section -->
<h2>
Description de l'outil d'évaluation des risques à la prédation
</h2>
<p>
Cet outil a été élaboré grâce au travail d'éleveurs du Limousin, et aux retours d'experts issus de l'élevage et de l'écologie d'autres départements ayant déjà une expérience de la prédation.
Ceci est une première version qui est vouée à évoluer avec les retours d'expériences de ses utilisateurs.
</p>
<p>Il a été développé dans un contexte de lutte contre la prédation au sens large, il n'est donc pas nécessaire d'être dans une zone de présence du loup ou d'avoir subi de la prédation par cette espèce pour l'utiliser. Il est aussi fonctionnel pour d'autres prédateurs ainsi que les mésoprédateurs.
</p>
<p>
Les facteurs ayant une influence sur la prédation sont issus de la bibliographie, de retours d'experts et des éleveurs sur le terrain. Ils sont le fruit d'une réflexion longue et concertée. Ils sont répartis en plusieurs domaines: Contexte socio-économique, élevage, moyens de protection et enfin, environnement.
</p>

<h2>
Comment utiliser l'outil
</h2>

<p>
Une seule réponse est possible pour chaque facteur ; C'est le facteur le plus vulnérant qui est inscrit. Par exemple, si vous élevez des ovins et des caprins, les ovins étant le plus à risque (situés plus bas dans le menu déroulant), veuillez n'indiquer que les ovins.
</p>
<p>Si vous hésitez entre deux réponses pour un facteur, par mesure de précaution, choisissez-le plus vulnérant.
Lorsque vous ne pouvez pas répondre à une question, merci de choisir la réponse 'Ne sais pas / non-applicable'
</p>
<p>Enfin, n'hésitez pas à faire remonter vos questions et vos retours d'expériences à <a href="mailto:gmhl@gmhl.asso.fr">gmhl@gmhl.asso.fr</a>
</p>

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

<?php include'pages/messages.php';?>
