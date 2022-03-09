
<?php
$valid_q = isset($_GET["category"]) && isset($_GET["type"]);

// UPDATE
if (isset($_POST["update_questions"]) && isset($_POST["category"]) && isset($_POST["type"])) {

    foreach($_POST as $key => $value) {
        if ($key != "update_questions" && $key != "category" && $key != "type") {
            $values = array(
                "category"=>$_POST["category"],
                "type"=>$_POST["type"],
                "id"=>$key,
                "answer" => $value,
                "user_id" => $USER_ID
            );
            if (''.$value == '') $value = 0;
            update_answer($link, $_POST["category"], $_POST["type"], $key, $value, $USER_ID);
        }
    }
}



if ($valid_q) {
    $category = $_GET['category'];
    $type = $_GET['type'];

    $sql = "SELECT * FROM questionnaires where user_id = '".$USER_ID."' and category = '".$category."' and type = '".$type."' order by id DESC";
    $rows = select_request($link,$sql);

    $saved_answers = array();
    foreach ($rows as $row) {
        $saved_answers[$row["id"]] = $row["answer"];
    }

    $values = $QUESTIONS[$category]["values"][$type]["values"];

    ?>
        <form method="post" action="index.php?page=questions&category=<?=$category?>&type=<?=$type?>">
            <div class="row uniform">:
                <?php
                    foreach($values as $id => $qu) {
                        ?>
                            <div class="12u">
                                <h3 class="" style="text-decoration: underline;"><?=$qu["title"]?></h3>
                            </div>
                            <div class="12u">
                                <div class="select-wrapper">
                                    <select name="<?=$id?>" id="<?=$id?>" oninvalid="this.setCustomValidity('Veuillez sélectionner une valeur')" >
                                    <option value=""></option>
                                    <?php
                                    $i = 1;
                                    foreach($qu["values"] as $answer) {
                                        if ($answer == "NA") continue;

                                        $option = '<option value="'.$i.'" ';
                                        if(array_key_exists($id,$saved_answers) && ''.$saved_answers[$id] == ''.$i){
                                            $option .= "selected";
                                        }
                                        $option .= '>'.$answer.'</option>';
                                        echo $option;
                                        $i++;
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        <?php
                    }
                ?>
                <div class="12u$">
                    <ul class="actions">
                        <input type="hidden" name="update_questions" value="y">
                        <input type="hidden" name="category" value="<?=$category?>">
                        <input type="hidden" name="type" value="<?=$type?>">
                        <li><input type="submit" value="Valider" class="special" /></li>
                    </ul>
                </div>
            </div>
        </form>
    <?php
}
?>


