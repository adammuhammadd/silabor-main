<script type="text/javascript">
    var currentValueFakultas = ''
    var currentValueProdi = ''
    var currentValueBidangLab = ''

    $(document).ready(function() {
        $("#fakultas").change(function() {
            var id_fakultas = $("#fakultas").val()
            $.ajax({
                url: '<?= base_url('admin/user/get_prodi') ?>',
                data: 'id=' + id_fakultas,
                type: 'POST',
                dataType: 'JSON',
                success: function(msg) {
                    $("#prodi").html('')

                    let template = ''

                    if (msg.length == 0) {
                        template = template + `<option disabled selected value> -- pilih -- </option>`
                        $("#prodi").html(template)
                        return
                    }

                    template = template + `<option disabled selected value> -- pilih -- </option>`

                    msg.forEach((e, i) => {
                        template = template + `<option value="${e.id_prodi}">${e.prodi}</option>`
                    });

                    $("#prodi").html(template)
                    $("#prodi").val(currentValueProdi).trigger('change');
                }
            });
        });

        $("#prodi").change(function() {
            var id_prodi = $("#prodi").val()
            $.ajax({
                url: '<?= base_url('admin/user/get_bidang_lab') ?>',
                data: 'id=' + id_prodi,
                type: 'POST',
                dataType: 'JSON',
                success: function(msg) {
                    $("#bidang_lab").html('')

                    let template = ''

                    if (msg.length == 0) {
                        template = template + `<option disabled selected value> -- pilih -- </option>`
                        $("#bidang_lab").html(template)
                        return
                    }

                    template = template + `<option disabled selected value> -- pilih -- </option>`

                    msg.forEach((e, i) => {
                        template = template + `<option value="${e.id_bidang_lab}">${e.bidang_lab}</option>`
                    });

                    $("#bidang_lab").html(template)
                    $("#bidang_lab").val(currentValueBidangLab).trigger('change');
                }
            });
        });

        $("#level").change(function() {
            if ($("#level").val() == 'Super Admin' || $("#level").val() == 'Kepala UPT Lab') {
                $("#level").prop('required', false);
                $("#bidang_lab").prop('disabled', true);
                $("#fakultas").prop('disabled', true);
                $("#prodi").prop('disabled', true);

                $('select[name="bidang_lab"]').val('').trigger('change')
                $('select[name="fakultas"]').val('').trigger('change')
                $('select[name="prodi"]').val('').trigger('change')
            } else if ($("#level").val() == 'Dosen' || $("#level").val() == 'Mahasiswa') {
                $("#bidang_lab").prop('disabled', true);
                $("#bidang_lab").prop('required', false);
                $("#fakultas").prop('disabled', false);
                $("#prodi").prop('disabled', false);
            } else {
                $("#level").prop('required', true);
                
                $("#bidang_lab").prop('disabled', false);
                $("#fakultas").prop('disabled', true);
                $("#prodi").prop('disabled', true);
                
                $("#bidang_lab").prop('required', true);
                $("#fakultas").prop('required', false);
                $("#prodi").prop('required', false);
            }
        });

        $(document).on('click', '.btn-tambah', function(e) {
            $("#pass-reminder").html('')
            $("#password").prop('required', true);

            e.preventDefault();
            $('.notif').html('');
            $('#form-index')[0].reset();
            $('#modal-tambah-data').modal();
            $('#aksi').val('tambah');


            currentValueFakultas = ''
            currentValueProdi = ''
            currentValueBidangLab = ''


            $('select[name="fakultas"]').val(currentValueFakultas).trigger('change')
            $('select[name="prodi"]').val(currentValueProdi).trigger('change')
            $('select[name="bidang_lab"]').val(currentValueBidangLab).trigger('change')
            $("#level").val('').trigger('change');
            $("#jenkel").val('').trigger('change');
        });

        $(document).on('click', '.btn-edit', function(e) {
            $("#pass-reminder").html('(Hanya isi jika ingin mengganti !)')
            $("#password").prop('required', false);

            e.preventDefault();
            $('.notif').html('');
            $('#modal-tambah-data').modal();
            $('#aksi').val('edit');
            var id = $(this).attr('id');
            $('#id_user').val(id);
            $.ajax({
                url: '<?= base_url('admin/user/get_id') ?>',
                data: 'id=' + id,
                type: 'POST',
                dataType: 'JSON',
                success: function(msg) {

                    currentValueFakultas = msg.id_fakultas
                    currentValueProdi = msg.id_prodi
                    currentValueBidangLab = msg.id_bidang_lab

                    $('select[name="fakultas"]').val(currentValueFakultas).trigger('change')
                    $('select[name="prodi"]').val(currentValueProdi).trigger('change')
                    $('select[name="bidang_lab"]').val(currentValueBidangLab).trigger('change')

                    $('#nama_lengkap').val(msg.nama_lengkap)
                    $('#nim').val(msg.nim)
                    $('#email').val(msg.email)
                    $('#alamat').val(msg.alamat)
                    $('#tgl_lahir').val(msg.tgl_lahir)
                    $('select[name="jenkel"]').val(msg.jenkel).trigger('change')
                    $('select[name="level"]').val(msg.is_level).trigger('change')
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
                    url: '<?= base_url() ?>admin/user/store',
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
                    url: '<?= base_url() ?>admin/user/update',
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
                    url: '<?= base_url() ?>admin/user/delete',
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