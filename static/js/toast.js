$('.toast').show();

// Close button not working correctly on toasts, quick workaround.
$('.btn-close').click(function() {
    $('.toast').hide();
});