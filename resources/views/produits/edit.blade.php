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
                    {{ __("Mise à jour d'un nouveau produit") }}
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                <form action="{{route("produits.update", $produit->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="libelle">{{__("Libellé")}}</label>
                                <input type="text" name="libelle" id="libelle" value="{{ $produit->libelle}}" class="border-gray-300 rounded-md w-full">
                            </div>
                            <div class="space-y-2 w-1/3">
                                <label for="prix">{{__("Prix")}}</label>
                                <input type="number" name="prix" id="prix" value="{{ $produit->prix }}" class="border-gray-300 rounded-md w-full">
                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="quantite">{{__("Quantité")}}</label>
                                <input type="number" name="quantite" id="quantite" value="{{ $produit->quantite }}" class="border-gray-300 rounded-md w-full">
                            </div>
                            <div class="space-y-2 w-1/3">
                                <label for="image">{{__("Image")}}</label>
                                <input type="file" name="image" id="image" class="border-gray-300 rounded-md w-full">
                                @if ($produit->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->libelle }} Image" style="width: 100px; height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="mt-6 bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">
                            {{__("Mettre à jour")}}
                        </button>
                    </div>
                </form>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
