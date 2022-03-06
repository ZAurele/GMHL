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
                                                        
                            <?php include "pages/".$currentPage;?>

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
                            type: 'dumbbell',
                            inverted: true
                        },

                        legend: {
                            enabled: false
                        },

                        subtitle: {
                            text: '1960 vs 2018'
                        },

                        title: {
                            text: '<?=$_GET['category']?>'
                        },

                        tooltip: {
                            shared: true
                        },

                        xAxis: {
                            type: 'category'
                        },

                        yAxis: {
                            title: {
                                text: 'Life Expectancy (years)'
                            }
                        },

                        series: [{
                            name: 'Life expectancy change',
                            data: data
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