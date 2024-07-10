<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Commandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div
                class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Liste des commandes') }}
                </div>
                <div>
                    <a href="{{ route('commandes.create') }}">
                        <button
                            class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Ajouter</button>
                    </a>
                </div>
            </div>
            <div
                class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 w-full space-y-6">
                    <div class="w-full">
                        <form action="{{ route('commandes.index') }}" method="get">
                            <input type="text" name="search" placeholder="Rechercher" "
                                class="w-2/3 rounded-md border border-gray-300">
                            <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">
                                {{ __('Rechercher') }}
                            </button>
                        </form>
                    </div>
                    <table class="w-full text-left">
                        <thead class="text-lg font-semibold bg-gray-300">
                            <th class="py-3 px-6">Vendeur</th>
                            <th class="py-3 px-6">Client</th>
                            <th class="py-3 px-6">Monant</th>
                            <th class="py-3 px-6">Actions</th>
                        </thead>
                        <tbody>
                            @forelse ($commandes as $commande)
                                <tr class="bg-gray-100">
                                    <td class="py-3 px-6">
                                        {{$commande->vendeur->name}}
                                    </td>
                                    <td class="py-3 px-6">
                                        {{$commande->client}}
                                    </td>
                                    <td class="py-3 px-6">
                                        {{$commande->montant}}
                                    </td>
                                    <td class="py-3 px-6">
                                        <a href="">
                                            <button class="bg-green-600 hover:bg-green-500 text-white text-sm px-3 py-2 rounded-md">
                                                {{__('Facture')}}
                                            </button>
                                        </a>
                                        <a href="{{route("commandes.edit",$commande->id)}}">
                                            <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">
                                                {{__("Editer")}}
                                            </button>
                                        </a>
                                        <a href="{{route("commandes.show",$commande->id)}}">
                                            @csrf
                                            <button class="bg-yellow-600 hover:bg-yellow-500 text-white text-sm px-3 py-2 rounded-md">
                                                {{__("Consulter")}}
                                            </button>
                                        </a>
                                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md">
                                                {{__("Supprimer")}}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-3 px-6 text-center">
                                    Aucune commande disponible
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        <!-- Pagination si vous voulez le faire -->
                        {{ $commandes->links() }}
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
