<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('click', '.btn-tambah', function(e) {
            e.preventDefault();
            $('.notif').html('');
            $('#form-index')[0].reset();
            $('#modal-tambah-data').modal();
            $('#aksi').val('tambah');
        });

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            $('.notif').html('');
            $('#modal-tambah-data').modal();
            $('#aksi').val('edit');
            var id = $(this).attr('id');
            $('#id_prodi').val(id);
            console.log($('#id_prodi').val());

            $.ajax({
                url: '<?= base_url('admin/prodi/get_id') ?>',
                data: 'id=' + id,
                type: 'POST',
                dataType: 'JSON',
                success: function(msg) {
                    console.log(msg);
                    $('select[name="fakultas"]').val(msg.id_fakultas).trigger('change')
                    $('#prodi').val(msg.prodi)
                }
            });
        });

        $(document).on('submit', '#form-index', function(e) {
            e.preventDefault();
            var data = $('#form-index').serialize();
            $('.notif').html('Loading...');
            var aksi = $('#aksi').val();
            if (aksi == 'tambah') {
                $.ajax({
                    url: '<?= base_url() ?>admin/prodi/store',
                    data: data,
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
            } else if (aksi == 'edit') {
                $.ajax({
                    url: '<?= base_url() ?>admin/prodi/update',
                    data: data,
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
                    url: '<?= base_url() ?>admin/prodi/delete',
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