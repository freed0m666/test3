<?php
$hostname = "http://localhost/";
$select=-1;
$del=-1;
$add=false;

//      РАБОТА С КЛАССАМИ

//gfdgsg
//      РАБОТА С КЛАССАМИ

if (isset($_GET['sel'])) {
    $select = intval($_GET['sel']);
}
if (isset($_GET['d'])) {
    $del = intval($_GET['d']);
}
if (isset($_GET['add'])) {
    $add = $_GET['add'];
print "<script>document.location.href='$hostname';</script>";
}

$mysql = new mysqli("mysql", "root", "qwer", "my_db");
if ($add==true) {
    $random = rand(100,1000);
    $mysql->query("INSERT INTO test(name, b) VALUES ('имяав','Какая то инавформаци $random')");
    unset($random);
}
if ($del>0) {
    $mysql->query("SELECT * FROM test");
    $mysql->query("DELETE FROM test WHERE `test`.`id` = $del");
}
//Начинаем выводить что-то
include("top.php");
if ($select == -1) {
    $result = $mysql->query("SELECT `id`,`name` FROM test");
    if($result){
        while($row = $result->fetch_assoc()){
            print("<a href=\"$hostname?sel=" . $row["id"] . "\">" . $row["id"] . " " . $row["name"] . "</a><br>\n");
        }
    }
print("<hr>\n<a href=\"$hostname?add=true\">Добавиь случайную запись</a>");
} else if ($select>0) {
    $result = $mysql->query("SELECT * FROM test WHERE id=$select");
    if($result){
        while($row = $result->fetch_assoc()){
            print($row["id"] . "<br>" . $row["name"] . "<br>" . $row["b"]);
        }
    }
    print("\n<hr><a href =\"$hostname\">HOME</a> <a href=\"$hostname?d=$select\">Удалить</a>");
}
$mysql->close();

include("bottom.php");
?>
