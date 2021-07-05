<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Kegiatan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  </head>
  <body>
  <section class="section">
    <div class="container">
    <div class="col-md-6"><a href="<?= base_url(); ?>kegiatan/tambah" class="btn btn-success">Tambah Kegiatan</a></div><br>
      <table class="table is-narrow" id="tabeluser">
        <thead>
                <th scope="col">Nama Kegiatan</th>
                <th scope="col">Prioritas</th>
                <th scope="col">PIC</th>
                <th scope="col">Waktu</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
         </thead>
         <tbody>
                <?php foreach ($kegiatan as $k) : ?>
                    <tr>
                        <td><?= $k['kegiatan'] ?></td>
                        <td><?= $k['prioritas'] ?></td>
                        <td><?= $k['penanggung_jawab'] ?></td>
                        <td><?= $k['waktu'] ?></td>
                        <td><?php if ($k['status'] == 1) {
                                echo 'Approved';
                            } else {
                                echo 'Menunggu';
                            } ?></td>
                        <td><a href="<?= base_url('detail/komentar/') . $k['id'] ?>">Detail</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
      </table>
    </div>
  </section>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
      $('#tabeluser').DataTable();
  });
  </script>
</html>
