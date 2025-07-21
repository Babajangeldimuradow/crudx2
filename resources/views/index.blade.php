<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('messages.app_title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <!-- Baş sahypa başlygy we dropdown -->
        <div class="jumbotron jumbotron-fluid bg-danger p-4 mb-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="display-4">{{ __('messages.cars') }}</h1>
                        <p class="lead">{{ __('messages.welcome') }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <!-- Dil saýlaw dropdown -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ strtoupper(app()->getLocale()) }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}">English</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['lang' => 'tk']) }}">Türkmençe</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['lang' => 'ru']) }}">Русский</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Surat üçin aýratyn row -->
        <div class="row mb-4">
            <div class="col-md-6">
                <img src="" alt="" class="img-fluid" />
            </div>
        </div>

        <div class="row">
            <!-- Maglumat goşmak formasy -->
            <div class="col-md-6">
                <h2>{{ __('messages.create_car') }}</h2>
                <form action="{{ route('cars.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="make" class="form-label">{{ __('messages.make') }}</label>
                        <input type="text" name="make" id="make" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">{{ __('messages.model') }}</label>
                        <input type="text" name="model" id="model" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="produced_on" class="form-label">{{ __('messages.produced_on') }}</label>
                        <input type="date" name="produced_on" id="produced_on" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">{{ __('messages.car_image') }}</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" />
                    </div>
                    <button type="submit" class="btn btn-success w-100">{{ __('messages.create') }}</button>
                </form>
            </div>

            <!-- Maglumatlar sanawy we gözleg -->
            <div class="col-md-6">
                <h2>{{ __('messages.car_list') }}</h2>
                <form action="{{ route('cars.show') }}" method="GET" class="mb-3">
                    <div class="input-group mb-2">
                        <input type="text" name="search" class="form-control" placeholder="{{ __('messages.search') }}..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">{{ __('messages.search') }}</button>
                    </div>
                    <div class="input-group">
                        <label class="input-group-text" for="sort">{{ __('messages.search') }}</label>
                        <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                            <option value="make_asc" {{ request('sort') == 'make_asc' ? 'selected' : '' }}>{{ __('messages.make') }} (A-Z)</option>
                            <option value="make_desc" {{ request('sort') == 'make_desc' ? 'selected' : '' }}>{{ __('messages.make') }} (Z-A)</option>
                            <option value="model_asc" {{ request('sort') == 'model_asc' ? 'selected' : '' }}>{{ __('messages.model') }} (A-Z)</option>
                            <option value="model_desc" {{ request('sort') == 'model_desc' ? 'selected' : '' }}>{{ __('messages.model') }} (Z-A)</option>
                            <option value="produced_on_asc" {{ request('sort') == 'produced_on_asc' ? 'selected' : '' }}>{{ __('messages.produced_on') }} (Oldest)</option>
                            <option value="produced_on_desc" {{ request('sort') == 'produced_on_desc' ? 'selected' : '' }}>{{ __('messages.produced_on') }} (Newest)</option>
                        </select>
                    </div>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('messages.make') }}</th>
                            <th>{{ __('messages.model') }}</th>
                            <th>{{ __('messages.produced_on') }}</th>
                            <th>{{ __('messages.edit') }}/{{ __('messages.delete') }}</th>
                            <th>{{ __('messages.car_image') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cars as $car)
                            <tr>
                                <td>{{ $car->make }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->produced_on }}</td>
                                <td>
                                    <a href="{{ route('cars.edit', ['id' => $car->id]) }}" class="btn btn-sm btn-primary">{{ __('messages.edit') }}</a>
                                    <form action="{{ route('cars.destroy', ['id' => $car->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    @if($car->image)
                                        <img src="{{ asset('storage/' . $car->image) }}" width="100" alt="Car Image" />
                                    @else
                                        <span>{{ __('messages.no_image') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">{{ __('messages.no_data') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination düwmeleri -->
                <div class="d-flex justify-content-center my-4">
                    {{ $cars->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Dropdown üçin mühim!) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
