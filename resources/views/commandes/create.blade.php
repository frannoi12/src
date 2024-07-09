<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Commandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Ajouter une nouvelle commande") }}
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                <form action="{{route("commandes.store")}}" method="post">
                    @csrf
                    <div class="space-y-6">
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="client" class="block text-sm font-medium text-black-700">{{ __('Client') }}</label>
                                <input type="text" name="client" id="client" value="{{ old('client') }}" class="border-gray-300 rounded-md w-full" required>
                                @error('client')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2 w-1/3">
                                <label for="montant" class="block text-sm font-medium text-black-700">{{ __('Montant') }}</label>
                                <input type="number" name="montant" id="montant" value="{{ old('montant') }}" class="border-gray-300 rounded-md w-full" required>
                                @error('montant')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="vendeur_id" class="block text-sm font-medium text-black-700">{{ __('Vendeur') }}</label>
                                <select name="vendeur_id" id="vendeur_id" class="border-gray-300 rounded-md w-full" required>
                                    <option value="" disabled selected>{{ __('Sélectionnez un vendeur') }}</option>
                                    @foreach($vendeurs as $id => $name)
                                        <option value="{{ $id }}" {{ old('vendeur_id') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vendeur_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">
                                {{ __('Ajouter') }}
                            </button>
                        </div>
                    </div>
                </form>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>


