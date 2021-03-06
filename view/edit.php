<!DOCTYPE html>
<html>
<head>
    <title>crad</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body class="clr">
<?php require_once('../includes/initialize.php'); ?>
<div class="container">
    <header>
        <div class="wrapper">
            <div class="logo"><a href="../index.php" title="Главная"><img alt="Главная" title="Главная" src="../img/kisspngfff.png"><h3>Авторские книги</h3></a></div>
            <div class="animation">
                <a target="_blank" title="СНЕГ НА YOUTUBE" href="https://youtu.be/V37Q3l6AFAU?t=1917">
                    <svg class="svg-snowglobe" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">

                        <defs>
                            <clipPath id="globeClipPath">
                                <circle cx="32" cy="31" r="26.825"/>
                            </clipPath>
                        </defs>

                        <path class="outline"
                              d="M0,63.349h64l-6.258-14.086h-1.016c3.805-5.207,5.891-11.449,5.891-17.997c0-16.881-13.742-30.614-30.627-30.614c-16.877,0-30.612,13.733-30.612,30.614c0,6.543,2.082,12.793,5.875,17.997h-1L0,63.349z"
                        />
                        <polygon
                                class="base"
                                points="57.967,59.431 6.028,59.431 8.804,53.181 55.195,53.181"
                        />
                        <path
                                class="globe"
                                d="M31.99,4.571c14.729,0,26.707,11.976,26.707,26.698c0,3.861-0.846,7.587-2.398,11.009c-1.053,0.086-1.842,0.215-2.58,0.352c-1.043,0.195-2.035,0.375-4.066,0.375c-2.027,0-3.02-0.18-4.062-0.375c-1.176-0.215-2.387-0.441-4.785-0.441c-0.191,0-0.332,0.012-0.512,0.016v-5.695h2.656l-3.887-2.73v-3.7h-2.441v1.979l-4.619-3.245l-10.956,7.696h2.66v5.695c-0.195-0.004-0.353-0.016-0.562-0.016c-2.388,0-3.601,0.227-4.773,0.441c-1.042,0.195-2.031,0.375-4.054,0.375c-2.024,0-3.011-0.18-4.053-0.375c-0.735-0.137-1.523-0.266-2.571-0.352
           c-1.548-3.422-2.395-7.156-2.395-11.009C5.298,16.547,17.271,4.571,31.99,4.571z"
                        />
                        <path
                                class="water"
                                fill="#4875BA"
                                d="M10.162,46.591c1.012,0.18,2.174,0.332,4.156,0.332c2.384,0,3.596-0.223,4.768-0.438c1.043-0.195,2.031-0.375,4.061-0.375c2.025,0,3.012,0.18,4.053,0.375c1.175,0.215,2.386,0.438,4.779,0.438c2.381,0,3.596-0.223,4.768-0.438c1.043-0.195,2.031-0.375,4.059-0.375c2.035,0,3.027,0.18,4.07,0.375c1.176,0.215,2.387,0.438,4.777,0.438c1.992,0,3.16-0.156,4.18-0.332c-0.656,0.93-1.371,1.824-2.148,2.672h-39.39C11.52,48.415,10.816,47.521,10.162,46.591z"
                        />
                        <g>

                            <g class="group-snow" clip-path="url(#globeClipPath)">
                                <circle class="snow"
                                        cx="49.498"
                                        cy="8.482"
                                        r="2.5"
                                />
                                <circle class="snow"
                                        cx="35.748"
                                        y="2.783"
                                        r="2.5"
                                />
                                <circle class="snow"
                                        cx="21.001"
                                        cy="4.728"
                                        r="2.5"
                                />
                                <circle class="snow"
                                        cx="28.25"
                                        cy="2.783"
                                        r="2.5"
                                />
                                <circle class="snow"
                                        cx="42.997"
                                        cy="4.728"
                                        r="2.5"
                                />
                                <circle class="snow"
                                        cx="14.502"
                                        cy="8.482"
                                        r="2.5"
                                />
                                <circle class="snow"
                                        cx="9.194"
                                        cy="13.793"
                                        r="2.5"
                                />
                                <circle class="snow"
                                        cx="54.806"
                                        cy="13.793"
                                        r="2.5"
                                />
                            </g>
                    </svg>
                </a>
            </div>
        </div>
    </header>
    <div class="wrapper back">
        <h1>Редактирование</h1>
        <?php
        if(isset($_GET['id_book']) && $_GET['id_author']){
            $id_book = $_GET['id_book'];
            $id_author = $_GET['id_author'];
            $result = $api->getBookById($id_book , $id_author);
        }else{
            $response['status'] = "99";
            $response['message'] = "Required Parameters missing";
            echo json_encode($response);
        }
        ?>

        <?php if($result):?>
        <?php
            function objectToarray2($result)
            {
                $array = (array)$result;
                foreach($array as $key => &$field){
                    if(is_object($field))$field = objectToarray2($field);
                }
                return $array;
            }
            $arr = array(objectToarray2($result));
            $uniq = array_unique($arr);
            $submain = $uniq;
        ?>
        <form class="block edit_form" action="../modifyBook.php" method="POST">
            <div class="form-group item">
                <label>Книги</label>
                <?php foreach ($submain as $row):?>
                    <input type="text" name="book_name" class="form-control" value="<?php echo $row['book_name'] ;?>">
                <?php endforeach?>
            </div>
            <div class="form-group item">
                <label>Автора</label>
                <?php foreach ($submain as $row):?>
                    <input type="text" name="author_name" class="form-control" value="<?php echo $row['name'] ;?>">
                <?php endforeach?>
            </div>
            <?php foreach ($submain as $row):?>
            <div class="form-group item">
                <input type="hidden" name="id_book" class="form-control" value="<?php echo $row['id_book'] ;?>">
            </div>
            <div class="form-group item">
                <input type="hidden" name="id_author" class="form-control" value="<?php echo $row['id_author'] ;?>">
            </div>
            <?php endforeach?>
            <?php endif; ?>
            <div class="form-group item">
                <div class="but"><button type="submit" name="save">Сохранить</button></div>
            </div>
            <div class="form-group item">
                <?php foreach ($submain as $row):?>
                    <a class="form-control" href="../deleteBook.php?id_book=<?php echo $row['id_book'];?>&id_author=<?php echo $row['id_author'];?>" >Удалить</a>
                <?php endforeach?>
            </div>

         </form>
    </div>
</div>
<footer>
    <div class="wrapper">
        <div class="logo"><a href="../index.php" title="Главная"><img alt="Главная" title="Главная" src="../img/kisspngfff.png"><h3>Авторские книги</h3></a></div>
        <script src="../public/js/js.js"></script>
    </div>
</footer>
</body>
</html>
