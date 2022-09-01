<script type="text/javascript">
    $(document).ready(function() {
        $("#card-detail").hide()
        $("hr").hide()

        $("#detail").on('click', function() {
            $("#card-detail").toggle('slow')
            $("hr").toggle('slow')
        })

        $(document).on('click', '.ya-batalkan-permohonan-pinjam', function(e) {
            e.preventDefault();
            $('.notif').html('Loading...');
            let id = $(".btn-batal-permohonan-pinjam").attr('id')
            $.ajax({
                url: '<?= base_url() ?>mahasiswa/pinjam_alat/batalkan',
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


        $(document).on('click', '.ya-batalkan-bebas-lab', function(e) {
            e.preventDefault();
            $('.notif').html('Loading...');
            let id = $(".btn-batalkan-bebas-lab").attr('id')
            $.ajax({
                url: '<?= base_url() ?>mahasiswa/bebas_lab/batalkan',
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