<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('click', '.detail', function(e) {
            e.preventDefault();
            $('.notif').html('Loading...');
            let id = $(this).attr('id')
            let jenis = $(this).attr('name')

            window.location.href = `<?= base_url('kepala_lab/bebas_lab/detail/') ?>${id}`;
        });

    })
</script>