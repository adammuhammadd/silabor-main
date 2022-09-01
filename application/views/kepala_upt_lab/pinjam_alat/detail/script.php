<script type="text/javascript">
    $(document).ready(function() {
        let id_permohonan = <?= $user->id_permohonan_pinjam_alat ?>;

        $('.btn-terima').click(function() {
            $('.notif').html('');
        });

        $(document).on('click', '.ya-terima', function(e) {
            e.preventDefault();


            $('.notif').html('Loading...');

            $.ajax({
                url: '<?= base_url() ?>kepala_upt_lab/pinjam_alat/terima',
                data: {
                    'id_permohonan': id_permohonan,
                },
                type: 'POST',
                dataType: 'JSON',
                success: function(msg) {
                    console.log(msg);
                    if (msg.status == 'success') {
                        $('.notif').html(msg.text);
                        setTimeout(() => {
                            location.reload()
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
                url: '<?= base_url() ?>kepala_upt_lab/pinjam_alat/tolak',
                data: {
                    'id_permohonan': id_permohonan,
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