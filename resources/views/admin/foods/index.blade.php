<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Master Data Makanan
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('foods.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md">
            + Tambah Makanan
        </a>

        @if(session('success'))
            <div class="mt-4 p-3 rounded-md bg-green-100 border border-green-400 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full bg-white border mt-4 shadow rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-100 border-b text-gray-600 text-sm">
                    <th class="p-3">Gambar</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($foods as $food)
                    <tr class="border-b text-center text-sm">
                        <td class="p-3">
                            @if($food->image)
                                <img src="{{ asset('storage/' . $food->image) }}"
                                    class="w-16 h-16 object-cover mx-auto rounded-lg">
                            @else
                                <span class="text-gray-400 text-xs">No Image</span>
                            @endif
                        </td>

                        <td class="p-3 font-semibold">{{ $food->name }}</td>

                        <td class="p-3">{{ $food->category }}</td>

                        <td class="p-3 font-bold text-green-600">
                            Rp {{ number_format($food->price) }}
                        </td>

                        <td class="p-3">
                            <a href="{{ route('foods.edit', $food->id) }}"
                                class="text-blue-600 hover:underline mr-3 font-semibold">
                                Edit
                            </a>

                            <form action="{{ route('foods.destroy', $food->id) }}"
                                method="POST" class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $foods->links() }}
        </div>
    </div>
</x-app-layout>