
// // Remove item and reload on click
// $('.remove-item').click(function(e) {
//     var csrfToken = "{{ csrf_token }}";
//     var itemId = $(this).attr('id');
//     var url = `/cart/remove/${itemId}/`;
//     var data = {'csrfmiddlewaretoken': csrfToken};

//     $.post(url, data)
//         .done(function() {
//             location.reload();
//         });
// })