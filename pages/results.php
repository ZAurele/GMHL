<?php 

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $sql = "SELECT * FROM questionnaires where user_id != ".$USER_ID." and category = '".$category."' order by id DESC";
    $rows = select_request($link,$sql,true);

    $scores = get_scores_from_database($QUESTIONS, $category, $rows);  

    $sql = "SELECT * FROM questionnaires where user_id = ".$USER_ID." and category = '".$category."' order by id DESC";
    $rows = select_request($link,$sql,true);

    $scores_user = get_scores_from_database($QUESTIONS, $category, $rows);

    $scores_all = array();
    foreach($scores as $type => $scores_ids) {
        if (!isset($scores_all[$type])) $scores_all[$type] = array("low"=>0, "high"=>0, "name" =>$type);

        $score = array_sum(array_values($scores_ids));
        $scores_all[$type]["low"] = round(($score / $SCORES_MAX[$category][$type])*100);
    }
    foreach($scores_user as $type => $scores_ids) {
        if (!isset($scores_all[$type])) $scores_all[$type] = array("low"=>0, "high"=>0, "name" =>$type);
        $score = array_sum(array_values($scores_ids));
        $scores_all[$type]["high"] = round(($score / $SCORES_MAX[$category][$type])*100);
    }

    ?>

    <figure class="highcharts-figure">
        <div id="chart-container"></div>
        <p class="highcharts-description"><?=$QUESTIONS[$category]["description"]?></p>
    </figure>

    <?php 
        $CATEGORIES = [];
        $data = [];
        $dataA = [];
        $dataV = [];
        foreach($scores_all as $type => $scores) {
            $type_title = $QUESTIONS[$category]["values"][$type]["text"];
            $low = str_replace(',','.',''.$scores['low']);
            $high = str_replace(',','.',''.$scores['high']);
            $color = ($scores['low'] < $scores['high']) ? "#27ae60" : "#c0392b";
            array_push($data, "{low:$low, high:$high,color:'$color'}");
            array_push($dataV, "$low");
            array_push($dataA, "$high");
            array_push($CATEGORIES,"'$type_title'");
        }
        
        $CATEGORIES = implode(",",$CATEGORIES);
    ?>
    <script>
        var data = [<?=implode(",",$data)?>];
        var dataA = [<?=implode(",",$dataA)?>];
        var dataV = [<?=implode(",",$dataV)?>];
    </script>

    <?php

}
?>