<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Jquery -->
    <script src="/style/public/js/jq_v_3_6_0.js"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="/style/public/css/dtbs.css">



    <script src="https://kit.fontawesome.com/de9f65bcf0.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
	<title>DTBS</title>

</head>
<body>
	<div class="container-fluid main p-0 m-0">


		<div class = "page" id = "one">
			<div class="names"><h1 class="text-center pt-3"><span>_DTBS_</span> VERSION 1.0</h1></div>
		</div>

		<div class = "page p-3" id = "two">
			<h3 class="text-center pt-3">Что это? </h3>
				<p>
					Этот модуль, DTBS, в первой своей итерации, предоставляет следующие возможности:
				</p>
				<ul>
					<li>
						Создание, редактирование и удаление таблиц. Все происходит исключительно через веб-интерфейс.
					</li>
					<li>
						Автоматическое создание классов для работы с созданными таблицами и данными.
					</li>
					<li>
						При подключении класса Dtbs в ваш проект, возможна работа с вашей базой данных, на уровне всех необходимых операций: получение , изменение, удаление и конечно добавление данных.
					</li>
				</ul>
				<p>Для перевода DTBS в рабочее состояние необходимо в файле base/db.ini выполнить подключение к базе данных, и сменить метод data/route.php на routeLimb(), вместо routePublicLimb().</p>
		</div>

	</div>
</body>
<script>
</script>
</html>
