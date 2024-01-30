<x-app-layout>
  <section class="vh-200 font-poppins">
    <div class="container py-0 h-100">

      <div class="mt-12">
        <h1 class="text-8xl text-center font-semibold bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-blue-500">Ready to Join Your <br>Community Experience</h1>

        <p class="text-white text-center my-4 text-xl">Join the community,<strong> and it's free! </strong></p>

        <div class="mt-5 col-md-4 mx-auto text-center mb-20">
          <a href="{{ route('community') }}">
            <button class="btn hover:shadow-purple-900 transition duration-300 ease-in-out" type="button" id="button-addon3">Join Community</button>
          </a>
        </div>

      </div>


      @include('layouts.partials.NCommunity')
    </div>
</section>
</x-app-layout>
