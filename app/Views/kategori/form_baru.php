<?= $this->extend('templates/layout') ?>

<?= $this->section('judul') ?>
Kategori
<?= $this->endSection('judul') ?>

<?= $this->section('subJudul') ?>
<h3>Entry Data Kategori</h3>
<?= $this->endSection('subJudul') ?>

<?= $this->section('konten') ?>
<?php if (isset($validation)) : ?>
  <div class="alert alert-danger" role="alert">
    <?= $validation->listErrors() ?>
  </div>
<?php endif; ?>

<form action="<?= base_url('kategori/create') ?>" method="POST">
  <?= csrf_field() ?>
  <div class="mb-3">
    <label for="kategori" class="form-label">Kategori</label>
    <input type="text" name="kategori" class="form-control" id="kategori" value="<?= old('kategori') ?>">
  </div>
  <div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan</label>
    <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= old('keterangan') ?>">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="<?= base_url('kategori') ?>" class="btn btn-warning">
    Kembali
  </a>
</form>
<?= $this->endSection('konten') ?>