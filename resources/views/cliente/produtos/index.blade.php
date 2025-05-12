<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row justify-content-start mt-5">
                @foreach ($produtos as $produto)
                    <div class="col-md-6 col-lg-4 col-xl-3 d-flex mb-4">
                        <div class="card flex-fill position-relative rounded border-0 shadow-sm hover-shadow"
                            style="width: 100%;">
                            <img src="{{ $produto->foto_url }}" class="card-img-top rounded"
                                alt="{{ $produto->nome }}" style="height: 200px; object-fit: cover;">

                            <div class="card-body d-flex flex-column">
                                <h3 class="card-title fs-5 text-gray-900 dark:text-gray-100">{{ $produto->nome }}</h3>
                                <p class="text-gray-700 dark:text-gray-300">R$ {{ number_format($produto->valor, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
