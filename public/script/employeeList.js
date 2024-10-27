<script>
    $(document).ready(function() {
        // Show create employee modal when button is clicked
        $('#openCreateModal').on('click', function () {
            console.log("Clicked on create modal button!");
            $('#createemployeeModal').modal('show');
        });

        // Set up CSRF token for Ajax requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle form submission
        $('#employeeForm').on('submit', function(e) {
            e.preventDefault();

            // Get form data
            var formData = new FormData(this);

            // Send Ajax request to add employee
            $.ajax({
                type: 'POST',
                url: '/employee-panel/employees/addemp',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert('Employee added successfully!');
                    $('#createemployeeModal').modal('hide');
                    console.log("Modal hidden after success");
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessages = '';

                    // Collect error messages from response
                    $.each(errors, function(key, value) {
                        errorMessages += value[0] + '\n';
                    });

                    alert(errorMessages);
                }
            });
        });
    });
</script>
