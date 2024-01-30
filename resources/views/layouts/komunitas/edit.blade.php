<x-app-layout>

    <div class="container mx-auto">

        <div class="text-2xl mt-6 font-medium text-white mb-6 font-poppins">
            Setting your community:
        </div>

        <div class="grid gap-6 grid-cols-12">

            <div class="col-span-6">

                <div class="max-w-screen-2xl border flex flex-col border-slate-700 rounded-xl shadow-md font-poppins p-5 mb-6 bg-slate-100">

                    <span class="font-semibold mb-2 text-slate-800">Previous Image</span>
                    <div class="w-16 h-16 rounded-full overflow-hidden mr-4">
                        <img src="{{ asset($komunitass->image_komunitas) }}" alt="Previous Image" class="w-full h-full object-cover" />
                    </div>

                    {{-- <div class="flex flex-col">
                        <!-- Add other information about the community profile here if needed -->
                    </div> --}}

                </div>
                <div class="max-w-screen-2xl border border-slate-700 rounded-xl mx-auto shadow-md font-poppins p-5 mb-6 bg-slate-100 flex flex-col">

                    {{-- <form action="" class="flex"> --}}
                        <label for="text" class="w-full">
                            <span class="block font-semibold mb-2 text-slate-800">Previous name</span>
                        <input type="text" disabled value="{{ $komunitass->nama_komunitas }}" id="text"  class=" px-3 py-3 border text-white text-semibold border-slate-900 bg-purple-900 shadow rounded-lg w-full text-sm">
                    </label>
                {{-- </form> --}}
                </div>
                <div class="max-w-screen-2xl border border-slate-700 rounded-xl mx-auto shadow-md font-poppins p-5 mb-6 bg-slate-100 flex flex-col">

                    {{-- <form action="" class="flex"> --}}
                        <label for="text" class="w-full">
                            <span class="block font-semibold mb-2 text-slate-800">Previous description</span>
                        <input type="text" disabled value="{{ $komunitass->description_komunitas }}" id="text"  class=" px-3 py-3 border text-white text-semibold border-slate-900 bg-purple-900 shadow rounded-lg w-full text-sm">
                    </label>
                {{-- </form> --}}
                </div>
            </div>
            <div class="col-span-6">
            <form action="{{ route('mycommunity.update', ['id_komunitas' => $komunitass->id_komunitas ]) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="max-w-screen-2xl border border-slate-700 rounded-xl mx-auto shadow-md font-poppins p-5 mb-6 bg-slate-100 flex flex-col">
                    <label for="new_image" class="block font-semibold mb-2 text-slate-800">Change Image</label>
                    <input type="file" name="new_image" id="new_image" class="px-3 py-3 border text-white text-semibold border-slate-900 bg-purple-900 shadow rounded-lg w-full text-sm">
                </div>
                <div class="max-w-screen-2xl border border-slate-700 rounded-xl mx-auto shadow-md font-poppins p-5 mb-6 bg-slate-100 flex flex-col">
                    <label for="new_name" class="block font-semibold mb-2 text-slate-800">Rename Community</label>
                    <input type="text" name="new_name" id="new_name" class="px-3 py-3 border text-white text-semibold border-slate-900 bg-purple-900 shadow rounded-lg w-full text-sm">
                </div>
                <div class="max-w-screen-2xl border border-slate-700 rounded-xl mx-auto shadow-md font-poppins p-5 mb-6 bg-slate-100 flex flex-col">
                    <label for="new_description" class="block font-semibold mb-2 text-slate-800">Update Description</label>
                    <input type="text" name="description_komunitas" id="new_description" class="px-3 py-3 border text-white text-semibold border-slate-900 bg-purple-900 shadow rounded-lg w-full text-sm">
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-8 mb-8 gap-6">
            <button class="bg-red-700 py-2 px-4 text-white font-poppins rounded-lg hover:bg-red-800 transform transition-transform hover:scale-105">
               <a class="text-inherit" href="{{ route('mycommunity.Event',['id_komunitas'=> $komunitass->id_komunitas]) }}" > Cancel</a>
            </button>
            <button class="bg-purple-700 py-2 px-4 text-white font-poppins rounded-lg hover:bg-purple-800 transform transition-transform hover:scale-105">
                Save Changes
            </button>
        </div>
    </form>

    </div>

</x-app-layout>
