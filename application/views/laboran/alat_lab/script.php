<script type="text/javascript">
    var currentValueBidangLab = ''

    $(document).ready(function() {

        $(document).on('click', '.btn-tambah', function(e) {
            e.preventDefault();
            $('.notif').html('');
            $('#gambar').attr('required', true);
            $('#form-index')[0].reset();
            $('#modal-tambah-data').modal();
            $('#aksi').val('tambah');

            currentValueBidangLab = ''

            $('select[name="bidang_lab"]').val(currentValueBidangLab).trigger('change')
        });

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            $('.notif').html('');
            $('#gambar').attr('required', false);
            $('#modal-tambah-data').modal();
            $('#aksi').val('edit');
            var id = $(this).attr('id');
            $('#id_alat').val(id);
            $.ajax({
                url: '<?= base_url('laboran/alat_lab/get_id') ?>',
                data: 'id=' + id,
                type: 'POST',
                dataType: 'JSON',
                success: function(msg) {

                    currentValueBidangLab = msg.id_bidang_lab

                    $('select[name="bidang_lab"]').val(currentValueBidangLab).trigger('change')

                    $('#nama_alat').val(msg.nama_alat)
                    $('#jumlah_alat').val(msg.jumlah_alat)
                }
            });
        });

        $(document).on('submit', '#form-index', function(e) {
            e.preventDefault();
            var data = new FormData(document.getElementById('form-index'));
            $('.notif').html('Loading...');
            var aksi = $('#aksi').val();
            if (aksi == 'tambah') {
                $.ajax({
                    url: '<?= base_url() ?>laboran/alat_lab/store',
                    data: data,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    success: function(msg) {
                        if (msg.status == 'success') {
                            $('.notif').html(msg.text);
                            location.reload();
                        } else {
                            $('.notif').html(msg.text);
                        }
                    }
                });
            } else if (aksi == 'edit') {
                $.ajax({
                    url: '<?= base_url() ?>laboran/alat_lab/update',
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(msg) {
                        if (msg.status == 'success') {
                            $('.notif').html(msg.text);
                            location.reload();
                        } else {
                            $('.notif').html(msg.text);
                        }
                    }
                });
            }

        });

        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            $('.notif').html('');
            var id = $(this).attr('id');
            $('#modal-hapus-data').modal();

            $(document).on('click', '.ya-hapus', function(e) {
                e.preventDefault();
                $('.notif').html('Loading...');
                $.ajax({
                    url: '<?= base_url() ?>laboran/alat_lab/delete',
                    data: 'id=' + id,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(msg) {
                        if (msg.status == 'success') {
                            $('.notif').html(msg.text);
                            location.reload();
                        } else {
                            $('.notif').html(msg.text);
                        }
                    }
                });
            });
        });
    })
</script>