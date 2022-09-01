<script type="text/javascript">
    $(document).ready(function() {
        var dataToSend = [];
        $('#body-modal').html('')
        $('.notif').html('');

        $('#table-1').DataTable({
            paging: false,
        });

        let melebihi = false

        $("#ajukan").on('click', function() {
            dataToSend = [];
            $(".alat").each(function(e) {
                let nama_alat = $(this).find('.nama_alat').first().text();
                let id_alat = $(this).find('.id_alat').first().text();
                let jml_alat = $(this).find('.jml_alat').first().val();
                let sisa = $(this).find('.sisa').first().text();

                let result

                if (jml_alat != 0) {
                    if (sisa - jml_alat < 0) {
                        melebihi = true
                        return
                    }
                    result = {
                        id_alat,
                        nama_alat,
                        jml_alat
                    }

                    dataToSend.push(result)
                }
            });

            if (melebihi == true) {
                $('#body-modal').html('')
                $('#body-modal').html(` <p class="text-danger">Jumlah alat yang di pinjam tidak boleh melampaui jumlah yang tersedia ! </p>`)
                $('.modal-footer').hide()
                return
            }

            if (dataToSend.length == 0) {
                $('#body-modal').html('')
                $('#body-modal').html(` <p class="text-danger"> Silahkan Pilih Alat Yang Ingin Dipinjam Terlebih Dahulu ! </p>`)
                $('.modal-footer').hide()
            } else {
                let element = '';
                dataToSend.forEach(e => {
                    $('#body-modal').html('')
                    element = element + `<div class="col-6"><p>${e.nama_alat}</p></div> <div class="col-6"><p>${e.jml_alat}x</p></div>`
                })

                $('#body-modal').append(element)
                $('.modal-footer').show()
            }
        });

        $(document).on('click', '.ya-ajukan', function(e) {
            e.preventDefault();
            $('.notif').html('Loading...');
            $.ajax({
                url: '<?= base_url() ?>mahasiswa/pinjam_alat/ajukan',
                data: {
                    'data': JSON.stringify(dataToSend)
                },
                type: 'POST',
                dataType: 'JSON',
                success: function(msg) {
                    console.log(msg);
                    if (msg.status == 'success') {
                        $('.notif').html(msg.text);
                        window.location.href = '<?= base_url('home') ?>';
                    } else {
                        $('.notif').html(msg.text);
                    }
                }
            });
        });
    })
</script>