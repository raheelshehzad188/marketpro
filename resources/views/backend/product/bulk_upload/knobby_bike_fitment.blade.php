@extends('backend.layouts.app')

@section('content')
    <!-- Bike Fitment Data Upload Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Knobby Data Upload for Brand, Model, Year, and Manufacturer') }}</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <strong>{{ translate('Instructions:') }}</strong>
                <p>1.
                    {{ translate('Download the skeleton file and fill it with the appropriate data for Brand, Model, Year, and Manufacturer in the respective columns.') }}
                </p>
                <p>2. {{ translate('You can download the example file to understand how the data must be filled.') }}</p>
                <p>3. {{ translate('Once you have filled the skeleton file, upload it using the form below and submit.') }}
                </p>
                <p>4. {{ translate('After uploading, edit the entries to set additional details if needed.') }}</p>
                <p><a href="{{ static_asset('download/bike_fitment_data_sample.xlsx') }}" target="_blank">
                        <button class="btn btn-primary">{{ translate('Download CSV Template') }}</button>
                    </a></p>
            </div>


            <form id="bike-fitment-upload-form" class="form-horizontal mt-3" action="{{ route('bike_fitment_data_upload') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <label class="custom-file-label">
                                <input type="file" name="bulk_file" class="custom-file-input" required>
                                <span class="custom-file-name">{{ translate('Choose File') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 mt-3">
                    <button type="submit" id="upload-btn" class="btn btn-info">{{ translate('Upload') }}</button>
                </div>
            </form>

            <!-- Placeholder for Progress Bar -->
            <div id="progress-bar-container"></div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const importProgressUrl = "{{ route('import.progress', ['importId' => ':importId']) }}";
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('bike-fitment-upload-form');
            const uploadBtn = document.getElementById('upload-btn');
            const spinner =
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                uploadBtn.disabled = true;
                uploadBtn.innerHTML =
                    `${spinner} Uploading... 0 rows processed`; // Show the spinner and initial progress

                // Generate a unique import ID on the client side
                const importId = 'import_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);

                const formData = new FormData(form);
                formData.append('import_id', importId); // Attach the unique import ID to the form data

                // Start polling for progress immediately
                fetchImportProgress(importId);

                // Start the file upload
                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Import is complete when the request responds successfully
                            clearInterval(window.importProgressInterval); // Stop polling
                            uploadBtn.innerHTML = 'Upload Complete'; // Update button text when complete
                            AIZ.plugins.notify('success',
                                'Upload started successfully.');
                            setTimeout(() => {
                                resetUploadButton();
                            }, 3000); // Reset after 3 seconds
                        } else {
                            handleUploadError('An error occurred during processing. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error during file upload and processing:', error);
                        handleUploadError('There was an error uploading the file. Please try again.');
                    });
            });

            function fetchImportProgress(importId) {
                const url = importProgressUrl.replace(':importId',
                importId); // Replace placeholder with actual importId
                window.importProgressInterval = setInterval(() => {
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            const processedRows = data.processed_rows || 0;
                            uploadBtn.innerHTML =
                                `${spinner} Uploading... ${processedRows} rows processed`; // Update button text with progress

                            // If import is complete, stop polling
                            if (data.status === 'completed') {
                                clearInterval(window.importProgressInterval);
                                uploadBtn.innerHTML =
                                'Upload Complete'; // Update button text when complete
                                AIZ.plugins.notify('success',
                                    'Upload process has been completed successfully.');
                                setTimeout(() => {
                                    resetUploadButton();
                                }, 3000); // Reset after 3 seconds
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching progress:', error);
                            AIZ.plugins.notify('danger', 'Error fetching progress. Please try again.');
                        });
                }, 2000); // Check progress every 2 seconds
            }

            function resetUploadButton() {
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = 'Upload CSV'; // Reset the button text
            }

            function handleUploadError(message) {
                console.error(message);
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = 'Upload CSV'; // Reset the button text
                AIZ.plugins.notify('danger', message); // Show error notification to the user
            }
        });
    </script>
@endsection
