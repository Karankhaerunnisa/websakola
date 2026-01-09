@php
    $visitorStats = \App\Models\VisitorStatistic::getStatistics();
@endphp

<footer id="footer-contact" class="bg-white border-t border-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">

            {{-- Visitor Statistics --}}
            <div class="mb-4">
                <div class="flex flex-wrap justify-center gap-4 md:gap-8 text-xs">
                    {{-- Online Now --}}
                    <div class="flex items-center space-x-2">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        <span class="text-gray-500">Online:</span>
                        <span class="font-bold text-green-600">{{ number_format($visitorStats['online']) }}</span>
                    </div>

                    {{-- Today's Visitors --}}
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-gray-500">Hari ini:</span>
                        <span class="font-bold text-blue-600">{{ number_format($visitorStats['today_visitors']) }}</span>
                    </div>

                    {{-- Today's Hits --}}
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span class="text-gray-500">Hits hari ini:</span>
                        <span class="font-bold text-purple-600">{{ number_format($visitorStats['today_hits']) }}</span>
                    </div>

                    {{-- Total Visitors --}}
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="text-gray-500">Total pengunjung:</span>
                        <span class="font-bold text-amber-600">{{ number_format($visitorStats['total_visitors']) }}</span>
                    </div>

                    {{-- Total Hits --}}
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="text-gray-500">Total kunjungan:</span>
                        <span class="font-bold text-red-600">{{ number_format($visitorStats['total_hits']) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
