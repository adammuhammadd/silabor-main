<script type="text/javascript">
    $(document).ready(function() {
        let id = <?= $user->id_permohonan_bebas_lab ?>;
        
        $(document).on('click', '.ya-terima', function(e) {
            e.preventDefault();
            var data = $('#form-index').serialize();

            $('.notif').html('Loading...');

            $.ajax({
                url: '<?= base_url() ?>kepala_upt_lab/bebas_lab/terima',
                data: {
                    'id': id,
                    'no_surat': data
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
            $.ajax({
                url: '<?= base_url() ?>kepala_upt_lab/bebas_lab/tolak',
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