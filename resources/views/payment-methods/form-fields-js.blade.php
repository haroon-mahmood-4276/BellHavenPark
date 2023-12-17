<script>
    $('#name').on('keyup blur', function() {
        let permalink = $(this).val().toLowerCase()
            .trim().replace(/[\/\\]/g, '').replace(/\s+/g,
                ' ').replace(/[^a-z0-9- ]/gi, '').replace(/-+/g, '-').replace(/\s/g, '-');
        $('#slug').val(permalink);
    });

    linked_account = $("#linked_account");
    linked_account.wrap('<div class="position-relative"></div>');
    linked_account.select2({
        dropdownAutoWidth: !0,
        dropdownParent: linked_account.parent(),
        width: "100%",
        containerCssClass: "select-lg",
        templateResult: function(e) {
            return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
        },
        templateSelection: function(e) {
            return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
        },
        escapeMarkup: function(linked_account) {
            return linked_account
        }
    });
</script>
