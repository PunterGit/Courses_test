<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $connect = new mysqli("127.0.0.1:3306","root","","courses");
    $connect->query("SET NAMES 'utf8'");
    $list = $connect->query("SELECT learn.id `id`, collab.fullname `fullName`, orgs.name `orgName`, cours.name `courseName`, learn.state_id `state` FROM learnings learn JOIN courses cours ON cours.id = learn.course_id JOIN collaborators collab ON collab.id = learn.person_id JOIN orgs ON orgs.id = collab.org_id WHERE (learn.start_date > '$_REQUEST[start_date]') AND (learn.finish_date < '$_REQUEST[finish_date]') AND (orgs.id =$_REQUEST[orgId]) ORDER BY `learn`.`id` ASC");
    $response = '[';
    while($row = $list->fetch_assoc()){
        $response .= "{id:".$row['id'].", ";
        $response .= "orgName:'".$row['orgName']."', ";
        $response .= "fullName:'".$row['fullName']."', ";
        $response .= "courseName:'".$row['courseName']."', ";
        $response .= "state:".$row['state']."}, ";
    }
    $response .=']';
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
}
