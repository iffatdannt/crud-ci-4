<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Service | Jaya Trade Indonesia</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="<?= base_url('AdminLTE') ?>/index3.html" class="navbar-brand">
                    <img src="<?= base_url('AdminLTE') ?>/dist/img/logoJaya.png" alt="Logo Jaya Trade" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Jaya Trade Indonesia</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">


                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                        </li>
                        <li class="nav-item">
                            <?php if (session()->get('level') == '1') { ?>
                                <a class="nav-link" href="<?= base_url('Admin') ?>">
                                    <i class="fas fa-tachometer-alt"></i> Dasboard
                                </a>
                            <?php } else { ?>
                                <a class="nav-link" href="<?= base_url('Home/Logout') ?>">
                                    <i class="fas fa-sign-in-alt"></i> Logout
                                </a>
                            <?php } ?>
                        </li>
                    </ul>
                    </li>
                    </ul>
                </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                <div class="row">

                    <!-- /.col-md-6 -->
                    <div class="col-lg-7">
                        <div class="card card-primary card-outline">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <label class="form-control form-control-lg"><?= date('d M Y') ?></label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jam</label>
                                            <label class="form-control form-control-lg"><?= date('15:00') ?></label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Administrator</label>
                                            <label class="form-control form-control-lg text-primary"><?= session()->get('nama_user') ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0"></h5>
                            </div>
                            <div class="card-body bg-black color palette text-right ">
                                <label class="display-4 text-green"><b>Rp. 18,000,000</b></label>
                            </div>
                        </div>
                    </div>
                    <!-- /.Modall Add Data -->
                    <div class="modal fade" id="add-data">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Data </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php echo form_open('Penjualan/InsertData') ?>
                                <div class="modal-body">

                                    <div class="form group">
                                        <label for="">Nomor Faktur</label>
                                        <input name="no_faktur" class="form-control" value="<?= $no_faktur ?>" type="number" placeholder="Nomor Faktur" required>
                                    </div>

                                    <div class="form group">
                                        <label for="">Nama Product</label>
                                        <select name="id_product" class="form-control">
                                            <option value="">--Pilih Product--</option>
                                            <?php foreach ($product as $key => $value) { ?>
                                                <option value="<?= $value['id_product'] ?>"><?= $value['nama_product'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form group">
                                        <label for="">Category</label>
                                        <select name="id_category" class="form-control">
                                            <option value="">--Pilih Kategori--</option>
                                            <?php foreach ($category as $key => $value) { ?>
                                                <option value="<?= $value['id_category'] ?>"><?= $value['nama_category'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form group">
                                        <label for="">Satuan</label>
                                        <select name="id_satuan" class="form-control">
                                            <option value="">--Pilih Satuan--</option>
                                            <?php foreach ($satuan as $key => $value) { ?>
                                                <option value="<?= $value['id_satuan'] ?>"><?= $value['nama_satuan'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Harga Jual</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="<?= old('harga_jual') ?>" placeholder="Harga Jual" required>
                                        </div>
                                    </div>

                                    <div class="form group">
                                        <label for="">Tanggal Jual</label>
                                        <input name="tgl_jual" class="form-control" value="<?= old('tgl_jual') ?>" type="date" placeholder="Tanggal Jual" required>
                                    </div>

                                    <div class="form group">
                                        <label for="">Jam Jual</label>
                                        <input name="jam_jual" class="form-control" value="<?= old('jam_jual') ?>" type="time" placeholder="Jam Jual" required>
                                    </div>

                                    <div class="form group">
                                        <label for="">QTY</label>
                                        <input name="qty" class="form-control" value="<?= old('qty') ?>" type="number" placeholder="qty" required>
                                    </div>

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                                </div>
                                <?php echo form_close() ?>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-1">
                                                <input name="harga_jual" class="form-control" placeholder="Harga">
                                            </div>
                                            <div class="col-1">
                                                <input type="number" min="1" value="1" name="qty" class="form-control text-center" placeholder="QTY">
                                            </div>
                                            <div class="col-3">
                                                <button type="submit" class="btn btn-flat btn-primary" data-toggle="modal" data-target="#add-data"><i class="fas fa-cart-plus"></i>Add </button>
                                                <button class="btn btn-flat btn-warning"><i class="fas fa-sync"></i> Clear </button>
                                                <button class="btn btn-flat btn-success"><i class="fas fa-cash-register"></i> Payment </button>
                                            </div>
                                        </div>
                                        <?php echo form_close()
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No Faktur</th>
                                                    <th>Nama Product</th>
                                                    <th>Category</th>
                                                    <th>Harga</th>
                                                    <th width="100px">QTY</th>
                                                    <th>Total Harga</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <td>0001</td>
                                                    <td>Gas Alam</td>
                                                    <td>Migas Mentah</td>
                                                    <td>@ Rp. 9,000,000</td>
                                                    <td>2 MMCF</td>
                                                    <td>Rp. 18,000,000</td>
                                                    <td>
                                                        <a class="btn btn-flat btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0"></h5>
                            </div>
                            <div class="card-body bg-black color palette text-center ">
                                <h1 class="text-warning">Delapan Belas Juta Rupiah</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>
</body>

</html>