<!-- Start of x-app-layout -->
<x-app-layout>
  <!-- Start of font-poppins section -->
  <section class="font-poppins">
      <!-- Start of container div -->
      <div class="container mx-auto mt-16 sm:p-6 md:p-4 p-6">
          <!-- Start of grid layout -->
          <div class="grid grid-cols-12">
              <!-- Start of left column (col-span-4) -->
              <div class="col-span-4 flex flex-col mx-auto">
                  <div class="mb-12">
                      <div>
                          <img src="{{ asset('' . Auth::user()->avatar) }}" style="width: 100px; height: 100px; border-radius: 50%;" alt="{{ Auth::user()->name }}">
                      </div>

                  </div>

                  <div class="flex flex-col mx-auto gap-8 font-sm">
                      <a href="{{ route('profile.dasboard') }}">
                          <button class="bg-purple-700 text-slate-200 font-md hover:font-md rounded-full w-full py-3 px-4 hover:text-black hover:bg-white forced-colors:appearance-auto" type="button">
                              Dashboard
                          </button>
                      </a>
                      <a href="{{ route('profile.prifile') }}">
                          <button class="bg-purple-700 text-slate-200 font-md hover:font-md rounded-full w-full py-3 px-4 hover:text-black hover:bg-white" type="button">
                              Profile
                          </button>
                      </a>
                      <a href="{{ route('profile.edit') }}">
                          <button class="bg-purple-700 text-slate-200 font-md hover:font-md rounded-full w-full py-3 px-4 hover:text-black hover:bg-white" type="button">
                              Edit profil
                          </button>
                      </a>
                  </div>
              </div>
              <!-- Start of right column (col-span-8) -->
              <div class="flex col-span-8 flex-col gap-2">
                  <h2 class="mx-4 mb-0 flex justify-start my-auto" style="color: white;">Hello, {{ Auth::user()->name }}</h2>
                  <!-- Start of content section -->
                  <div>
                      <div class="col-8 mt-48 mx-4 my-[150px]">
                          <!-- Example content sections, replace with actual content -->
                          <div class="gap-6 flex flex-row">
                              <div class="col-6 md-6">
                                  <div class="card p-6 mt-4">
                                      <div class="">
                                          <h1 class="text-base">Active Community</h1>
                                          <h1 class="card-text font-bold">
                                            Belum
                                          </h1>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-6 md-6">
                                  <div class="card p-6 mt-4">
                                      <div class="">
                                          <h1 class="text-base">My Community</h1>
                                          <h1 class="card-text font-bold">
                                            @php
                                                $count = 0;
                                            @endphp
                                            @foreach ($komunitas as $community)
                                                @if ($community->KEY == Auth::user()->KEY)
                                                @php
                                                    $count++; // Increment the counter if the condition is met

                                                @endphp
                                            @endif
                                            @endforeach
                                            {{ $count }}
                                          </h1>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End of content section -->
              </div>
          </div>
      </div>
      <!-- End of container div -->
  </section>
</x-app-layout>
<!-- End of x-app-layout -->
