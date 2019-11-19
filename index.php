<?php
	$connect = new mysqli("127.0.0.1:3306","root","","courses");
	$connect->query("SET NAMES 'utf8' ");
	$list = $connect->query("SELECT learn.id `id`, collab.fullname `fullName`, orgs.name `orgName`, cours.name `courseName`, learn.state_id `state` FROM learnings learn JOIN courses cours ON cours.id = learn.course_id JOIN collaborators collab ON collab.id = learn.person_id JOIN orgs ON orgs.id = collab.org_id") or die(mysqli_error());
	$orgList = $connect->query("SELECT DISTINCT id, name FROM orgs") or die(mysqli_error());

	//SELECT learn.id, collab.fullname, orgs.name, cours.name, learn.start_date, learn.finish_date FROM learnings learn JOIN courses cours ON cours.id = learn.course_id JOIN collaborators collab ON collab.id = learn.person_id JOIN orgs ON orgs.id = collab.org_id WHERE (learn.start_date > '2018-12-02') AND (learn.finish_date < '2018-12-05') ORDER BY `learn`.`id` ASC
?>
<!DOCTYPE html>
<html>
<head lang="ru">
	<title>Курсы</title>
	<meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/css/jquery-ui.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        div.row:nth-child(1) {
            background-color: #5a6268;
        }
        div.row:nth-child(even){
            background-color: #6c757d;
        }

    </style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-4">
				<b>Название организации</b>
			</div>
			<div class="col-3">
				<b>Дата начала</b>
			</div>
			<div class="col-3">
				<b>Дата окончания</b>
			</div>
			<div class="col-2"></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-4">
				<select class="form-control" name="org">
				<?php
                    while($row = $orgList->fetch_assoc())
                    {
                        echo "<option value=\"$row[id]\">$row[name]</option>";
                    }
				?>
				</select>
			</div>
			<div class="col-3">
				<input class="form-control" type="date" name="date_start">
			</div>
			<div class="col-3">
				<input class="form-control" type="date" name="date_finish">
			</div>
			<div class="col-2">
				<button class="btn btn-dark">Показать</button>
			</div>
		</div>
	</div>
	<div class="container main">
		<div class="row">
			<div class="col-4"><b>Название организации</b></div>
			<div class="col-2"><b>Полное имя</b></div>
			<div class="col-4"><b>Название курса</b></div>
			<div class="col-2"><b>Статус завершения</b></div>
		</div>
		<?php
			while($row = $list->fetch_assoc())
			{
				echo "<div class=\"row\">
				<div class=\"col-4\">$row[orgName]</div>
				<div class=\"col-2\">$row[fullName]</div>
				<div class=\"col-4\">$row[courseName]</div>";
				if($row['state']>2){
					echo "<div class=\"col-2\">Завершён</div></div>";
				}else{
					echo "<div class=\"col-2\">Не завершен</div></div>";
				}
			}
		?>
	</div>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
</html>