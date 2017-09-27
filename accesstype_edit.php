               
                        <li><a href="/dictionary.php?name=<?= $nameDictionary ?>">Формы допуска</a></li>
                        <li class="active"><?= ($_GET['act'] == 'add') ? 'Добавление' : 'Редактирование'; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                <?php
                    $alertMessage = 'Укажите наименование формы допуска!';
                    if ($_GET['act'] == 'edit') {
                        $arAccessType = getAccessTypeById($_GET['id']);
                    }
                ?>
                <!-- Your Page Content Here -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?= ($_GET['act'] == 'add') ? 'Добавление' : 'Редактирование'; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form name="editform" role="form" action="/save.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="act" value="<?= $_GET['act']; ?>Accesstype" />
                                    <input type="hidden" name="id" value="<?= (isset($_GET['id'])) ? $_GET['id'] : ''; ?>" />
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Наименование</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Наименование формы допуска"<?= ($_GET['act'] == 'edit') ? ' value="' . $arAccessType['name'] . '"' : ''; ?> required autofocus>
                                        </div>
                                    </div><!-- /.box-body -->
