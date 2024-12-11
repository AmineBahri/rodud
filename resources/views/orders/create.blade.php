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
                    <div class="row align-items-center">
                        <div class="col-lg-12 mb-4 mb-lg-0">
                            <form action="{{route('orders.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleLocation"
                                                class="title-color d-flex gap-1 align-items-center">{{ __('Location') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="exampleLocation"
                                                name="location" value="{{ old('location') }}" placeholder="{{ __('ex') }}: Madinah"
                                                required>
                                            @error('location')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleSize"
                                                class="title-color d-flex gap-1 align-items-center">{{ __('Size') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control" id="exampleSize"
                                                name="size" step="0.01" value="{{ old('size') }}" placeholder="{{ __('ex') }}: 10"
                                                required>
                                            @error('size')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleWeight"
                                                class="title-color d-flex gap-1 align-items-center">{{ __('Weight') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control" id="exampleWeight"
                                                name="weight" step="0.01" value="{{ old('weight') }}" placeholder="{{ __('ex') }}: 10"
                                                required>
                                            @error('weight')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="examplePickupTime"
                                                class="title-color d-flex gap-1 align-items-center">{{ __('Pickup time') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="datetime-local" class="form-control" id="examplePickupTime"
                                                name="pickup_time" value="{{ old('pickup_time') }}" placeholder="{{ __('ex') }}: 123456"
                                                required>
                                            @error('pickup_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleDeliveryTime"
                                                class="title-color d-flex gap-1 align-items-center">{{ __('Delivery time') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="datetime-local" class="form-control" id="exampleDeliveryTime"
                                                name="delivery_time" value="{{ old('delivery_time') }}" placeholder="{{ __('ex') }}: 123456"
                                                required>
                                            @error('delivery_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary text-nowrap">
                                            {{ __('submit') }}
                                        </button>
                                        <button type="reset" class="btn btn-danger text-nowrap">
                                            {{ __('reset') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
