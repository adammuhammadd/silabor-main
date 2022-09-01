<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('submit', '#form-index', function(e) {
            e.preventDefault();
            var data = new FormData(document.getElementById('form-index'));
            $('.notif').html('Loading...');
            $.ajax({
                url: '<?= base_url() ?>mahasiswa/bebas_lab/ajukan',
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
        });

        // $(document).on('click', '.ya-ajukan', function(e) {
        //     e.preventDefault();
        //     $('.notif').html('Loading...');
        //     var data = new FormData(document.getElementById('form-index'));
        //     console.log(data)
        //     $.ajax({
        //         url: '<?= base_url() ?>mahasiswa/bebas_lab/ajukan',
        //         data: data,
        //         type: 'POST',
        //         processData: false,
        //         contentType: false,
        //         dataType: "JSON",
        //         success: function(msg) {
        //             console.log(msg);
        //             if (msg.status == 'success') {
        //                 $('.notif').html(msg.text);
        //                 window.location.href = '<?= base_url('home') ?>';
        //             } else {
        //                 $('.notif').html(msg.text);
        //             }
        //         }
        //     });
        // });

        $(document).on('click', '.ya-batalkan', function(e) {
            e.preventDefault();
            $('.notif').html('Loading...');
            let id = $(".btn-batalkan").attr('id')
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