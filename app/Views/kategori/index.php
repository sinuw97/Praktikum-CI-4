<?= $this->extend('templates/layout') ?>

<?= $this->section('judul') ?>
Kategori
<?= $this->endSection('judul') ?>

<?= $this->section('subJudul') ?>
<h3>Data Kategori</h3>
<?= $this->endSection('subJudul') ?>

<?= $this->section('konten') ?>
<a href="<?= base_url('kategori/add') ?>" class="btn btn-primary mb-3">
  <i class="fa fa-plus"></i> Tambah Data
</a>
<table class="table table-hover table-bordered table-striped">
  <thead class="thead-dark">
    <tr>
      <th>Kategori</th>
      <th>Keterangan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($kategori as $k): ?>
      <tr>
        <td><?= $k->kategori ?></td>
        <td><?= $k->keterangan ?></td>
        <td>
          <a href="<?= base_url('kategori/' . $k->id) ?>" class="btn btn-primary mr-2">
            Edit
          </a>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus" data-id="<?= $k->id ?>">
            Hapus
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formHapus" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="_method" value="DELETE">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Script utk popup modal -->
<script>
  const modalHapus = document.getElementById('modalHapus');
  const formHapus = document.getElementById('formHapus');

  modalHapus.addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const baseUrl = "<?= base_url('kategori/delete') ?>";
    formHapus.setAttribute('action', `${baseUrl}/${id}`);
  });
</script>
<?= $this->endSection('konten') ?>