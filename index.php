<?php include "config/main.php";?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?=$project?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css?<?php echo time(); ?>" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!-- <script src="https://use.fontawesome.com/c22f5a017c.js"></script>-->
        <script src="js/functions.js"></script>

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

            <?php 
            if (isset($_GET['page']) && $_GET['page'] == "results" && isset($_GET['category'])):
                $title = $QUESTIONS[$_GET["category"]]["text"];

                ?>
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/highcharts-more.js"></script>
                <script src="https://code.highcharts.com/modules/dumbbell.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="https://code.highcharts.com/modules/export-data.js"></script>
                <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                <script>
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
                            name: 'Votre score',
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