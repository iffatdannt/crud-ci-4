<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $subjudul ?></h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i class="fas fa-plus"></i>Add Data</button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
      if (session()->getFlashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5>';
        echo session()->getFlashdata('pesan');
        echo '</h5> </div>';
      }
      ?>
      <?php
      $errors = session()->getFlashdata('errors');
      if (!empty($errors)) { ?>
        <div class="alert alert-danger alert-dismissible">
          <h4>Periksa Lagi Entry Form !!</h4>
          <ul>
            <?php foreach ($errors as $key => $error) { ?>
              <li>
                <?= esc($error) ?>
              </li>
            <?php } ?>
          </ul>
        </div>
      <?php } ?>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr class="text-center">
            <th width=50px>No</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Satuan</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th width=100px>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php foreach ($product as $key => $value) { ?>
            <tr>
              <td class="text-center"> <?= $no++ ?></td>
              <td class="text-center"> <?= $value['kode_product'] ?></td>
              <td> <?= $value['nama_product'] ?></td>
              <td class="text-center"> <?= $value['nama_category'] ?></td>
              <td class="text-center"> <?= $value['nama_satuan'] ?></td>
              <td class="text-center"> Rp. <?= number_format($value['harga_beli']) ?></td>
              <td class="text-center"> Rp. <?= number_format($value['harga_jual']) ?></td>
              <td class="text-center"> <?= $value['stok'] ?></td>
              <td class="text-center">
                <button class="button btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-data<?= $value['id_product'] ?>"><i class="fas fa-pencil-alt"></i></button>
                <button class="button btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-data<?= $value['id_product'] ?>"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<!-- /.Modall Add Data -->
<div class="modal fade" id="add-data">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Data <?= $subjudul ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('Product/InsertData') ?>
      <div class="modal-body">

        <div class="form group">
          <label for="">Kode Product</label>
          <input name="kode_product" class="form-control" value="<?= old('kode_product') ?>" placeholder="Kode Product" required>
        </div>

        <div class="form group">
          <label for="">Nama Product</label>
          <input name="nama_product" class="form-control" value="<?= old('nama_product') ?>" placeholder="Nama Product" required>
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
          <label for="">Harga Beli</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp.</span>
            </div>
            <input type="number" name="harga_beli" id="harga_beli" class="form-control" value="<?= old('harga_beli') ?>" placeholder="Harga Beli" required>
          </div>
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
          <label for="">Stok</label>
          <input name="stok" class="form-control" value="<?= old('stok') ?>" type="number" placeholder="stok" required>
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

<?php foreach ($product as $key => $value) { ?>
  <!-- /.Modall Edit Data -->
  <div class="modal fade" id="edit-data<?= $value['id_product'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php echo form_open('Product/UpdateData/' . $value['id_product']) ?>
        <div class="modal-body">

          <div class="form group">
            <label for="">Kode Product</label>
            <input name="kode_product" class="form-control" value="<?= $value['kode_product'] ?>" placeholder="Kode Product" required>
          </div>

          <div class="form group">
            <label for="">Nama Product</label>
            <input name="nama_product" class="form-control" value="<?= $value['nama_product'] ?>" placeholder="Nama Product" required>
          </div>

          <div class="form group">
            <label for="">Category</label>
            <select name="id_category" class="form-control">
              <option value="">--Pilih Kategori--</option>
              <?php foreach ($category as $key => $c) { ?>
                <option value="<?= $c['id_category'] ?>" <?= $value['id_category'] == $c['id_category'] ? 'Selected' : '' ?>><?= $c['nama_category'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form group">
            <label for="">Satuan</label>
            <select name="id_satuan" class="form-control">
              <option value="">--Pilih Satuan--</option>
              <?php foreach ($satuan as $key => $s) { ?>
                <option value="<?= $s['id_satuan'] ?>" <?= $value['id_satuan'] == $s['id_satuan'] ? 'Selected' : '' ?>><?= $s['nama_satuan'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Harga Beli</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" name="harga_beli" id="harga_beli<?= $value['id_product'] ?>" class="form-control" value="<?= $value['harga_beli'] ?>" placeholder="Harga Beli" required>
            </div>
          </div>

          <div class="form-group">
            <label for="">Harga Jual</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" name="harga_jual" id="harga_jual<?= $value['id_product'] ?>" class="form-control" value="<?= $value['harga_jual'] ?>" placeholder="Harga Jual" required>
            </div>
          </div>

          <div class="form group">
            <label for="">Stok</label>
            <input name="stok" class="form-control" value="<?= $value['stok'] ?>" type="number" placeholder="stok" required>
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
<?php } ?>

<!-- /.Modall Delete Data -->
<?php foreach ($product as $key => $value) { ?>
  <div class="modal fade" id="delete-data<?= $value['id_product'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data <?= $subjudul ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda Yakin Menghapus <b><?= $value['nama_product'] ?></b>..?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <a href="<?= base_url('Product/DeleteData/' . $value['id_product']) ?>" class="btn btn-danger btn-flat">Delete</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "paging": true,
      "info": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  new AutoNumeric('#harga_beli', {
    digitGroupSeparator: ',',
    decimalPlaces: 0,
  });
  new AutoNumeric('#harga_jual', {
    digitGroupSeparator: ',',
    decimalPlaces: 0,
  });

  <?php foreach ($product as $key => $value) { ?>
    new AutoNumeric('#harga_beli<?= $value['id_product'] ?>', {
      digitGroupSeparator: ',',
      decimalPlaces: 0,
    });
    new AutoNumeric('#harga_jual<?= $value['id_product'] ?>', {
      digitGroupSeparator: ',',
      decimalPlaces: 0,
    });
  <?php } ?>
</script>