<?php 

function get_scores_from_database($QUESTIONS, $category, $rows) {
    $types = $QUESTIONS[$category]["values"];
    $bareme = $QUESTIONS[$category]["bareme"];

    $scores = array();

    foreach ($rows as $row) {
        $type = $row["type"];
        $id = $row["id"];

        $entries = $types[$type]["values"];
        $v = $entries[$id];
        $answer_text = $v["values"][$row["answer"]];

        if(!isset($scores[$type])) $scores[$type] = array();

        $bareme_question = $bareme[$id];

        if (isset($bareme_question["values"][$answer_text])) {
            array_push($scores[$type],$bareme_question["values"][$answer_text]);

        } else if ($answer_text != "NA") {
            debug("Missing answer $answer_text in bareme for category $category, type $type and question $id");
        }
    }  

    foreach($scores as $type => $values) {
        if (count($values) != 0)
            $scores[$type] = array_sum($values) / count($values);
        else 
            $scores[$type] = 0;
    }
    return $scores;  
}

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $sql = "SELECT * FROM questionnaires where user_id != ".$USER_ID." and category = '".$category."' order by id DESC";
    $rows = select_request($link,$sql,false);

    $scores = get_scores_from_database($QUESTIONS, $category, $rows);

    $data_types = array();
    if (!isset($SCORES_MAX[$category])) return null;
    foreach($scores as $type => $score) {
        if(!isset($data_types[$type])) $data_types[$type] = array("user" => 0, "all" => 0);
        if(isset($SCORES_MAX[$category][$type])) {
            $data_types[$type]["all"] = ($score / $SCORES_MAX[$category][$type])*100;
        }    
    }   

    $sql = "SELECT * FROM questionnaires where user_id = ".$USER_ID." and category = '".$category."' order by id DESC";
    $rows = select_request($link,$sql,false);

    $scores_user = get_scores_from_database($QUESTIONS, $category, $rows);
}
?>

<figure class="highcharts-figure">
    <div id="chart-container"></div>
    <p class="highcharts-description">
        Dumbbell charts are variants of columnrange charts, where a
        low and a high value is given for each data point. The points
        are visualized as markers with a line between them, resembling
        a dumbbell.
    </p>
</figure>

<script>
    var data = [
        {
        name: 'Austria',
        low: 69,
        high: 12
        }, {
            name: 'Belgium',
            low: 70,
            high: 81
        }, {
            name: 'Bulgaria',
            low: 69,
            high: 75
        }, {
            name: 'Croatia',
            low: 65,
            high: 78
        }, {
            name: 'Cyprus',
            low: 70,
            high: 81
        }, {
            name: 'Czech Republic',
            low: 70,
            high: 79
        }, {
            name: 'Denmark',
            low: 72,
            high: 81
        }, {
            name: 'Estonia',
            low: 68,
            high: 78
        }, {
            name: 'Finland',
            low: 69,
            high: 81
        }, {
            name: 'France',
            low: 70,
            high: 83
        }, {
            name: 'Greece',
            low: 68,
            high: 81
        }, {
            name: 'Spain',
            low: 69,
            high: 83
        }, {
            name: 'Netherlands',
            low: 73,
            high: 82
        }, {
            name: 'Ireland',
            low: 70,
            high: 82
        }, {
            name: 'Lithuania',
            low: 70,
            high: 75
        }, {
            name: 'Luxembourg',
            low: 68,
            high: 83
        }, {
            name: 'Latvia',
            low: 70,
            high: 75
        }, {
            name: 'Malta',
            low: 69,
            high: 82
        }, {
            name: 'Germany',
            low: 69,
            high: 81
        }, {
            name: 'Poland',
            low: 68,
            high: 78
        }, {
            name: 'Portugal',
            low: 63,
            high: 81
        }, {
            name: 'Romania',
            low: 66,
            high: 75
        }, {
            name: 'Slovakia',
            low: 70,
            high: 77
        }, {
            name: 'Slovenia',
            low: 69,
            high: 81
        }, {
            name: 'Sweden',
            low: 73,
            high: 82
        }, {
            name: 'Hungary',
            low: 68,
            high: 76
        }, {
            name: 'Italy',
            low: 69,
            high: 83
        }, {
            name: 'UK',
            low: 71,
            high: 81
        }
    ];

    
</script>

