<?php
    header('Content-type: text/html; charset=utf-8');
    // Запуск механизма сессий
    session_start();

    // Механизм авторизации
    include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php';

    // Функции БД и настройки соединения
    include_once $_SERVER['DOCUMENT_ROOT'] . '/db.func.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/getroletitlebyid.func.php';

    ConnectDatabase();



                            // Выполним SQL запрос
                            try {
                                $sql = "SELECT * FROM public.attached WHERE incoming = '" . $_GET['id'] . "' ORDER BY code";
                                foreach ($dbconn->query($sql) as $row) {
                        ?>
                        <tr>
                            <td><a href="/incoming_file_view.php?code=<?= $row['code']; ?>" target="_blank"><?= $row['filename']; ?></a></td>
                            <td class="col-md-1 text-center"><a href="javascript:void(0);" onclick="ConfirmDelete('<?= $row['code']; ?>');" class="button btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></a></td>
                        </tr>
                        <?php
                                }

                            } catch (PDOException $e) {
                                print "Error!: " . $e->getMessage() . "<br />";
                            }
                        ?>