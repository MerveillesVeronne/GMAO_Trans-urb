@extends('layouts.app')
@section('title', "GMAO Trans'urb - Maintenance")

@section('content')
    <!-- Header -->
    <header class="bg-green-900 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo et titre -->
                <div class="flex items-center space-x-4">
                    <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                        <i class="fas fa-tools text-green-800 text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-white font-semibold">Module Maintenance</span>
                </div>
            </div>
        </div>
    </header>
    <!-- Navigation -->
    <nav class="bg-green-800 py-2 shadow">
        <div class="max-w-7xl mx-auto flex gap-4 px-4">
            <a href="{{ route('maintenance.index') }}" class="text-white font-semibold hover:underline">Accueil</a>
            <a href="{{ route('maintenance.vehicules.index') }}" class="text-white font-semibold hover:underline">Véhicules</a>
            <a href="{{ route('maintenance.interventions.index') }}" class="text-white font-semibold hover:underline">Interventions</a>
            <a href="{{ route('maintenance.pieces.index') }}" class="text-white font-semibold hover:underline">Pièces</a>
            <a href="{{ route('maintenance.planning.index') }}" class="text-white font-semibold hover:underline">Planning</a>
        </div>
    </nav>
    <!-- Statistiques -->
    <div class="max-w-7xl mx-auto mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
            <span class="text-green-900 font-bold text-2xl">0</span>
            <span class="text-green-800 mt-2">Véhicules</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
            <span class="text-green-900 font-bold text-2xl">0</span>
            <span class="text-green-800 mt-2">Interventions</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
            <span class="text-green-900 font-bold text-2xl">0</span>
            <span class="text-green-800 mt-2">Pièces en stock</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
            <span class="text-green-900 font-bold text-2xl">0</span>
            <span class="text-green-800 mt-2">Planning</span>
        </div>
    </div>
@endsection 