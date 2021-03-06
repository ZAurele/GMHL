<?php include "config/main.php";
$description = "";

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?=$project?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="description" content="<?=$description?>" />
        <script type="application/ld+json">
            {
            "@context" : "http://schema.org",
                "@type" : "Organization",  
                "name" : "GMHL",
                "url" : "https://projetcerp.com", 
                "logo": "http://projetcerp.com.com/images/logo.png",
                "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "",
                "email": "",
                "contactType": "Customer service"
                },
                "founders": [
                {
                "@type": "Person",
                "name": ""
                }
            ],
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "51 rue des Berges",
                "addressLocality": "Grenoble",
                "addressRegion": "Isère",
                "postalCode": "38000",
                "addressCountry": "FRANCE"
                }
            }
            </script>
        <meta name="keywords" content=""/>
        <meta charset="utf-8" />
        <meta property="og:image" content="http://projetcerp.com.com/images/logo.png" />
        <meta property="og:title" content="CERP" />
        <meta property="og:description" content="<?=$description?>" />
        
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css?<?php echo time(); ?>" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!-- <script src="https://use.fontawesome.com/c22f5a017c.js"></script>-->
        <script src="js/functions.js"></script>
        <script src="https://kit.fontawesome.com/8ca9e2e8c8.js" crossorigin="anonymous"></script>
        <link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/favicons/favicon-16x16.png">
    </head>
    <body>

        <!-- Wrapper -->
            <div id="wrapper">

                <!-- Main -->
                    <div id="main">
                        <div class="inner">
                            <!-- Header -->
                                <header id="header">
									<?php include 'header/header.php';?>
                                </header>

                            <?php if ($error_message != ''):?>
                                </br>
                                <div class="box">
                                    <b style="color:red"><?=$error_message?></b>
                                </div>
                            <?php endif;?>
                                                        
                            <?php include "pages/".$PAGE;?>

                            <div align="center"><a href="#header" class="button"><b class="icon fa-arrow-up"></b></a></div>
                        </div>
                    </div>

                <?php include "sidebar/sidebar.php";?>
            </div>

        <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
            <script src="assets/js/main.js"></script>

            
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/highcharts-more.js"></script>
            <script src="https://code.highcharts.com/modules/dumbbell.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>

            <?php 
            if (isset($_GET['page']) && $_GET['page'] == "results" && isset($_GET['category'])):
                $title = $QUESTIONS[$_GET["category"]]["text"];

                ?>
                
                <script>
                    function pickColor(version) {
                        return ["#1abc9c","#2ecc71","#3498db","#9b59b6","#34495e","#f1c40f","#e67e22","#e74c3c","#95a5a6",
                        "#16a085","#27ae60","#2980b9", "#8e44ad", "#2c3e50", "#f39c12", "#d35400", "#c0392b", "#7f8c8d"][version];
                    }

                    if (data) {
                    Highcharts.chart('chart-container', {
                        
                        chart: {
                            inverted: true
                        },
                        credits: false,
                        title: {
                            text: '<?=$title?>'
                        },

                        tooltip: {
                            shared: true
                        },

                        xAxis: {
                            categories: [<?=$CATEGORIES_STRING?>]
                        },

                        yAxis: {
                            title: {
                                text: 'Score (%)'
                            },
                            min:0,
                            max:100
                        },

                        series: [{
                            type: 'columnrange',
                            name: 'Différence',
                            data: data,
                            pointWidth:5,
                            opacity:0.8,
                            showInLegend: false
                        },
                        {
                            type: 'line',
                            name: 'Votre score - version <?=get_selected_version($_GET['category'])?>',
                            data: dataV,
                            lineWidth:0,
                            color: '#f8dba6',
                            marker: {
                                radius:8
                            },
                            states: {
                                hover: {
                                    lineWidthPlus:0
                                }
                            }
                        },
                        <?php foreach ($dataVersions as $version => $da):?>
                            {
                                type: 'line',
                                name: 'Votre score - version <?=$version?>',
                                data: [<?=implode(",",$da)?>],
                                lineWidth:0,
                                color: pickColor(<?=$version?>),
                                marker: {
                                    radius:6
                                },
                                states: {
                                    hover: {
                                        lineWidthPlus:0
                                    }
                                }
                            },
                        <?php endforeach; ?>
                        {
                            type: 'line',
                            name: 'Moyenne générale',
                            data: dataA,
                            lineWidth:0,
                            states: {
                                hover: {
                                    lineWidthPlus:0
                                }
                            }
                        }]

                        });
                    }
                </script>
            <?php
            endif;
            ?>
    </body>
</html>
<?php include "config/end.php";?>
