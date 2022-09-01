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
            $('#id_bidang_lab').val(id);
            $.ajax({
                url: '<?= base_url('admin/bidang_lab/get_id') ?>',
                data: 'id=' + id,
                type: 'POST',
                dataType: 'JSON',
                success: function(msg) {
                    $('#bidang_lab').val(msg.bidang_lab)
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
                    url: '<?= base_url() ?>admin/bidang_lab/store',
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
                    url: '<?= base_url() ?>admin/bidang_lab/update',
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
                    url: '<?= base_url() ?>admin/bidang_lab/delete',
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