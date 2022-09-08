<script type="text/javascript">
    $(document).ready(function() {
        let id_permohonan = <?= $user->id_permohonan_pinjam_alat ?>;

        $('.btn-terima').click(function() {
            $('.notif').html('');
            let valid_kondisi = '';
            $(".alat").each(function(e, i) {
                let kondisi = $(this).find('.kondisi').first().val()

                if (kondisi == null) {
                    valid_kondisi = 'tidak valid'
                    return
                }
            });

            if (valid_kondisi == 'tidak valid') {
                $('#body-modal').html('<div class="alert alert-danger">Kondisi alat belum dikonfirmasi, harap konfirmasi terlebih dahulu !</div>')
                $('.modal-footer').hide()
                return
            }

            if (valid_kondisi == '') {
                $('#body-modal').html('<div>Anda yakin ingin menerima pengajuan ?</div>')
                $('.modal-footer').show()
                return
            }
        });

        $(document).on('click', '.ya-terima', function(e) {
            e.preventDefault();

            let dataToSend = []
            $(".alat").each(function(e, i) {
                let id_pinjam = $(this).find('.id_pinjam').first().val();
                let kondisi = $(this).find('.kondisi').first().val()

                let result = {
                    id_pinjam,
                    kondisi
                }

                dataToSend.push(result)
            });


            $('.notif').html('Loading...');

            $.ajax({
                url: '<?= base_url() ?>laboran/pengajuan_pinjam_alat/terima',
                data: {
                    'id_permohonan': id_permohonan,
                    'data': dataToSend
                },
                type: 'POST',
                dataType: 'JSON',
                success: function(msg) {
                    console.log(msg);
                    if (msg.status == 'success') {
                        $('.notif').html(msg.text);
                        setTimeout(() => {
                            window.location.href = '<?= base_url() ?>laboran/pengajuan_pinjam_alat';

                        }, 1000);
                    } else {
                        $('.notif').html(msg.text);
                    }
                }
            });
        })


        $(document).on('click', '.ya-tolak', function(e) {
            e.preventDefault();
            $('.notif').html('Loading...');
            let id = $(".btn-tolak").attr('id')
            $.ajax({
                url: '<?= base_url() ?>laboran/pengajuan_pinjam_alat/tolak',
                data: {
                    'id': id
                },
                type: 'POST',
                dataType: 'JSON',
                success: function(msg) {
                    console.log(msg);
                    if (msg.status == 'success') {
                        $('.notif').html(msg.text);
                        location.reload();
                    } else {
                        $('.notif').html(msg.text);
                    }
                }
            });
        });
    })
</script>