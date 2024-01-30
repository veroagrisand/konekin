@php
    $isJoined = Auth::user()->KEY == $komunitass->KEY || \App\Models\joins::where('id_komunitas', $komunitass->id_komunitas)->where('KEY', auth()->user()->KEY)->exists();
    $Joined =  \App\Models\joins::where('id_komunitas', $komunitass->id_komunitas)->where('KEY', auth()->user()->KEY)->exists();
    $events = \App\Models\kegiatan::where('id_komunitas', $komunitass->id_komunitas)->get();
@endphp

<x-app-layout>
    <section>
        <div class="container mx-auto mt-10 sm:p-6 md:p-4 p-6">
            @include('layouts.partials.H-profilcommunity')
            @if($isJoined)

            <div class="grid grid-cols-12 mt-5 flex gap-6 mb-10 flex-row">
                @if($events)
                @foreach($events as $event)
                <!-- Card Container -->
                <div href="#" class="col-span-6 flex flex-row p-2 h-60 bg-white border border-gray-200 rounded-lg items-center transform transition-all hover:-translate-y-2 duration-300">
                  <!-- Image Container -->
                  <div class="w-full h-full">
                    <img class="object-cover w-full h-full rounded" src="{{ asset ($event->gallery) }}" alt="">
                  </div>
                  <!-- Text Content Container -->
                  <div class="flex flex-col top-0 justify-between p-4">
                    <!-- Date and Time Section -->
                    <div class="flex flex-row gap-4 mt-7">
                      <p class="font-bold text-sm text-black">{{ $event->tgl_kegiatan }}</p>
                      <p class="font-bold text-sm text-black">{{ $event->jam_kegiatan }}</p>
                    </div>
                    <!-- Title and Description Section -->
                    <div class="mb-7">
                      <h5 class="text-2xl mt-6 font-bold text-black dark:text-white">{{ $event->nama_kegiatan }}</h5>
                      <p class="font-normal text-slate-900">{{ $event->detail_kegiatan }} </p>
                    </div>
                  </div>
                </div>
                @endforeach
                @else
                    <p>No events found for this community.</p>
                @endif

            </div>
            @endif
        </section>
    </x-app-layout>
