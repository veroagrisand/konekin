<x-app-layout>
    <section>
        <div class="container mx-auto mt-10 sm:p-6 md:p-4 p-6">
            @include('layouts.partials.H-profilcommunity')

            <div class="w-full min-h-screen mb-0 flex-wrap gap-6 flex justify-center items-center mx-auto font-poppins pb-6">
                <!-- Chat Forum Section -->
                <div class="container mx-auto p-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h1 class="text-3xl font-semibold text-slate-700 mb-6">Chat Forum</h1>
                        @if ($comment && $comment->isNotEmpty())
                        @foreach($comment as $C)
                        @php
                        // Fetch the user based on the email
                        $user = App\Models\User::where('KEY', $C->KEY)->first();
                        @endphp
                            @if(Auth::user()->KEY == $C->KEY)
                                <div class="justify-end flex items-start mb-4">
                                    <div class="ml-2 text-gray-600">{{ $user->name}} | {{ $user->created_at }}</div>
                                    <div class="ml-2 bg-green-500 text-white p-2 h-10 rounded-md">
                                        <p>{{ $C->comment }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="justify-start flex items-start mb-4">
                                    <div class="mr-2 bg-purple-900 text-white p-2 rounded-md">
                                        <p>{{ $C->comment }}</p>
                                    </div>
                                    <div class="ml-2 text-gray-600">{{ $user->name }} | {{ $user->created_at }}</div>
                                </div>
                            @endif
                        @endforeach
                        @endif

                    </div>
                    <!-- Comment Section -->
                        <div class="bg-gray-200 mt-6 p-4 rounded-md mb-4 max-h-80 overflow-y-auto">
                            <h2 class="text-2xl font-semibold text-slate-700 mb-4">Chat</h2>
                            <!-- Comment Form -->
                            <form action="{{ route('mycommunity.ForumAdd', ['id_komunitas' => $komunitass->id_komunitas]) }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    {{-- <label for="content" class="block text-sm font-medium text-gray-700"></label> --}}
                                    <textarea id="content" name="content" rows="4" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
                                </div>

                                <div class="flex items-center">
                                    <button type="submit"  class="bg-blue-500 text-white p-2 rounded-md">
                                        {{-- <x-nav-link class="text-black my-auto hover:text-purple text-justify text-sm font-normal" href="{{ route('mycommunity.ForumAdd', ['id_komunitas' => $komunitass->id_komunitas]) }}" :active="request()->routeIs('mycommunity.AddEvent',['id'=> $komunitass->id_komunitas])"> --}}
                                            {{ __('sand') }}
                                        {{-- </x-nav-link> --}}
                                    </button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
