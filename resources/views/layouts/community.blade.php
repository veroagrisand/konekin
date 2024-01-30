<x-app-layout>

<div class=" container mx-auto font-poppins">

  <div class="grid-cols-12 mt-5 flex flex-col ">
    <h1 class="w-auto text-8xl text-center font-semibold bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-blue-500">What Communities Can You Join Here?</h1>

        <p class="mt-6 text-center text-lg text-white">Discover different communities here! Find one you like, connect with people who share <br>
        your interests, and enjoy a vibrant community experience with us!.</p>
  </div>
  <div class="text-center mt-12">
          <a href="{{ route('createcommunity.create') }}" class="btncreate badge text-wrap text-center ms-3 me-3"><button class="btn p-2" >Create Community</button></a>
          <a href="{{ route('mycommunity') }}" class="btnmycommunity badge text-wrap text-center ms-3 me-3"><button class="btn p-2" >My Community</button></a>

          {{-- @if(Auth::member()->hasCommunity())
    <a href="{{ route('mycommunity') }}" class="btn btn-primary">My Community</a>
@else
    <p>Anda belum memiliki komunitas. <a href="{{ route('createcommunity.create') }}">Buat Komunitas</a></p>
@endif --}}

  </div>

  @include('layouts.partials.Community')
</div>
</x-app-layout>
