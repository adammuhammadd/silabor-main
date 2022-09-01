<script type="text/javascript">
    $(document).ready(function() {
        let id_permohonan = <?= $user->id_permohonan_pinjam_alat ?>;

        $(document).on('click', '.ya-diambil', function(e) {
            e.preventDefault();

            let dataToSend = []
            $(".alat").each(function(e, i) {
                let id_pinjam = $(this).find('.id_pinjam').first().val();

                let result = {
                    id_pinjam,
                }

                dataToSend.push(result)
            });


            $('.notif').html('Loading...');

            $.ajax({
                url: '<?= base_url() ?>laboran/pengambilan_alat/diambil',
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
                            location.reload()
                        }, 1000);
                    } else {
                        $('.notif').html(msg.text);
                    }
                }
            });
        })
    })
</script>