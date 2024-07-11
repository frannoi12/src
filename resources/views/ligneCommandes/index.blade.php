<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ligne Commandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Liste des ligne commandes') }}
                </div>
                <div>
                    <a href="{{ route('ligneCommandes.create') }}">
                        <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Ajouter</button>
                    </a>
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 w-full space-y-6">
                    <div class="w-full">
                        <form action="{{ route('ligneCommandes.index') }}" method="get">
                            @csrf
                            <input type="text" name="search" placeholder="Rechercher" class="w-2/3 rounded-md border border-gray-300">
                            <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Rechercher</button>
                        </form>
                    </div>
                    <table class="w-full text-left">
                        <thead class="text-lg font-semibold bg-gray-300">
                            <th class="py-3 px-6">Quantité</th>
                            <th class="py-3 px-6">Produit ID</th>
                            <th class="py-3 px-6">Commande ID</th>
                            <th class="py-3 px-6">Actions</th>
                        </thead>
                        <tbody>
                            @forelse ($ligneCommandes as $ligneCommande)
                                <tr class="bg-gray-100">
                                   <td class="py-3 px-6">{{ $ligneCommande->quantite }}</td>
                                    <td class="py-3 px-6">{{ $ligneCommande->produit_id }}</td>
                                    <td class="py-3 px-6">{{ $ligneCommande->commande_id }}</td>
                                    <td class="py-3 px-6">
                                        <a href="{{ route('ligneCommandes.edit', $ligneCommande->id) }}">
                                            <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Editer</button>
                                        </a>
                                        <a href="{{ route('ligneCommandes.show', $ligneCommande->id) }}">
                                            <button class="bg-yellow-600 hover:bg-yellow-500 text-white text-sm px-3 py-2 rounded-md">Consulter</button>
                                        </a>
                                        <form action="{{ route('ligneCommandes.destroy', $ligneCommande->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette ligne de commande ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3">Aucune ligne de commande disponible</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $ligneCommandes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
