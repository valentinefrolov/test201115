<?php
/**
 * @param string $user_ids
 * @return array
 */
function load_users_data(string $user_ids) {
    if(!preg_match('/^[\d ,]+$/', $user_ids)) {
        throw new RuntimeException("wrong params, may cause SQL injection");
    }
    $db = mysqli_connect("localhost", "root", "", "test201115");
    $data = [];
    $sql = mysqli_query($db, "SELECT * FROM users WHERE id IN ($user_ids)");
    while($obj = $sql->fetch_object()){
        $data[$obj->id] = $obj->name;
    }
    mysqli_close($db);
    return $data;
}

$params = /*$_GET['user_ids']*/$argv[1];

$data = load_users_data($params);
foreach ($data as $user_id=>$name) {
    echo "<a href=\"/show_user.php?id=$user_id\">$name</a>";
}
