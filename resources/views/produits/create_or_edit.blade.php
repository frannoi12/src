<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ isset($produit) ? __("Modifier le produit") : __("Ajouter un nouveau produit") }}
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                <form action="{{ isset($produit) ? route('produits.update', $produit->id) : route('produits.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($produit))
                        @method('PUT')
                    @endif
                    <div class="space-y-6">
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="libelle">{{ __("Libellé") }}</label>
                                <input type="text" name="libelle" id="libelle" class="border-gray-300 rounded-md w-full" value="{{ old('libelle', isset($produit) ? $produit->libelle : '') }}">
                            </div>
                            <div class="space-y-2 w-1/3">
                                <label for="prix">{{ __("Prix") }}</label>
                                <input type="number" name="prix" id="prix" class="border-gray-300 rounded-md w-full" value="{{ old('prix', isset($produit) ? $produit->prix : '') }}">
                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="quantite">{{ __('Quantité') }}</label>
                                <input type="number" name="quantite" id="quantite" class="border-gray-300 rounded-md w-full" value="{{ old('quantite', isset($produit) ? $produit->quantite : '') }}">
                            </div>
                            <div class="space-y-2 w-1/3">
                                <label for="image">{{ __("Image") }}</label>
                                <input type="file" name="image" id="image" class="border-gray-800 rounded-md w-full">
                                @if(isset($produit) && $produit->image)
                                    <img src="{{ asset('storage/' . $produit->image) }}" alt="Image de {{ $produit->libelle }}" class="mt-2 w-16 h-16 object-cover">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="mt-6 bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">
                            {{ isset($produit) ? __("Mettre à jour") : __("Ajouter") }}
                        </button>
                    </div>
                </form>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
