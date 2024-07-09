<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détail du Produit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Détail du produit") }}
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                   <div class="space-y-6">
                       <div class="flex space-x-3 items-center">
                           <div class="space-y-2 w-1/3">
                               <label for="libelle">{{__("Libellé")}}</label>
                               <p class="border-red-300 rounded-md w-full p-2" style="background: white">{{ $produit->libelle }}</p>
                           </div>
                           <div class="space-y-2 w-1/3">
                               <label for="prix">{{__("Prix")}}</label>
                               <p class="border-gray-300 rounded-md w-full p-2" style="background: white">{{ $produit->prix }} FrcFa</p>
                           </div>
                       </div>
                       <div class="flex space-x-3 items-center">
                           <div class="space-y-2 w-1/3">
                               <label for="quantite">{{__("Quantité")}}</label>
                               <p class="border-gray-300 rounded-md w-full p-2" style="background: white">{{ $produit->quantite }}</p>
                           </div>
                           <div class="space-y-2 w-1/3">
                               <label for="image">{{__("Image")}}</label>
                               @if ($produit->image)
                                   <div class="mt-2">
                                       <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->libelle }} Image" style="width: 100px; height: 100px;">
                                   </div>
                               @else
                                   <p>{{ __("Pas d'image disponible") }}</p>
                               @endif
                           </div>
                       </div>
                   </div>
                   <div>
                       <a href="{{ route('produits.index') }}" class="mt-6 bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">
                           {{ __("Retour à la liste") }}
                       </a>
                   </div>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
