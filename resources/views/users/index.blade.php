<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100 text-start">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ __('SL') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('email') }}</th>
                                    <th class="text-center">{{ __('action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>
                                            {{ $users->firstItem() + $key }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>


                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                {{-- <a class="btn btn-primary btn-sm cursor-pointer"
                                                    href="{{ route('users.communicate', [$user->id]) }}"
                                                    title="{{ __('communicate') }}">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </a> --}}
                                                <button class="btn btn-outline-info btn-sm communicate" data-user="{{$user['id']}}" type="button">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="toggle-communicate-modal" tabindex="-1" aria-labelledby="toggle-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                    <button type="button" class="btn-close border-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="tio-clear"></i>
                    </button>
                </div>
                <form id="communicateForm" class="text-start" action="{{route('users.communicate')}}" method="POST">
                    @csrf
                    <div class="modal-body px-4 px-sm-5 pt-0">
                        <div class="d-flex flex-column align-items-center text-center gap-2 mb-2">
                            <div class="row">
                                <div class="col-md-6 col-lg-4 col-xl-12">
                                    <div class="form-group">
                                        <label for="exampleTitle"
                                            class="title-color d-flex gap-1 align-items-center">{{ __('title') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="exampleTitle"
                                                name="title" value="{{ old('title') }}" placeholder="{{ __('title') }}"
                                                required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-12">
                                    <div class="form-group">
                                        <label for="exampleBody"
                                            class="title-color d-flex gap-1 align-items-center">{{ __('body') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="exampleBody" name="body"
                                            placeholder="{{ __('body') }}" required></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" class="adduser">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="submit" class="btn btn-primary send">{{__('submit')}}</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('cancel') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function(){
        $('#communicateForm').validate({
            rules: {
                title: {
                    required: true,
                },
                body: {
                    required: true,
                }
            },
            messages: {
                title: {
                    required: "{{__('title is required')}}",
                },
                body: {
                    required: "{{__('body is required')}}",
                }
            },
            submitHandler: function(form) {
                $('.send').attr('disabled',true);
                $('.send').html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                );
                // If the form is valid, submit it via AJAX
                var formData = $(form).serialize(); // Serialize form data
                var actionUrl = $(form).attr('action'); // Get form action URL
                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Show success message or handle response here
                        toastr.success(response.message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    },
                    error: function(error) {
                        // Handle errors here
                        $('.send').attr('disabled',false);
                        $('.send').html("{{__('submit')}}");
                        toastr.error(error.responseJSON.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                });
            }
        });
        // When the add button is clicked
        $('.communicate').on('click', function () {
            $('form').trigger('reset');
            var user = $(this).data('user'); // Get the user
            // Set the user in the modal
            $('.adduser').val(user);
            // Open the modal
            $('#toggle-communicate-modal').modal('show');
        });
    })
</script>
