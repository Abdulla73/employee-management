
// <script>
//     $(document).ready(function() {
//         $('#openCreateModal').on('click', function () {
//             console.log("Clicked on create modal button!");
//             $('#createemployeeModal').modal('show');
//         });

//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });

//         $('#employeeForm').on('submit', function(e) {
//             e.preventDefault();
//             var formData = new FormData(this);
//             $.ajax({
//                 type: 'POST',
//                 url: '/employee-panel/employees/addemp',
//                 data: formData,
//                 contentType: false,
//                 processData: false,
//                 success: function(response) {
//                     alert('Employee added successfully!');
//                     $('#createemployeeModal').modal('hide');
//                     console.log("Modal hidden after success");
//                 },
//                 error: function(xhr, status, error) {
//                     var errors = xhr.responseJSON.errors;
//                     var errorMessages = '';

//                     // Collect error messages from response
//                     $.each(errors, function(key, value) {
//                         errorMessages += value[0] + '\n';
//                     });

//                     alert(errorMessages);
//                 }
//             });
//         });
//     });
// </script>
