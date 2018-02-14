<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/sys/core/init.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/head.inc.php';
    if (isset($_GET['id']))
        $arDepartment = getDepartmentsById($_GET['id']);
    else
        $arDepartment = array('fullname' => 'Подразделения с таким кодом не существует');
    $page = 'unit';
?>

    <body class="hold-transition skin-blue sidebar-mini fixed">
        <div class="wrapper">


        <?php
            include_once $_SERVER['DOCUMENT_ROOT'] . '/mainheader.inc.php';
        ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="glyphicon glyphicon-home"></i> Главная</a></li>
                        <li>Штатное расписание</li>
                        <li class="active"><?= $arDepartment['fullname']; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                <!-- Your Page Content Here -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Штатное расписание подразделения</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="col-xs-1">№</th>
                                                <th>Должность</th>
                                                <th>В/звание</th>
                                                <th>Тариф</th>
                                                <th>Форма допуска</th>
                                                <th>Номер приказа</th>
                                                <th>Дата</th>
                                                <th>Подписан</th>
                                                <th>Упразднена</th>
                                                <th class="col-xs-1 text-center">Редактировать</th>
                                                <th class="col-xs-1 text-center">Удалить</th>
                                            </tr>
                                        </thead>

                                        <tbody id="items"></tbody>
                                    </table>

                                 </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div>
                    <?php
                        $arAccessRight = getAccessRightById($_SESSION['user_id']);
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="text-right"><a href="/unit_edit.php?act=add&id_departments=<?= $_GET['id']; ?>" type="button" class="btn btn-primary <?= in_array($arAccessRight['kadr'], array(2, 3, 6, 7)) ? '' : disabled; ?>"><span class="glyphicon glyphicon-plus"></span> Добавить</a></p>
                        </div><!-- /.col -->
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

        <?php
            include_once $_SERVER['DOCUMENT_ROOT'] . '/mainfooter.inc.php';
        ?>
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/dist/js/app.min.js"></script>
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
        <script language="JavaScript" type="text/javascript">
        /*<![CDATA[*/
            $(document).ready(function(){
      		    $("#items").load("/unit.func.php?id=<?= $_GET['id']; ?>");
                setInterval(function() {$("#items").load("/unit.func.php?id=<?= $_GET['id']; ?>");}, 5000);
            });

            function ConfirmDelete(id)
            {
                var ObjectId = id;
                if(confirm("Вы действительно хотите удалить запись?")) {
                    document.location = "./save.php?id="+ObjectId+"&act=delUnit";
                }
            }
        /*]]>*/
        </script>
    </body>
</html>