@extends('layouts.app')
@section('title', "GMAO Trans'urb - Interventions")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-tools text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Interventions</span>
        </div>
    </header>
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-700">
            <span class="text-green-900 font-bold text-2xl">12</span>
            <span class="text-green-800 mt-2">En Cours</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-500">
            <span class="text-green-900 font-bold text-2xl">45</span>
            <span class="text-green-800 mt-2">Terminées</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-400">
            <span class="text-green-900 font-bold text-2xl">8</span>
            <span class="text-green-800 mt-2">En Attente</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-300">
            <span class="text-green-900 font-bold text-2xl">3</span>
            <span class="text-green-800 mt-2">Urgentes</span>
        </div>
    </div>
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-green-900">
                <i class="fas fa-list text-green-700 mr-2"></i>
                Interventions Récentes
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Véhicule</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Technicien</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-green-100">
                    <tr class="hover:bg-green-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-bus text-white"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-green-900">BUS-002</div>
                                    <div class="text-sm text-green-700">Révision moteur</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Maintenance</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-200 text-green-900">
                                <i class="fas fa-circle text-green-500 mr-1"></i>En Cours
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">20/01/2024</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">Jean Dupont</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-green-700 hover:text-green-900 mr-3">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-green-600 hover:text-green-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-green-500 hover:text-green-900">
                                <i class="fas fa-check"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Autres lignes à adapter de la même façon -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
