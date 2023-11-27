// $(document).ready(function() {
//     $('#search-input').keyup(function() {
//         var search = $(this).val();

//         $.ajax({
//             url: 'index.php',
//             type: 'GET',
//             data: {search: search},
//             success: function(data) {
//                 var content = JSON.parse(data);

//                 // Display the search results in the input field.
//                 $('#search-input').autocomplete({
//                     source: content,
//                     select: function(event, ui) {
//                         $('#search-input').val(ui.item.label);
//                     }
//                 });
//             }
//         });
//     });
// });