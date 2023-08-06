<script>
    $('#name').on('keyup blur', function() {
        let permalink = $(this).val().toLowerCase()
            .trim().replace(/[\/\\]/g, '').replace(/\s+/g,
                ' ').replace(/[^a-z0-9- ]/gi, '').replace(/-+/g, '-').replace(/\s/g, '-');
        $('#slug').val(permalink);
    });
</script>
