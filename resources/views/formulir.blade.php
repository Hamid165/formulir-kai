@extends('layouts.app')

@section('title', 'Kategori Formulir')

@section('content')
<!-- Content Wrapper -->
<div x-data="{ activeTab: 'All' }" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center shadow-sm">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Katalog Formulir</h1>
                <p class="text-sm text-gray-500 mt-1">Sistem Informasi Manajemen Formulir</p>
            </div>
        </div>
    </div>



    <!-- Tabs -->
    <div class="bg-gray-100 rounded-lg p-1.5 mb-8 flex space-x-1 w-full border border-gray-200 overflow-x-auto">
        <a href="{{ route('formulir.index', ['kategori' => 'All']) }}" class="flex-1 text-center py-2 px-4 rounded-md text-sm font-semibold transition-colors whitespace-nowrap {{ $activeTab === 'All' ? 'bg-white shadow-sm text-blue-600' : 'text-gray-600 hover:text-gray-900' }}">All</a>
        <a href="{{ route('formulir.index', ['kategori' => 'Umum']) }}" class="flex-1 text-center py-2 px-4 rounded-md text-sm font-semibold transition-colors whitespace-nowrap {{ $activeTab === 'Umum' ? 'bg-white shadow-sm text-blue-600' : 'text-gray-600 hover:text-gray-900' }}">Umum</a>
        <a href="{{ route('formulir.index', ['kategori' => 'Public']) }}" class="flex-1 text-center py-2 px-4 rounded-md text-sm font-semibold transition-colors whitespace-nowrap {{ $activeTab === 'Public' ? 'bg-white shadow-sm text-blue-600' : 'text-gray-600 hover:text-gray-900' }}">Public</a>
        <a href="{{ route('formulir.index', ['kategori' => 'Terbatas']) }}" class="flex-1 text-center py-2 px-4 rounded-md text-sm font-semibold transition-colors whitespace-nowrap {{ $activeTab === 'Terbatas' ? 'bg-white shadow-sm text-blue-600' : 'text-gray-600 hover:text-gray-900' }}">Terbatas</a>
    </div>

    <!-- List of Forms -->
    <div class="space-y-2 relative min-h-[200px]">
        
        @forelse ($formulirs as $form)
        <div class="block {{ !$loop->first ? 'mt-2' : '' }}">
            <a href="{{ $form['route'] }}" class="block">
                <div class="bg-white hover:bg-blue-50 rounded-xl shadow-sm border border-gray-200 hover:border-blue-200 p-4 flex items-center gap-4 hover:shadow-md transition-all group cursor-pointer">
                    <div class="flex-1 grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-4">
                            <p class="text-xs text-gray-500 font-medium mb-0.5">Formulir</p>
                            <p class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $form['nama'] }}</p>
                        </div>
                        <div class="col-span-4 text-center">
                            <p class="text-xs text-gray-500 font-medium mb-0.5">Kategori</p>
                            <p class="text-sm font-medium text-gray-900">{{ $form['kategori'] }}</p>
                        </div>
                        <div class="col-span-4 flex justify-end items-center gap-4">
                            <div class="text-right">
                                <p class="text-xs text-gray-500 font-medium mb-0.5">Total Data</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $form['total'] }} Formulir</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <!-- Empty State -->
        <div class="text-center py-12 absolute inset-0">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada formulir</h3>
            <p class="mt-1 text-sm text-gray-500">Tidak ada formulir dalam kategori ini.</p>
        </div>
        @endforelse

        @if($formulirs->hasPages())
            <div class="mt-4 pt-4 border-t border-gray-100 pb-2">
                {{ $formulirs->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection
