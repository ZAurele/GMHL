<?php include 'config/main.php';

for($i = 1; $i < 5; $i++) {
    foreach($QUESTIONS as $category => $cat_cf) {
        foreach ($cat_cf["values"] as $type => $cf) {
            foreach ($cf["values"] as $id => $c) {
                //var_dump($c["values"]);
                $a = rand(1, count($c["values"]) - 1);

                //if ($i == 4) $a = count($c["values"]) - 1;

                update_answer($link, $category, $type, $id, $a, $i);

                echo "User $i set choice ".$c["values"][$a]." ($a) for $id<br>";
            }
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
</head>
<body></body>
</html>