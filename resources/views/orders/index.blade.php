<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="px-3 py-4">
                        <div class="d-flex justify-content-between gap-10 flex-wrap align-items-center">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{route('orders.create')}}" type="button" class="btn btn-primary text-nowrap">
                                    <i class="tio-add"></i>
                                    {{ __('add new order') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100 text-start">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ __('SL') }}</th>
                                    <th>{{ __('order_ID') }}</th>
                                    <th>{{ __('order_Date') }}</th>
                                    <th>{{ __('user_Info') }}</th>
                                    <th class="text-center">{{ __('status') }} </th>
                                    <th class="text-center">{{ __('action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>
                                            {{ $orders->firstItem() + $key }}
                                        </td>
                                        <td>
                                            {{ $order['id'] }}
                                        </td>
                                        <td>
                                            <div>{{ date('d M Y', strtotime($order['created_at'])) }},</div>
                                            <div>{{ date('h:i A', strtotime($order['created_at'])) }}</div>
                                        </td>
                                        <td>
                                                @if ($order->user)
                                                    <strong class="title-name">
                                                        {{ $order->user->name}}
                                                    </strong>
                                                @else
                                                    <label
                                                        class="badge badge-danger fz-12">{{ __('invalid_user_data') }}</label>
                                                @endif
                                        </td>
                                        <td class="text-center text-capitalize">
                                            {{ $order->status }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a class="btn btn-primary btn-sm cursor-pointer edit"
                                                    href="{{ route('orders.edit', [$order->id]) }}"
                                                    title="{{ __('edit') }}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a title="{{ __('delete') }}"
                                                    class="btn btn-danger btn-sm delete-data"
                                                    href="javascript:" data-id="order-{{ $order->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                            <form action="{{ route('orders.delete', [$order->id]) }}" method="post"
                                                id="order-{{ $order->id }}">
                                                @csrf @method('delete')
                                                <input type="hidden" name="id" value="{{$order->id}}">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            {!! $orders->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span id="get-confirm-and-cancel-button-text-for-delete" data-sure ="{{__('are you sure to delete this').'?'}}"
      data-text="{{__('you will not be able to revert this').'!'}}"
      data-confirm="{{__('yes delete it')}}" data-cancel="{{__('cancel')}}"></span>
</x-app-layout>
<script>
    $('.delete-data').on('click', function () {
    let getText = $('#get-confirm-and-cancel-button-text-for-delete');
    Swal.fire({
        title: getText.data('sure'),
        text: getText.data('text'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: getText.data('cancel'),
        confirmButtonText: getText.data('confirm'),
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $('#' + $(this).data('id')).submit()
        }
    })
})
</script>
