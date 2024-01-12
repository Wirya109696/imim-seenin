// document.addEventListener('DOMContentLoaded', function() {
//     // Initialize Jspreadsheet
//     var mySpreadsheet = jspreadsheet(document.getElementById('spreadsheet-container'), {
//       // Jspreadsheet configuration options
//       // ...
//     });

//     // Fetch data from Laravel backend
//     fetch('/dashboard/list')
//       .then(response => response.json())
//       .then(data => {
//         // Iterate over the data and add rows to the spreadsheet
//         data.forEach(function(item) {
//           mySpreadsheet.insertRow(item.id - 1, [item.title, item.excerpt, item.body /*...*/]);
//         });
//       })
//       .catch(error => console.error('Error fetching data:', error));
//   });

// // $(document).ready(function () {
// //     var table = $('#tableuser').DataTable({
// //         processing: true,
// //         serverSide: true,
// //         ajax:  window.url + "/configuration/users/json",
// //         columns: [
// //             {data: 'DT_RowIndex', name: 'DT_RowIndex'},
// //             {data: 'name', name: 'name'},
// //             {data: 'username', name: 'username'},
// //             {data: 'email', name: 'email'},
// //             {
// //               data: 'status',
// //               name: 'status',
// //               orderable: true,
// //               searchable: true
// //             },
// //             {
// //                 data: 'action',
// //                 name: 'action',
// //                 orderable: true,
// //                 searchable: true
// //             },
// //         ],
// //         columnDefs: [
// //             { targets: [0, 1, 2,3,4,5], className: "text-center" },
// //           ],
// //     });
// // });
